<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Retourne l'instance de CodeIgniter
 * 
 * @param void
 * @return &object
 */
function ci()
{
	$CI =& get_instance();

	return $CI;
}



/**
 * Retourne l'URL d'un captcha
 * 
 * @param void
 * @return string URL
 */
function captcha_url()
{
	return site_url('captcha' . md5(time()) . '.jpg');
}

/**
 * Retourne le jeton CSRF
 * 
 * @param void
 * @return string Le jeton
 */
function get_csrf()
{
	$CI =& get_instance();

	return $CI->security->get_csrf_hash();
}

/**
 * Retourne le nom du jeton CSRF
 * 
 * @param void
 * @return string
 */
function get_csrf_name()
{
	$CI =& get_instance();

	return $CI->config->item('csrf_token_name');
}
/**
 * Convertit une date au format d/m/Y en un timestamp
 *
 * @param string $date La date au format d/m/Y
 * @param string $delimiter Le séparateur, par défaut "/"
 * @return int Le timestamp
 */
function date_to_timestamp($date, $delimiter = '/')
{
	list($day, $month, $year) = explode($delimiter, $date);
	return mktime(0, 0, 0, $month, $day, $year);
}

/**
 * Convertit une date en Timestamp
 * 
 * @param int $timestamp Le Timestamp à convertir
 * @param string $format Le format de date sous lequel faire la conversion
 * @return string La data
 */
function timestamp_to_date($timestamp, $format = 'd/m/Y')
{
	if (!empty($timestamp) AND strlen($timestamp) == 10)
	{
		return date($format, $timestamp);
	}

	return date($format, 0);
}

/**
 * Slugify une chaine
 * 
 * @param string La chaîne à slugifier
 * @return string La chaîne slugifiée
 */
function slugify($string)
{
	$sep = '-';

	$string = preg_replace("#[\"\']#", '', $string);

	include (APPPATH.'config/foreign_chars.php');
	
	$string = preg_replace(array_keys($foreign_characters), array_values($foreign_characters), $string);
	$string = preg_replace("#[\.;:'\"\]\?\}\[\{\+\)\(\*&\^\$\#@\!,±`%~']#iu", '', $string);
	$string = preg_replace('/[^\x09\x0A\x0D\x20-\x7E]/', '', $string);
	$string = preg_replace("#[/_|+ -]+#u", '-', $string);
	$string = trim($string, '-');

	$string = strtolower($string);

	return $string;
}

/**
 * Envoi un signal de fin formatté pour de l'AJAX / JSON
 * 
 * @param array $data Le tableau de données à transformer en JSON et à envoyer
 * @param int $code Le code HTTP sous lequel envoyé le résultat
 * @return void
 */
function ajax_output($data, $code = 200)
{
	$ci =& get_instance();

	if (is_array($data))
	{
		$ci->output
			->set_status_header($code)
			->set_header('Access-Control-Allow-Origin: *')
			->set_header('Access-Control-Allow-Methods: GET, POST, OPTIONS')
			->set_header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With')
			->set_header('Access-Control-Allow-Credentials: true')
			->set_content_type('application/json')
			->set_output(json_encode($data))
			->_display();
	}

	exit;
}

/**
 * Divise un tableau en $pieces parties
 * Ex : array_split(array(1,2,3,4,5,6), 2) => array(1,2,3), array(4,5,6)
 *
 * @param array $array Le tableau d'entrée
 * @param int $pieces Le nombre de tableau voulus
 * @return array
 */
function array_split($array, $pieces = 2)
{
	if ($pieces < 2)
	{
		return array($array);
	}

	$newCount = ceil(count($array) / $pieces);

	$a = array_slice($array, 0, $newCount);
	$b = array_split(array_slice($array, $newCount), $pieces - 1);

	return array_merge(array($a), $b);
}

/**
 * Partitionne un tableau
 * Ex : array_part(array(1,2,3,4,5,6), 2) => array(1,3,5), array(2,4,6)
 *
 * @param array $array Le tableau d'entrée
 * @param int $pieces Le nombre de tableau voulus
 * @return array
 */
function array_part($array, $pieces = 2)
{
	if ($pieces < 2)
	{
		return array($array);
	}

	$output = array();

	for ($i = 0; $i < $pieces; $i++)
	{
		$output[$i] = array();
	}

	$i = 0;

	foreach ($array as $key => $value)
	{
		if ($i >= $pieces)
		{
			$i = 0;
		}

		$output[$i][$key] = $value;

		$i++;
	}

	return $output;
}

/**
 * Crée une alerte
 *
 * @param string $message Le message de l'alerte
 * @param string $type Définie le type d'alerte, peut être utilisé pour ajouter une classe HTML
 * @param bool $flash Si true, l'alerte sera affichée une fois avant d'être détruite
 * @return void
 */
function alert($message, $type = 'success', $flash = false)
{
	// Petite rétro-compatibilité avec Bootstrap.
	// Type utilisable avec Bootstrap : danger, success, info
	if ($type != 'success')
	{
		// Si "error" est renseigné on le transforme en "danger"
		$type = ($type == 'error') ? 'danger' : $type;
	}

	if ($flash)
	{
		ci()->session->set_userdata('flash:old:alert', $message);
		ci()->session->set_userdata('flash:old:alert-type', 'alert-'.$type);
	}
	else
	{
		ci()->session->set_flashdata('alert', $message);
		ci()->session->set_flashdata('alert-type', 'alert-'.$type);
	}
}

/**
 * Retourne la version de PHP sous forme numéraire.
 * Utile pour les comparaisons.
 *
 * @param void
 * @return int La version de PHP. Ex : 53028 pour PHP 5.3.28
 */
function php_id()
{
	if (!defined('PHP_VERSION_ID'))
	{
		$version = explode('.', PHP_VERSION);
		define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
	}

	return PHP_VERSION_ID;
}

/**
 * Pluralise un mot
 * @param string $word Le mot à pluraliser.
 * @param int $value La valeur servant à définir si le mot doit être pluralisé.
 * @param string $end La chaîne qui est ajoutée pour la pluralisation;
 * @return mixed
 */
function pluralize($word, $value = 0, $end = 's')
{
	if ($value > 1)
	{
		return $word.$end;
	}
	else
	{
		return $word;
	}
}