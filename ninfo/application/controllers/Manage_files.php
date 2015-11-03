<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_files extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function connector()
	{
		$this->load->helper('path');

		$opts = array(
			'debug' => true,
			'bind' => array(
				'mkdir.pre mkfile.pre rename.pre' => array('Plugin.Slugifier.cmdPreprocess'),
				'upload.presave' => array('Plugin.Slugifier.onUpLoadPreSave')
			),
			'plugin' => array(
				'Sanitizer' => array(
				    'enable' => true,
				    'targets'  => array('\\','/',':','*','?','"','<','>','|'), 
				    'replace'  => '_'
				),
				'Slugifier' => array(
				    'enable' => true,
				)
			)
		);

		$opts['roots'] = array(
			array(
				'driver' => 'LocalFileSystem',
				'alias' => 'Racine',
				'path' => set_realpath('assets/files'),
				'URL' => site_url('assets/files') . '/',
				'mimeDetect' => 'internal',
				'uploadOverwrite' => false,
				'uploadAllow' => array('image', 'application/pdf', "application/vnd.openxmlformats-officedocument.wordprocessingml.document"),
				'attributes' => array(
					array(
						'pattern' => '/\.tmb$/',
						'read' => false,
						'write' => false,
						'hidden' => true,
						'locked' => false
					),
					array(
						'pattern' => '/\.quarantine$/',
						'read' => false,
						'write' => false,
						'hidden' => true,
						'locked' => false
					),
					array(
						'pattern' => '/\.html$/',
						'read' => false,
						'write' => false,
						'hidden' => true,
						'locked' => false
					),
				)
			)
		);

		$this->load->library('elfinder_lib', $opts);
	}

	public function form_select()
	{
		$this->template->set_layout('elfinder');
		$this->template->build('views/elfinder/form_select');
	}

	public function tinymce()
	{
		$this->template->set_layout('elfinder');
		$this->template->build('views/elfinder/tinymce');
	}

	public function index()
	{
		$this->template->set('page_title', 'Gestion des fichiers');
		$this->template->build('views/elfinder/full');
	}
}
