<?php
/**
 * Created by PhpStorm.
 * User: daedeloth
 * Date: 20/05/15
 * Time: 23:58
 */

namespace i18nTracker\Models;


use i18nTracker\MapperFactory;

class Bundle {

	/** @var int */
	private $id;

	/** @var Project */
	private $project;

	/** @var string */
	private $language;

	/**
	 * @return int
	 */
	public function getId ()
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId ($id)
	{
		$this->id = $id;
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
	 */
	public function setProject ($project)
	{
		$this->project = $project;
	}

	/**
	 * @return string
	 */
	public function getLanguage ()
	{
		return $this->language;
	}

	/**
	 * @param string $language
	 */
	public function setLanguage ($language)
	{
		$this->language = $language;
	}

	public function getResources ()
	{
		return MapperFactory::getResourceMapper ()->getFromBundle ($this);
	}

}