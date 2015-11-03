<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('img_url'))
{
	function img_asset_url($img, $echo = TRUE)
	{
       $url = base_url() . 'assets/img/' . $img;
                
        if ($echo === TRUE)
        {
            echo $url;
        }
        else
        {
            return $url;
        }
	}
}

if ( ! function_exists('js_url'))
{
    function js_asset_url($js, $echo = TRUE)
    {
       $url = base_url() . 'assets/js/' . $js;
                
        if ($echo === TRUE)
        {
            echo $url;
        }
        else
        {
            return $url;
        }
    }
}

if ( ! function_exists('css_url'))
{
    function css_asset_url($css, $echo = TRUE)
    {
       $url = base_url() . 'assets/css/' . $css;
                
        if ($echo === TRUE)
        {
            echo $url;
        }
        else
        {
            return $url;
        }
    }
}

if ( ! function_exists('asset_url'))
{
    function asset_url($asset, $echo = TRUE)
    {
       $url = base_url() . 'assets/' . $asset;
                
        if ($echo === TRUE)
        {
            echo $url;
        }
        else
        {
            return $url;
        }
    }
}

if ( ! function_exists('elfinder_css_url'))
{
    function elfinder_css_url($css, $echo = TRUE)
    {
       $url = base_url() . 'assets/elfinder/css/' . $css;
                
        if ($echo === TRUE)
        {
            echo $url;
        }
        else
        {
            return $url;
        }
    }
}

if ( ! function_exists('elfinder_js_url'))
{
    function elfinder_js_url($asset, $echo = TRUE)
    {
       $url = base_url() . 'assets/elfinder/js/' . $asset;
                
        if ($echo === TRUE)
        {
            echo $url;
        }
        else
        {
            return $url;
        }
    }
}

