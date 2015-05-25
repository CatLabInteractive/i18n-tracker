<?php
/**
 * Created by PhpStorm.
 * User: daedeloth
 * Date: 23/05/15
 * Time: 15:23
 */

namespace i18nTracker\Models;


use Neuron\Interfaces\Model;

class Variation
	implements Model {

	/** @var int */
	private $id;

	/**
	 * @var string
	 */
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
	 * @return Variation
	 */
	public function setId ($id)
	{
		$this->id = $id;
		return $this;
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
	 * @return Variation
	 */
	public function setText ($text)
	{
		$this->text = $text;
		return $this;
	}

	public function getDescription ()
	{
		switch ($this->getId ()) {
			case 1:
				return 'Used in case of 1.';
			case 2:
				return 'Used in case of 0, 2 or more.';
		}

		return 'Write translation';
	}

}