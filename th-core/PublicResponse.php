<?php

class PublicResponse {
	private $cms;

	public function __construct(TopHat $cms) {
		$this->cms = $cms;
	}

	public function serve() {
		$theme = $this->cms->themeManager()->activeTheme();
		$template = $theme->template();

		$node = false;
		try {
			$node = $this->cms->content()->get();
		}
		catch (fNoRowsException $e) { // must be 404
			$node = $this->cms->content()->find(array(
				'type' => 'error-page',
				'custom_1' => '404'
			));
		}
		var_dump($node);
	}
}
