<?php

/**
 * /foo/bar/baz is the same as /foo/bar/baz/ for all comparisons and arguments.
 */
class URLHandler {
	private $parts;

	public function __construct() {
		$this->parts = explode('/', fRequest::get('q'));
	}

	/**
	 * For the current page /foo/bar/baz/, "baz" is returned.
	 *
	 * @return string Get the most specific part of the URL.
	 */
	public function slug () {
		return end($parts);
	}

	/**
	 * @param bool $implode Join the parts together with a '/'. Returns: "foo/bar/baz".
	 * @return array All the parts of the array. For example: array('foo','bar','baz')
	 */
	public function path ($implode = false) {
		return $implode ? implode('/', $this->parts) : $this->parts;
	}

	/**
	 * Only returns true if the user is on a certain page and that page is passed as the path.
	 *
	 * For example, for the current page "foo", the following $path's would return true:
	 *
	 * <code>foo</code>
	 *
	 * Anything else would return false.
	 *
	 * @param string $path The $path to test the current page against.
	 * @return bool Is the user on a specific page.
	 */
	public function is($path) {
		return trim($path, '/') === implode('/', $this->parts);
	}

	/**
	 * Used to determine if the user is on a certain page or a sub page of certain page.
	 *
	 * If the current page is "/foo/bar/baz" then the following $path's return true:
	 *
	 * <code>foo
	 * foo/bar
	 * foo/bar/baz</code>
	 *
	 * The following return false:
	 *
	 * <code>bar
	 * bar/baz</code>
	 *
	 * @param string $path A relative url such as "admin/pages"
	 * @return bool Is the current page the same as or a child of the given $path
	 */
	public function matches($path) {
		$parts = explode('/', trim($path, '/'));
		return $parts == array_slice($this->parts, 0, count($parts));
	}
}
