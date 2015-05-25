<?php

namespace i18nTracker\Models;

use i18nTracker\MapperFactory;

class Project {

	/** @var int */
	private $id;

	/** @var string */
	private $token;

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
	 * @return string
	 */
	public function getToken ()
	{
		return $this->token;
	}

	/**
	 * @param string $token
	 */
	public function setToken ($token)
	{
		$this->token = $token;
	}

	public function getBundle ($language)
	{
		$bundle = MapperFactory::getBundleMapper ()->getFromLanguage ($this, $language);
		if (!$bundle) {
			$bundle = new Bundle ();
			$bundle->setLanguage ($language);
			$bundle->setProject ($this);

			MapperFactory::getBundleMapper ()->create ($bundle);
		}

		return $bundle;
	}

	public function getLanguages ()
	{
		$languages = MapperFactory::getLanguageMapper ()->getAll ();

		$out = array ();
		foreach ($languages as $language)
		{
			if (!$this->getBundle ($language)->isEmpty ()) {
				$out[] = $language;
			}
		}

		return $out;
	}

	/**
	 * @return array
	 */
	public function getData () {
		return array (
			'id' => $this->getId (),
			'token' => $this->getToken ()
		);
	}

}