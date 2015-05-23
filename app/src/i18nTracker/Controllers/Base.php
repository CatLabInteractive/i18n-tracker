<?php

namespace i18nTracker\Controllers;

use i18nTracker\MapperFactory;
use i18nTracker\Models\Bundle;
use i18nTracker\Models\Language;
use i18nTracker\Models\Project;
use Neuron\Interfaces\Module;
use Neuron\Interfaces\Controller;
use Neuron\Net\Request;

class Base
	implements Controller {

	/** @var Module */
	protected $module;

	/** @var Request */
	protected $request;

	/**
	 * Controllers must know what module they are from.
	 * @param Module $module
	 */
	public function __construct (Module $module = null)
	{
		$this->module = $module;
	}

	/**
	 * Set (or clear) the request object.
	 * @param Request $request
	 * @return void
	 */
	public function setRequest (Request $request = null)
	{
		$this->request = $request;
	}

	/**
	 * Load a project from token, or create a new one in case it doesn't exist.
	 * @param $token
	 * @return Project
	 */
	protected function getProject ($token) {

		$project = MapperFactory::getProjectMapper ()->getFromToken ($token);

		if (!$project) {
			$project = new Project ();
			$project->setToken ($token);

			MapperFactory::getProjectMapper ()->create ($project);
		}

		return $project;

	}

	/**
	 * Load a bundle from a project, or create a new one in case it doesn't exist.
	 * @param Project $project
	 * @param Language $language
	 * @return Bundle
	 */
	protected function getBundle (Project $project, Language $language) {

		$bundle = MapperFactory::getBundleMapper ()->getFromLanguage ($project, $language);

		if (!$bundle) {
			$bundle = new Bundle ();
			$bundle->setProject ($project);
			$bundle->setLanguage ($language);

			MapperFactory::getBundleMapper ()->create ($bundle);
		}

		return $bundle;

	}
}