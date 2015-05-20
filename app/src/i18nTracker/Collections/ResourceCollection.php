<?php

namespace i18nTracker\Collections;

use Neuron\Collections\Collection;

class ResourceCollection
	extends Collection {

	public function getData () {

		$out = array ();
		foreach ($this as $v) {
			$out[$v->getToken ()] = $v->getText ();
		}
		return $out;

	}

}