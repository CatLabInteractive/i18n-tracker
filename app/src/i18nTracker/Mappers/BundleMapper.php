<?php

namespace i18nTracker\Mappers;


use i18nTracker\Models\Bundle;
use i18nTracker\Models\Project;
use Neuron\DB\Query;

class BundleMapper
	extends \Neuron\Mappers\BaseMapper {

	/**
	 * @param Project $project
	 * @param $language
	 * @return Bundle|null
	 */
	public function getFromLanguage (Project $project, $language) {
		return $this->getSingle (
			Query::select (
				'bundles',
				array ('*'),
				array (
					'project_id' => $project->getId (),
					'bundle_language' => $language
				)
			)->execute ()
		);
	}

	/**
	 * @param int $id
	 * @return Bundle|null
	 */
	public function getFromId ($id) {
		return $this->getSingle (
			Query::select (
				'bundles',
				array ('*'),
				array (
					'bundle_id' => $id,
				)
			)->execute ()
		);
	}

	/**
	 * @param Bundle $bundle
	 * @return Bundle
	 */
	public function create (Bundle $bundle) {

		$id = Query::insert (
			'bundles',
			array (
				'project_id' => $bundle->getProject ()->getId (),
				'bundle_language' => $bundle->getLanguage ()
			)
		)->execute ();

		$bundle->setId (intval ($id));

		return $bundle;

	}

	/**
	 * @param $data
	 * @return Bundle
	 */
	protected function getObjectFromData ($data)
	{
		$bundle = new Bundle ();

		$bundle->setId (intval ($data['bundle_id']));
		$bundle->setLanguage ($data['bundle_language']);

		return $bundle;
	}
}