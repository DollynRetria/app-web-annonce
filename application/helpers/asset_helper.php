<?php
/*
 * Fonction qui retourne un timesamp d'une date
 */
if ( ! function_exists('dateTime'))
{ 
	function dateTime($date)
	{
		list($year, $month , $day ) = explode('-', $date);
		$timestamp = mktime(0, 0, 0, $month, $day, $year);
		return $timestamp;
	}
}
/*
 * Fonction qui retourne une date en francais
 */

if ( ! function_exists('time2DatetimeFR'))
{
	function time2DatetimeFR($timestamp)
	{
		setlocale(LC_ALL, 'fr_FR', 'french', 'fr', 'fr_FR.ISO8859-1');
		return strftime("%A %d %B %Y",$timestamp);
	}
}

if (!function_exists('asset_url'))
{
	function asset_url()
	{
		$CI =& get_instance();
		return base_url() . $CI->config->item('asset_path');
	}
}
/**
* Get css URL
*
* @access public
* @return string
*/
if (!function_exists('css_url'))
{
	function css_url()
	{
		$CI =& get_instance();
		return base_url() . $CI->config->item('css_path');
	}
}

/**
* Get less URL
*
* @access public
* @return string
*/
if (!function_exists('less_url'))
{
	function less_url()
	{
		$CI =& get_instance();
		return base_url() . $CI->config->item('less_path');
	}
}

/**
* Get js URL
*
* @access public
* @return string
*/
if (!function_exists('js_url'))
{
	function js_url()
	{
		$CI =& get_instance();
		return base_url() . $CI->config->item('js_path');
	}
}

/**
* Get image URL
*
* @access public
* @return string
*/
if ( ! function_exists('img_url'))
{
	function img_url()
	{
		$CI =& get_instance();
		return base_url() . $CI->config->item('img_path');
	}
}

// ------------------------------------------------------------------------
// PATH HELPERS

/**
* Get asset Path
*
* @access public
* @return string
*/
if (!function_exists('asset_path'))
{
	function asset_path()
	{
		$CI =& get_instance();
		return FCPATH . $CI->config->item('asset_path');
	}
}

/**
* Get CSS Path
*
* @access public
* @return string
*/
if (!function_exists('css_path'))
{
	function css_path()
	{
		$CI =& get_instance();
		return FCPATH . $CI->config->item('css_path');
	}
}
/**
* Get JS Path
*
* @access public
* @return string
*/
if (!function_exists('js_path'))
{
	function js_path()
	{
		$CI =& get_instance();
		return FCPATH . $CI->config->item('js_path');
	}
}

/**
* Get image Path
*
* @access public
* @return string
*/
if (!function_exists('img_path'))
{
	function img_path()
	{
		$CI =& get_instance();
		return FCPATH . $CI->config->item('img_path');
	}
}

// ------------------------------------------------------------------------
// EMBED HELPERS

/**
* Load CSS
* Creates the <link> tag that links all requested css file
* @access public
* @param string
* @return string
*/
if (!function_exists('css'))
{
	function css($file, $media='all')
	{
		return '<link rel="stylesheet" type="text/css" href="' . css_url() . $file . '" media="' . $media . '">'."\n";
	}
}



/**
* Load JS
* Creates the <script> tag that links all requested js file
* @access public
* @param string
* @param array $atts Optional, additional key/value attributes to include in the SCRIPT tag
* @return string
*/
if (!function_exists('js'))
{
	function js($file, $atts = array())
	{
		$element = '<script type="text/javascript" src="' . js_url() . $file . '"';
		
		foreach ( $atts as $key => $val )
		$element .= ' ' . $key . '="' . $val . '"';
		$element .= '></script>'."\n";
		
		return $element;
	}
}

/**
* Load Image
* Creates an <img> tag with src and optional attributes
* @access public
* @param string
* @param array $atts Optional, additional key/value attributes to include in the IMG tag
* @return string
*/
if (!function_exists('img'))
{
	function img($file, $atts = array())
	{
		$url = '<img src="' . img_url() . $file . '"';
		foreach ( $atts as $key => $val )
		$url .= ' ' . $key . '="' . $val . '"';
		$url .= " />\n";
		return $url;
	}
}

if ( ! function_exists('dateFR2Time'))
	{ 
		function dateFR2Time($date)
		{
			list($day, $month, $year) = explode('/', $date);
			$timestamp = mktime(0, 0, 0, $month, $day, $year);
			return $timestamp;
		}
	}
if ( ! function_exists('time2DatetimeFR'))
	{
		function time2DatetimeFR($timestamp)
		{
			setlocale(LC_ALL, 'fr_FR', 'french', 'fr', 'fr_FR.ISO8859-1');
			return strftime("%A %d %B %Y",$timestamp);
		}
	}
	
	///tooolsss helpers
if ( ! function_exists('print_die'))
{ 
	function print_die($array = array()){
		echo "<pre>";
		print_r($array);
		echo "</pre>";
	}
}
if ( ! function_exists('truncateWords')){
	function truncateWords($input, $numwords, $padding="") { 
		$output = strtok($input, " \n");
		while(--$numwords > 0)
			$output .= " " . strtok(" \n");
		if($output != $input)
			$output .= $padding;
		return $output; 
	}
}
if (!function_exists('truncate')){
	function truncate($text, $chars = 25) {
		$text = $text." ";
		$text = substr($text,0,$chars);
		$text = substr($text,0,strrpos($text,' '));
		$text = $text."...";
		return $text;
	}
}

