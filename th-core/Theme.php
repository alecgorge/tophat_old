<?php

class Theme {
	private $dir;
	private $name = "Unknown";
	private $meta;
	private $template;

	private $valid = false;
	private $cms;

	public function __construct(TopHat $cms, fDirectory $themeDir) {
		$this->cms = $cms;
		$this->dir = $themeDir;
		$this->validate();
	}

	private function metadata() {
		if(is_array($this->meta)) return $this->meta;

		try {
			$json_file = new fFile($this->dir()->getPath().'/theme.json');
			$this->meta = fJSON::decode($json_file->read(), true);
			$this->name = $this->meta['name'];

		}
		catch(fValidationException $e) { // file doesn't exist
			$this->name = $this->dir()->getName();
			$this->meta = array();
		}

		return $this->meta;
	}

	/**
	 * @return string The name of the theme as according to theme.json. If theme.json doesn't exist, it is the folder name.
	 */
	public function name() {
		$this->metadata();
		return $this->name;
	}

	/**
	 * @return fDirectory The directory the theme is in.
	 */
	public function dir() {
		return $this->dir;
	}

	/**
	 * @return string The path to the index.tpl.php file.
	 */
	public function file() {
		return $this->dir()->getPath().'/index.tpl.php';
	}

	/**
	 * @return fTemplating The corresponding fTemplating object.
	 */
	public function template() {
		if(empty($this->template)) {
			$this->template = new fTemplating($this->dir);
			$this->setupTemplate();
		}
		return $this->template;
	}

	private function setupTemplate() {
		$this->template()->set('db', $this->cms->db());
	}

	/**
	 * @throws fValidationException If the index.tpl.php file doesn't exist for this theme.
	 * @return bool Valid theme?
	 */
	public function validate() {
		if($this->valid) return true;

		new fFile($this->file());

		$this->valid = true;

		return true;
	}
}