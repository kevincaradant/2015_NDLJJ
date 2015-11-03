<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	public $data;
	
	public function __construct()
	{
		parent::__construct();
		/*
		 * Cette variable globale est utilisé pour transmettre 
		 * des infos aux vues via Template::build
		 */
		$this->data = new stdClass;

		if (is_cli() == false) :

		/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		 *
		 * ===> Données Méta pour le template
		 *
		 */

			$this->data->meta = array( 'og:description' => 'Ninfo',
									  'og:image'       => '',
									  'description'    => 'ninfo',
									  'keywords'       => 'ninfo, nuit de l\'info');

			/*
			 * Définit les paramètres et les infos de base du template
			 * quand on est côté front-end.
			 */
			$this->template->set_layout('default');
			$this->template->title($this->config->item('Ninfo'));
			$this->template->set_partial('metadata', 'partials/metadata');
			$this->template->set_partial('header', 'partials/header');
			$this->template->set_partial('footer', 'partials/footer');


		  /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		 *
		 * ===> Verification si l'utisateur (admin) a pris le controle sur un client
		 *
		 *
		 */

		  if( $this->session->has_userdata('id_admin') ){
		  	$this->data->is_take_control = true;
		  }else{
		  	$this->data->is_take_control = false;
		  }

		 /*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		 *
		 * ===> Contrôle de l'accès à l'admin
		 *
		 * Les routes de l'admin commencent toutes par "admin" et les
		 * controllers sont tous préfixés par "Manage_".
		 *
		 */
			if (stripos($this->router->fetch_class(), 'manage') !== false)
			{
				// L'utilisateur doit être connecté et avoir un "user_level" de "9"
				if ( ($this->user_lib->connected() AND $this->user_lib->is_admin() ) OR  $this->session->has_userdata('id_admin'))
				{
					$this->template->title($this->config->item('app_title'));
					$this->template->set_layout('manage');
				}
				else
				{
					redirect(site_url('connexion'));
					exit;
				}
			}


			/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
			 *
			 * ===> Contrôle de l'accès au pages privés (necessite une connexion)
			 *
			 * La seule page disponible hors connexion est l'accueil et la connexion du controleur "accueil" avec la méthode "index" ou "login" ainsi que le page contact
			 *
			 */
			//if( ( $this->router->class != "accueil" ) && ( $this->router->method != "index" || $this->router->method != "login") && !$this->user_lib->connected()){
			/*if (  !( $this->router->class == 'accueil' &&  ( $this->router->method == 'index' || $this->router->method == 'error') ) && !($this->router->class == 'account' && $this->router->method == 'login' ) && !($this->router->class == 'account' && $this->router->method == 'contact' ) && !$this->user_lib->connected() ) {
				redirect(site_url('accueil/page-non-autorise'));
			}*/

		

		endif;
	}
}