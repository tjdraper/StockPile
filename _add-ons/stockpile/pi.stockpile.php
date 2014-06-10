<?php
class Plugin_stockpile extends Plugin
{
	var $meta = array(
		'name' => 'StockPile',
		'version' => '1.0.0',
		'author' => 'TJ Draper',
		'author_url' => 'http://buzzingpixel.com'
	);

	public function set() {
		// Get params
		$name = $this->fetchParam('name');
		$parse_tags = $this->fetchParam('parse_tags');

		// Get the content
		$content = ($this->fetchParam('content') == '') ? $this->content : $this->fetchParam('content');

		if ($content != '' AND $name != '') {
			// If parsing tags
			if ($parse_tags == 'yes' AND $content != '') {
				$content = Parse::template($content, array());
			}

			// Set the content as a super global
			$GLOBALS['stockpile_' . $name] = $content;
		}

	}

	public function get() {
		// Get params
		$name = $this->fetchParam('name');

		// Make sure the thing we're trying to get exists so no errors are thrown, then return that content
		if ($name != '' AND isset($GLOBALS['stockpile_' . $name]) == true) {
			return $GLOBALS['stockpile_' . $name];
		}
	}
}
