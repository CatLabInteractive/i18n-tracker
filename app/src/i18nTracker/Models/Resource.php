<?php

namespace i18nTracker\Models;

use i18nTracker\Collections\VariationCollection;
use i18nTracker\MapperFactory;
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

	/** @var Variation[] */
	private $variations;

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


	public function getVariations ()
	{
		if (!isset ($this->variations))
		{
			$this->variations = new VariationCollection ();

			if (!$this->getN ()) {
				$variation = new Variation ();
				$variation->setId (0);
				$variation->setText ($this->getText ());

				$this->variations->add ($variation);
			}

			else {
				$variation1 = new Variation (1);
				$variation1->setId (1);
				$variation1->setText ($this->getText ());

				$variation2 = new Variation (1);
				$variation2->setId (2);
				$variation2->setText ($this->getText ());

				$this->variations->add ($variation1);
				$this->variations->add ($variation2);
			}

			MapperFactory::getVariationMapper ()->loadFromResource ($this);
		}

		return $this->variations;
	}

	public function getData ()
	{
		$out = array ();

		$out['id'] = $this->getId ();
		$out['text'] = $this->getText ();

		$out['variations'] = array ();
		foreach ($this->getVariations () as $variation) {
			$out['variations'][] = array (
				'id' => $variation->getId (),
				'text' => $variation->getText ()
			);
		}

		return $out;
	}
}