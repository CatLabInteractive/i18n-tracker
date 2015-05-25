<?php

namespace i18nTracker\Collections;

use i18nTracker\MapperFactory;
use i18nTracker\Models\Bundle;
use i18nTracker\Models\Resource;
use Neuron\Collections\Collection;
use Neuron\Collections\ModelCollection;

class ResourceCollection
	extends ModelCollection {

	/**
	 * @var Bundle
	 */
	private $bundle;

	/**
	 * @return Bundle
	 */
	public function getBundle ()
	{
		return $this->bundle;
	}

	/**
	 * @param Bundle $bundle
	 * @return ResourceCollection
	 */
	public function setBundle ($bundle)
	{
		$this->bundle = $bundle;
		return $this;
	}

	/**
	 * @param $token
	 * @return Resource
	 */
	public function getFromToken ($token)
	{
		foreach ($this as $v) {
			if ($v->getToken () === $token) {
				return $v;
			}
		}
		return null;
	}

	/**
	 * @param \i18nTracker\Models\Resource $original
	 * @return \i18nTracker\Models\Resource
	 */
	public function touchFromOriginal (Resource $original)
	{
		$model = $this->getFromToken ($original->getToken ());
		if (!$model) {
			$model = new Resource ();
			$model->setToken ($original->getToken ());
			$model->setN ($original->getN ());
			$model->setBundle ($this->getBundle ());

			MapperFactory::getResourceMapper ()->touch ($model);

			$this->add ($model);
		}

		return $model;
	}

	public function getData () {

		$out = array ();
		foreach ($this as $v) {
			$out[$v->getToken ()] = $v->getText ();
		}
		return $out;

	}

}