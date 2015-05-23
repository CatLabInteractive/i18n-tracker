<?php
/**
 * Created by PhpStorm.
 * User: daedeloth
 * Date: 23/05/15
 * Time: 11:40
 */

namespace i18nTracker\Controllers;


use i18nTracker\MapperFactory;
use Neuron\Net\Response;

class Translate
	extends Base {

	public function listProjects ()
	{
		$projects = MapperFactory::getProjectMapper ()->getAll ();
		return Response::template ('listProjects.phpt', array ('projects' => $projects));
	}

	public function translate ($token)
	{
		$project = MapperFactory::getProjectMapper ()->getFromToken ($token);

		if (!$project)
			return Response::error ('Project not found: ' . $token, Response::STATUS_NOTFOUND);

		$original = $project->getBundle ('original');
		$translation = $project->getBundle ('en');

		$data = array (
			'project' => $project,
			'original' => $original->getResources (),
			'translated' => $translation->getResources ()
		);

		return Response::template ('translate.phpt', $data);
	}

}