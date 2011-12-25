<?php

class Settings {
	private $db;
	private $handlers;

	private $settings;

	public function __construct(fDatabase $db) {
		$this->db = $db;
		$this->registerHandler('default', new StdKeyValueSetting());
	}

	/**
	 * @param $key The setting key to fetch. Can be anything. For example: core.ui.default
	 * @return Setting The setting value from the corresponding key. If the key doesn't exist, null is returned.
	 */
	public function get($key) {
		if(empty($this->settings)) $this->loadSettings();
		return $this->settings[$key];
	}

	private function loadSettings() {
		$res = $this->db->query("SELECT * FROM %s", TH_TABLE_SETTINGS);
		foreach($res as $row) {
			$this->settings[$row['key']] = new Setting($this, $row['key'], $row['value'], $row['type']);
		}
	}

	/**
	 * @param $type Name of the JSON type.
	 * @return SettingType A SettingType instance that can be used to evaluate a JSON value setting.
	 */
	public function handler($type) {
		return $this->handlers[$type];
	}

	public function registerHandler($type, SettingType $inst) {
		$this->handlers[$type] = $inst;
	}
}

interface SettingType {
	public function evaluate($json);
}

class StdKeyValueSetting implements SettingType {
	public function evaluate($json) {
		return fJSON::decode($json, true);
	}
}
