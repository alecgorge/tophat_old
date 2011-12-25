<?php

class ErrorNode extends Node {
	private $code;

	protected function initWithRow(array $row) {
		parent::initWithRow($row);

		$this->code = (int)$this->customValue1();
	}

	public function responseCode() {
		return $this->code;
	}

	public function responseMessage() {
		if($this->code == 404) return "Not Found";
		if($this->code == 403) return "Forbidden";
		if($this->code == 401) return "Unauthorized";
		if($this->code == 500) return "Server Error";
		if($this->code == 410) return "Gone";
	}
}