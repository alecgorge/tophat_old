<?php

class Node {
	private $cms;
	private $row;

	private $dateAdded;
	private $dateModified;
	private $datePublished;
	private $publishDate;

	public function __construct(TopHat $cms, $pathOrId) {
		$this->cms = $cms;

		if(is_array($pathOrId)) { // init with row
			$this->initWithRow($pathOrId);
		}
		else { // init with id or path
			$this->initWithRow($this->cms->content()->getRow($pathOrId));
		}
	}

	protected function initWithRow(array $row) {
		$this->row = $row;

		$this->dateAdded = new fTimestamp($this->row['date_added']);
		$this->dateModified = new fTimestamp($this->row['date_modified']);
		$this->datePublished = new fTimestamp($this->row['date_published']);
		$this->publishDate = new fTimestamp($this->row['publish_date']);
	}

	public function row($key) {
		return $this->row[$key];
	}

	/**
	 * @return string
	 */
	public function title() {
		return $this->row('title');
	}

	public function setTitle($newTitle) {
		$this->row['title'] = $newTitle;
	}

	public function setContent($newContent) {
		$this->row['content'] = $newContent;
	}

	/**
	 * @return string
	 */
	public function content() {
		return $this->row('content');
	}

	/**
	 * @return fTimestamp
	 */
	public function dateAdded() {
		return $this->dateAdded;
	}

	/**
	 * @return fTimestamp
	 */
	public function dateModified() {
		return $this->dateModified;
	}

	public function setDateAdded(fTimestamp $t) {
		$this->dateAdded = $t;
	}

	/**
	 * @return fTimestamp
	 */
	public function datePublished() {
		return $this->datePublished;
	}

	public function setDatePublished(fTimestamp $t) {
		$this->datePublished = $t;
	}

	public function setDateModified(fTimestamp $t) {
		$this->dateModified = $t;
	}

	public function type() {
		return $this->row('type');
	}

	public function slug() {
		return $this->row('slug');
	}

	public function setSlug($newSlug) {
		return $this->row['slug'] = $newSlug;
	}

	/**
	 * @return fTimestamp
	 */
	public function publishDate() {
		return $this->publishDate;
	}

	public function setPublishDate(fTimestamp $t) {
		$this->publishDate = $t;
	}

	public function customValue1() {
		return $this->row('custom_1');
	}

	public function customValue2() {
		return $this->row('custom_2');
	}

	public function setCustomValue1($v) {
		$this->row['custom_1'] = $v;
	}

	public function setCustomValue2($v) {
		$this->row['custom_2'] = $v;
	}

	public function id() {
		return $this->row('id');
	}

	/**
	 * @return int
	 */
	public function responseCode() {
		return 200;
	}

	/**
	 * @return string
	 */
	public function responseMessage() {
		return "OK";
	}

	/**
	 * @return array
	 */
	public function headers() {
		return array();
	}
}
