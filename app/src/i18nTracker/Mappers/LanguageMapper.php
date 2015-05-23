<?php
/**
 * Created by PhpStorm.
 * User: daedeloth
 * Date: 23/05/15
 * Time: 13:02
 */

namespace i18nTracker\Mappers;


use i18nTracker\Models\Language;

class LanguageMapper {

	/**
	 * @return Language[]
	 */
	public function getAll () {

		$languages = array ();

		$languages[] = new Language ('original', 'Original', 1);

		$languages[] = new Language ('en', 'English', 2);
		$languages[] = new Language ('nl', 'Nederlands', 2);
		$languages[] = new Language ('fr', 'Français', 2);
		$languages[] = new Language ('de', 'Deutsch', 2);

		return $languages;

	}

	/**
	 * @param $token
	 * @return null|Language
	 */
	public function getFromToken ($token)
	{
		foreach ($this->getAll () as $language) {
			if ($language->getToken () == $token) {
				return $language;
			}
		}
		return null;
	}

}