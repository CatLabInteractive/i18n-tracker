<?php
/**
 * Created by PhpStorm.
 * User: daedeloth
 * Date: 20/05/15
 * Time: 23:58
 */

namespace i18nTracker\Models;


use i18nTracker\Collections\ResourceCollection;
use i18nTracker\MapperFactory;

class Bundle {

	/** @var int */
	private $id;

	/** @var Project */
	private $project;

	/** @var Language */
	private $language;

	/** @var ResourceCollection */
	private $resources;

	/**
	 * @return int
	 */
	public function getId ()
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 * @return Bundle
	 */
	public function setId ($id)
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * @return Project
	 */
	public function getProject ()
	{
		return $this->project;
	}

	/**
	 * @param Project $project
	 * @return Bundle
	 */
	public function setProject ($project)
	{
		$this->project = $project;
		return $this;
	}

	/**
	 * @return Language
	 */
	public function getLanguage ()
	{
		return $this->language;
	}

	/**
	 * @param Language $language
	 * @return Bundle
	 */
	public function setLanguage ($language)
	{
		$this->language = $language;
		return $this;
	}

	/**
	 * @return ResourceCollection
	 */
	public function getResources ()
	{
		if (!isset ($this->resources)) {
			$this->resources = MapperFactory::getResourceMapper ()->getFromBundle ($this);
			$this->resources->setBundle ($this);
		}

		return $this->resources;
	}

	public function isEmpty ()
	{
		foreach ($this->getResources () as $resource) {
			if (!$resource->isEmpty ()) {
				return false;
			}
		}

		return true;
	}

	public function getData ()
	{
		$out = array ();

		foreach ($this->getResources () as $resource)
		{
			if (!$resource->isEmpty ()) {

				foreach ($resource->getVariations () as $variation) {

					$out[$variation->getToken ($resource)] = $variation->getText ();

				}

			}
		}

		return $out;
	}
}