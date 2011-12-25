<?php

class Setting {
	private $settings;
	private $key;
	private $value;
	private $jsonValue;
	private $type;

	public function __construct(Settings $settings, $key, $jsonValue, $type) {
		$this->settings = $settings;
		$this->key = $key;
		$this->type = $type;
		$this->jsonValue = $jsonValue;
	}

	public function value() {
		if(empty($this->value)) $this->value = $this->settings->handler($this->type)->evaluate($this->jsonValue);
		return $this->value;
	}

	public function key() {
		return $this->key;
	}

	public function json() {
		return __toString();
	}

	public function __toString() {
		return $this->jsonValue;
	}
}