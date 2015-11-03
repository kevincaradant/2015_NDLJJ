<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('css_path'))
{
	function css_path($file = '', $return = false)
	{
		$CI =& get_instance();

		$url = base_url().$CI->template->get_theme_path().'css/'.$file;

		if ($return)
		{
			return $url;
		}
		else
		{
			echo $url;
		}
	}
}

if ( ! function_exists('js_path'))
{
	function js_path($file = '')
	{
		$CI =& get_instance();

		$url = base_url().$CI->template->get_theme_path() . 'js/' . $file;

		echo $url;
	}
}

if ( ! function_exists('img_path'))
{
	function img_path($file = '')
	{
		$CI =& get_instance();

		$url = base_url().$CI->template->get_theme_path() . 'img/' . $file;

		echo $url;
	}
}

if ( ! function_exists('video_path'))
{
	function video_path($file = '')
	{
		$CI =& get_instance();

		$url = base_url().$CI->template->get_theme_path() . 'video/' . $file;

		echo $url;
	}
}
