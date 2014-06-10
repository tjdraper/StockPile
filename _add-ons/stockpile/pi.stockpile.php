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
			if ($parse_tags == 'yes') {
				$content = Parse::template($content, array());
			}

			// Save the content to the blink cache
			$this->blink->set($name, $content);
		}

	}

	public function get() {
		// Get params
		$name = $this->fetchParam('name');

		// Return the value
		return $this->blink->get($name);
	}
}
