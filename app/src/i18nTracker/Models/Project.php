<?php

namespace i18nTracker\Models;

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