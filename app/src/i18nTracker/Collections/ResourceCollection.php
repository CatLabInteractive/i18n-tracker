<?php

namespace i18nTracker\Collections;

use Neuron\Collections\Collection;

class ResourceCollection
	extends Collection {

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