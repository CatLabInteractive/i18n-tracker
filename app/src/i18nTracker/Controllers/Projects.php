<?php

namespace i18nTracker\Controllers;

use i18nTracker\MapperFactory;
use i18nTracker\Models\Resource;
use Neuron\Net\Response;


class Projects
	extends Base {

	/**
	 * @param string $text
	 * @return string
	 */
	private function trim($text)
	{
		return str_replace('\\u0000', '', trim($text));
	}

	public function track ($projectToken) {

		$project = $this->getProject ($projectToken);
		$language = MapperFactory::getLanguageMapper ()->getFromToken ('original');

		$bundle = $this->getBundle ($project, $language);

		// Fetch the resource.
		$resource = new Resource ();
		$resource->setBundle ($bundle);
		$resource->setText ($this->trim($this->request->input ('text')));
		$resource->setToken ($this->trim($resource->getText ()));
		$resource->setN ($this->request->input ('quantified') ? 1 : 0);

		MapperFactory::getResourceMapper ()->touch ($resource);

		return Response::json (array ('test' => 1));

	}

	/*
	public function translate ($projectToken, $language) {

		$project = $this->getProject ($projectToken);

		$language = MapperFactory::getLanguageMapper ()->getFromToken ($language);
		$bundle = MapperFactory::getBundleMapper ()->getFromLanguage ($project, $language);

		$resources = MapperFactory::getResourceMapper ()->getFromBundle ($bundle);
		return Response::json ($resources->getData ());

	}
	*/

}