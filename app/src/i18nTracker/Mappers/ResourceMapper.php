<?php
/**
 * Created by PhpStorm.
 * User: daedeloth
 * Date: 21/05/15
 * Time: 0:25
 */

namespace i18nTracker\Mappers;


use i18nTracker\Collections\ResourceCollection;
use i18nTracker\MapperFactory;
use i18nTracker\Models\Bundle;
use i18nTracker\Models\Resource;
use Neuron\DB\Query;

class ResourceMapper
	extends \Neuron\Mappers\BaseMapper {

	/**
	 * @param Bundle $bundle
	 * @param $token
	 * @return Resource|null
	 */
	public function getFromToken (Bundle $bundle, $token) {
		return $this->getSingle (
			Query::select (
				'resources',
				array ('*'),
				array (
					'bundle_id' => $bundle->getId (),
					'resource_token' => $token
				)
			)->execute ()
		);
	}

	/**
	 * @param Resource $resource
	 * @return Resource
	 */
	public function touch (Resource $resource) {

		if ($resource->getId ()) {
			$this->update ($resource);
		}

		$original = $this->getFromToken ($resource->getBundle (), $resource->getToken ());

		// Check.
		if ($original !== null) {
			$resource->setId ($original->getId ());
			return $this->update ($resource);
		}

		else {
			return $this->create ($resource);
		}
	}

	/**
	 * @param Resource $resource
	 * @return Resource
	 */
	public function update (Resource $resource) {
		Query::update (
			'resources',
			array (
				'bundle_id' => $resource->getBundle ()->getId (),
				'resource_n' => $resource->getN (),
				'resource_text' => $resource->getText ()
			),
			array (
				'resource_id' => $resource->getId ()
			)
		)->execute ();

		return $resource;
	}

	/**
	 * @param Resource $resource
	 * @return Resource
	 */
	public function create (Resource $resource) {
		$id = Query::insert (
			'resources',
			array (
				'bundle_id' => $resource->getBundle ()->getId (),
				'resource_n' => $resource->getN (),
				'resource_text' => $resource->getText (),
				'resource_token' => $resource->getToken ()
			)
		)->execute ();

		$resource->setId (intval ($id));
		return $resource;
	}

	public function getFromBundle (Bundle $bundle) {

		return $this->getObjectsFromData (
			Query::select (
				'resources',
				array (
					'*'
				),
				array (
					'bundle_id' => $bundle->getId ()
				)
			)->execute ()
		);

	}

	/**
	 * Override this to set an alternative object collection.
	 * @return ResourceCollection
	 */
	protected function getObjectCollection ()
	{
		return new ResourceCollection ();
	}

	/**
	 * @param $data
	 * @return Resource
	 */
	protected function getObjectFromData ($data)
	{
		$resource = new Resource ();

		$resource->setId (intval ($data['resource_id']));
		$resource->setBundle (MapperFactory::getBundleMapper ()->getFromId ($data['bundle_id']));

		if (isset ($data['resource_n'])) {
			$resource->setN ($data['resource_n']);
		}

		$resource->setText ($data['resource_text']);

		return $resource;
	}
}