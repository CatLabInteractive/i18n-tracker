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

	/** @var boolean */
	private $published;

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
	 * @return boolean
	 */
	public function isPublished()
	{
		return $this->published;
	}

	/**
	 * @param boolean $published
	 * @return self
	 */
	public function setPublished($published)
	{
		$this->published = $published;
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

    public function disable ()
    {
        MapperFactory::getResourceMapper ()->disable ($this);
    }

	public function getData ($format = 'json')
	{
		$out = array ();

		foreach ($this->getResources () as $resource)
		{
			if (!$resource->isEmpty ()) {

				switch (strtolower ($format))
				{
					case 'polyglot':
						$txt = '';
						foreach ($resource->getVariations () as $variation) {
							$txt .= $variation->getText () . '||||';
						}
						$out[$resource->getToken ()] = substr ($txt, 0, -4);
					break;

					case 'i18nlite':

						$tmp = array ();
						foreach ($resource->getVariations () as $variation)
						{
							$tmp[] = $variation->getQuantificationToken ();
						}

						$out[$resource->getToken ()] = $tmp;
					break;

					default:
						foreach ($resource->getVariations () as $variation) {
							$out[$variation->getToken ($resource)] = $variation->getText ();
						}
					break;
				}
			}
		}

		return $out;
	}
}