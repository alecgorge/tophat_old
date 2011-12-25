<?php

if(!defined('TH_ROOT')) exit('Nope, Chuck Testa.');

class TopHat {
	private $db;
	private $urlHandler;
	private $themeManager;
	private $settings;
	private $contentManager;
	private $nodeFactory;

	/**
	 * @param fDatabase $db The database connection to use for the site.
	 */
	public function __construct(fDatabase $db) {
		$this->db = $db;
		$this->db()->connect();

		$this->urlHandler = new URLHandler();
		$this->themeManager = new ThemeManager($this);
		$this->settings = new Settings($this->db());
		$this->contentManager = new ContentManager($this);
		$this->nodeFactory = new NodeFactory();

		$this->nodeFactory->register('page', array($this, 'createPage'));
		$this->nodeFactory->register('error-page', array($this, 'createErrorPage'));
	}

	public function createPage (array $row) {
		return new Node($this, $row);
	}

	public function createErrorPage (array $row) {
		return new ErrorNode($this, $row);
	}

	/**
	 * @return NodeFactory The NodeFactory instance to bind to.
	 */
	public function nodeFactory() {
		return $this->nodeFactory;
	}

	/**
	 * @return ContentManager The current ContentManager instance.
	 */
	public function content() {
		return $this->contentManager;
	}

	/**
	 * @return fDatabase The active fDatabase instance for the current site. Already connected.
	 */
	public function db() {
		return $this->db;
	}

	/**
	 * @return Settings The active settings instance.
	 */
	public function settings() {
		return $this->settings;
	}

	/**
	 * @return URLHandler The URLHandler for the current page.
	 */
	public function urlHandler () {
		return $this->urlHandler;
	}

	/**
	 * @return ThemeManager The ThemeManager instance for the current TopHat instance.
	 */
	public function themeManager() {
		return $this->themeManager;
	}
}

