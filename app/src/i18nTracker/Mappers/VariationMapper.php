<?php
/**
 * Created by PhpStorm.
 * User: daedeloth
 * Date: 21/05/15
 * Time: 0:25
 */

namespace i18nTracker\Mappers;

use i18nTracker\Models\Resource;
use i18nTracker\Models\Variation;
use Neuron\DB\Query;

class VariationMapper
	extends \Neuron\Mappers\BaseMapper {

	public function getFromResource (Resource $resource)
	{
		return $this->getObjectsFromData (
			Query::select (
				'variations',
				array ('*'),
				array (
					'resource_id' => $resource->getId ()
				)
			)->execute ()
		);
	}

	public function loadFromResource (Resource $resource)
	{
		$values = $this->getFromResource ($resource);

		foreach ($values as $value) {
			$resource->getVariations ()->getFromId ($value->getId ())->setText ($value->getText ());
		}
	}

	public function touch (Resource $resource, Variation $variation)
	{
		Query::replace (
			'variations',
			array (
				'resource_id' => $resource->getId (),
				'variation_id' => $variation->getId (),
				'variation_text' => $variation->getText ()
			)
		)->execute ();
	}

	protected function getObjectFromData ($data)
	{
		$variation = new Variation ();
		$variation->setId (intval ($data['variation_id']));
		$variation->setText ($data['variation_text']);

		return $variation;
	}
}