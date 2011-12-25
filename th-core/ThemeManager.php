<?php

class ThemeManager {
	private $cms;
	private $themes = array();
	private $active;

	public function __construct(TopHat $cms) {
		$this->cms = $cms;
	}

	/**
	 * @return array An array of Theme's.
	 */
	public function themes() {
		if(empty($themes)) {
			$theme_dirs = new fDirectory(TH_CONTENT.'/themes');

			foreach($theme_dirs->scan() as $theme_dir)
				$this->themes[] = new Theme($this->cms, $theme_dir);
		}
		return $this->themes;
	}

	/**
	 * @return Theme The active theme as according to the setting core.theme.
	 */
	public function activeTheme() {
		if(empty($this->active)) {
			$themeName = $this->cms->settings()->get('core.theme')->value();
			var_dump($themeName);
			foreach($this->themes() as $theme) {
				var_dump($theme->name());
				if($theme->name() == $themeName) {
					$this->active = $theme;
					break;
				}
			}
		}
		return $this->active;
	}
}