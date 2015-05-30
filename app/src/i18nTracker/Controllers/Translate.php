<?php
/**
 * Created by PhpStorm.
 * User: daedeloth
 * Date: 23/05/15
 * Time: 11:40
 */

namespace i18nTracker\Controllers;


use i18nTracker\MapperFactory;
use i18nTracker\Models\Variation;
use Neuron\Net\Response;
use Neuron\URLBuilder;

class Translate
	extends Base {

	/**
	 * @return Response
	 */
	public function listProjects ()
	{
		$projects = MapperFactory::getProjectMapper ()->getAll ();
		return Response::template ('listProjects.phpt', array ('projects' => $projects));
	}

	/**
	 * @param string $token
	 * @return Response
	 */
	public function selectLanguage ($token)
	{
		$project = MapperFactory::getProjectMapper ()->getFromToken ($token);

		if (!$project)
			return Response::error ('Project not found: ' . $token, Response::STATUS_NOTFOUND);

        if ($this->request->input ('retrace')) {
            $project->retrace ();
        }

		$languages = MapperFactory::getLanguageMapper ()->getAll ();

		$data = array (
			'project' => $project,
			'languages' => $languages
		);

		return Response::template ('selectLanguage.phpt', $data);
	}

	/**
	 * @param string $token
	 * @param string $language
	 * @return Response
	 */
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

	/**
	 * @param string $token
	 * @param string $language
	 * @param int $resourceId
	 * @param int $variationId
	 * @return Response
	 */
	public function setResource ($token, $language, $resourceId, $variationId)
	{
		$project = MapperFactory::getProjectMapper ()->getFromToken ($token);

		if (!$project)
			return Response::error ('Project not found: ' . $token, Response::STATUS_NOTFOUND);

		$original = $project->getBundle (MapperFactory::getLanguageMapper ()->getFromToken ('original'));

		$originalResource = $original->getResources ()->getFromId ($resourceId);
		if (!$originalResource)
			return Response::error ('Resource not found: ' . $resourceId, Response::STATUS_NOTFOUND);

		$bundle = $project->getBundle (MapperFactory::getLanguageMapper ()->getFromToken ($language));
		$resource = $bundle->getResources ()->touchFromOriginal ($originalResource);

		$data = $this->request->getData ();

		$value = $data['value'];

		$variation = new Variation ();
		$variation->setId ($variationId);
		$variation->setText ($value);

		MapperFactory::getVariationMapper ()->touch ($resource, $variation);

		if ($variation->getId () == 0 || $variation->getId () == 2) {
			$resource->setText ($variation->getText ());
			MapperFactory::getResourceMapper ()->touch ($resource);
		}

		return Response::json ($resource->getData ());
	}

	public function showLanguages ($token)
	{
		$project = MapperFactory::getProjectMapper ()->getFromToken ($token);

		if (!$project)
			return Response::error ('Project not found: ' . $token, Response::STATUS_NOTFOUND);

		$out = array ();

		foreach ($project->getLanguages (true) as $language)
		{
			$out[] = array (
				'name' => $language->getName (),
				'token' => $language->getToken (),
				'url' => URLBuilder::getAbsoluteURL ('download/' . $token . '/' . $language->getToken ())
			);
		}

		return Response::json ($out);
	}

	/**
	 * @param string $token
	 * @param string $language
	 * @return Response
	 */
	public function download ($token, $language)
	{
		$project = MapperFactory::getProjectMapper ()->getFromToken ($token);

		if (!$project)
			return Response::error ('Project not found: ' . $token, Response::STATUS_NOTFOUND);

		$bundle = $project->getBundle (MapperFactory::getLanguageMapper ()->getFromToken ($language));

		return Response::json ($bundle->getData ($this->request->input ('format')));
	}
}