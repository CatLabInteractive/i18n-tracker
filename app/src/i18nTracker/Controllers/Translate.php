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

	public function selectLanguage ($token)
	{
		$project = MapperFactory::getProjectMapper ()->getFromToken ($token);

		if (!$project)
			return Response::error ('Project not found: ' . $token, Response::STATUS_NOTFOUND);

		$languages = MapperFactory::getLanguageMapper ()->getAll ();

		$data = array (
			'project' => $project,
			'languages' => $languages
		);

		return Response::template ('selectLanguage.phpt', $data);
	}

	public function translate ($token, $language)
	{
		$project = MapperFactory::getProjectMapper ()->getFromToken ($token);

		if (!$project)
			return Response::error ('Project not found: ' . $token, Response::STATUS_NOTFOUND);

		$original = $project->getBundle (MapperFactory::getLanguageMapper ()->getFromToken ('original'));
		$translation = $project->getBundle (MapperFactory::getLanguageMapper ()->getFromToken ($language));

		$data = array (
			'project' => $project,
			'original' => $original->getResources (),
			'translated' => $translation->getResources (),
			'language' => $translation->getLanguage ()
		);

		return Response::template ('translate.phpt', $data);
	}

	public function setResource ($token, $language, $resourceId)
	{
		$project = MapperFactory::getProjectMapper ()->getFromToken ($token);

		if (!$project)
			return Response::error ('Project not found: ' . $token, Response::STATUS_NOTFOUND);

		$original = $project->getBundle (MapperFactory::getLanguageMapper ()->getFromToken ('original'));

		$originalResource = $original->getResources ()->getFromId ($resourceId);
		if (!$originalResource)
			return Response::error ('Resource not found: ' . $resourceId, Response::STATUS_NOTFOUND);



		return Response::json (array ('success' => 1));
	}

}