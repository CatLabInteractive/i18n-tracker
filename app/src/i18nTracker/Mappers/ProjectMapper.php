<?php

namespace i18nTracker\Mappers;

use i18nTracker\Models\Project;
use Neuron\DB\Query;

class ProjectMapper
	extends \Neuron\Mappers\BaseMapper {

	/**
	 * @param $token
	 * @return Project|null
	 */
	public function getFromToken ($token) {
		return $this->getSingle (
			Query::select (
				'projects',
				array (
					'project_id',
					'project_token'
				),
				array (
					'project_token' => $token
				)
			)->execute ()
		);
	}

	/**
	 * @return array|\mixed[]
	 */
	public function getAll ()
	{
		return $this->getObjectsFromData (
			Query::select (
				'projects',
				array (
					'project_id',
					'project_token'
				)
			)->execute ()
		);
	}

	/**
	 * @param Project $project
	 * @return Project
	 */
	public function create (Project $project) {
		$id = Query::insert (
			'projects',
			array (
				'project_token' => $project->getToken ()
			)
		)->execute ();

		$project->setId (intval ($id));
		return $project;
	}

	/**
	 * @param $data
	 * @return Project
	 */
	protected function getObjectFromData ($data)
	{
		$project = new Project ();
		$project->setId (intval ($data['project_id']));
		$project->setToken ($data['project_token']);
		return $project;
	}
}