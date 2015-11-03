<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'Elfinder/elFinderConnector.class.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'Elfinder/elFinder.class.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'Elfinder/elFinderVolumeDriver.class.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'Elfinder/elFinderVolumeLocalFileSystem.class.php';
//include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'Elfinder/elFinderVolumeMySQL.class.php';

class Elfinder_lib 
{
  public function __construct($opts) 
  {
    $connector = new elFinderConnector(new elFinder($opts));
    $connector->run();
  }
}