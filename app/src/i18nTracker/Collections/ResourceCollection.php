<?php

namespace i18nTracker\Collections;

use Neuron\Collections\Collection;
use Neuron\Collections\ModelCollection;

class ResourceCollection
	extends ModelCollection {

	public function getFromToken ($token)
	{
		foreach ($this as $v) {
			if ($v->getToken () === $token) {
				return $v;
			}
		}
		return null;
	}

	public function getData () {

		$out = array ();
		foreach ($this as $v) {
			$out[$v->getToken ()] = $v->getText ();
		}
		return $out;

	}

}