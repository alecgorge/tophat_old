<?php

if(!defined('TH_ROOT')) exit('Nope, Chuck Test.');

class CMS {
	private $db;

	public function __construct(fDatabase $db) {
		$this->db = $db;
	}

	public function getDB() {
		return $this->db;
	}
}

