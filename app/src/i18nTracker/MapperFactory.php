<?php

namespace i18nTracker;

class MapperFactory {

	public static function getInstance ()
	{
		static $in;
		if (!isset ($in))
		{
			$in = new self ();
		}
		return $in;
	}

	private $mapped = array ();

	public function setMapper ($key, $mapper)
	{
		$this->mapped[$key] = $mapper;
	}

	public function getMapper ($key, $default)
	{
		if (isset ($this->mapped[$key]))
		{
			return $this->mapped[$key];
		}
		else
		{
			$this->mapped[$key] = new $default ();
		}
		return $this->mapped[$key];
	}

	/**
	 * @return \i18nTracker\Mappers\ProjectMapper
	 */
	public static function getProjectMapper () {
		return self::getInstance ()->getMapper ('projects', 'i18nTracker\Mappers\ProjectMapper');
	}

	/**
	 * @return \i18nTracker\Mappers\BundleMapper
	 */
	public static function getBundleMapper () {
		return self::getInstance ()->getMapper ('bundles', 'i18nTracker\Mappers\BundleMapper');
	}

	/**
	 * @return \i18nTracker\Mappers\ResourceMapper
	 */
	public static function getResourceMapper () {
		return self::getInstance ()->getMapper ('resources', 'i18nTracker\Mappers\ResourceMapper');
	}
}