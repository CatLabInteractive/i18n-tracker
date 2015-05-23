<?php

namespace i18nTracker\Models;

use Neuron\Interfaces\Model;

class Resource
	implements Model {

	/** @var int */
	private $id;

	/** @var string */
	private $token;

	/** @var Bundle */
	private $bundle;

	/** @var int */
	private $n;

	/** @var string */
	private $text;

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
	 * @return Bundle
	 */
	public function getBundle ()
	{
		return $this->bundle;
	}

	/**
	 * @param Bundle $bundle
	 */
	public function setBundle ($bundle)
	{
		$this->bundle = $bundle;
	}

	/**
	 * @return int
	 */
	public function getN ()
	{
		return $this->n;
	}

	/**
	 * @param int $n
	 */
	public function setN ($n)
	{
		$this->n = $n;
	}

	/**
	 * @return string
	 */
	public function getText ()
	{
		return $this->text;
	}

	/**
	 * @param string $text
	 */
	public function setText ($text)
	{
		$this->text = $text;
	}


}