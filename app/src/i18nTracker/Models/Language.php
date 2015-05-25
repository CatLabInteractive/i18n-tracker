<?php
/**
 * Created by PhpStorm.
 * User: daedeloth
 * Date: 23/05/15
 * Time: 13:01
 */

namespace i18nTracker\Models;


class Language {

	/** @var string */
	private $token;

	/** @var string */
	private $name;

	/** @var int */
	private $nOptions;

	public function __construct ($token, $name, $nOptions = 2) {
		$this->setToken ($token)
			->setName ($name)
			->setNOptions ($nOptions);
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
	 * @return Language
	 */
	public function setToken ($token)
	{
		$this->token = $token;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getName ()
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 * @return Language
	 */
	public function setName ($name)
	{
		$this->name = $name;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getNOptions ()
	{
		return $this->nOptions;
	}

	/**
	 * @param int $nOptions
	 * @return Language
	 */
	public function setNOptions ($nOptions)
	{
		$this->nOptions = $nOptions;
		return $this;
	}

}