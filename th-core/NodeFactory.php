<?php

class NodeFactory {
	private $handles = array();

	public function register($type, $callback) {
		$this->handles[$type] = $callback;
	}

	public function create($type, array $row) {
		return call_user_func($this->handles[$type], $row);
	}
}