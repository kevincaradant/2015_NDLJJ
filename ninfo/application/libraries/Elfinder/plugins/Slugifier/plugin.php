<?php

/**
 * elFinder Plugin Slugifier
 *
 * @package elfinder
 * @author Marceau Casals
 * @license New BSD
 */

class elFinderPluginSlugifier
{
	private $opts = array();
	
	public function __construct($opts)
	{
		$defaults = array('enable' => true);

		$this->opts = array_merge($defaults, $opts);
	}
	
	public function cmdPreprocess($cmd, &$args, $elfinder, $volume)
	{
		$opts = $this->getOpts($volume);
		
		if (! $opts['enable'])
		{
			return false;
		}
	
		if (isset($args['name']))
		{
			$args['name'] = $this->slugify($args['name'], $opts);
		}

		return true;
	}

	public function onUpLoadPreSave(&$path, &$name, $src, $elfinder, $volume)
	{
		$opts = $this->getOpts($volume);

		if (! $opts['enable'])
		{
			return false;
		}
	
		if ($path)
		{
			$path = $this->slugify($path, $opts, array('/'));
		}

		$name = $this->slugify($name, $opts);
		
		return true;
	}
	
	private function getOpts($volume)
	{
		$opts = $this->opts;

		if (is_object($volume))
		{
			$volOpts = $volume->getOptionsPlugin('Slugifier');

			if (is_array($volOpts))
			{
				$opts = array_merge($this->opts, $volOpts);
			}
		}
		return $opts;
	}
	
	private function slugify($string, $opts)
	{
		$sep = '-';

		$string = preg_replace("#[\"\']#", '', $string);

		include (APPPATH.'config/foreign_chars.php');
		
		$string = preg_replace(array_keys($foreign_characters), array_values($foreign_characters), $string);
		$string = preg_replace("#[\;:'\"\]\?\}\[\{\+\)\(\*&\^\$\#@\!,±`%~']#iu", '', $string);
		$string = preg_replace('/[^\x09\x0A\x0D\x20-\x7E]/', '', $string);
		$string = preg_replace("#[/_|+ -]+#u", '-', $string);
		$string = trim($string, '-');

		$string = strtolower($string);

		return $string;
  	}
}
