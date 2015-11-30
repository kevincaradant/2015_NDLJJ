<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_users extends MY_Controller
{
	// Statut des news
	public $status = array('0' => 'Brouillon',
		'1' => 'En ligne');

	/**
	 * Constructeur de la classe
	 *
	 * @param void
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');

		$this->load->library('form_validation');
		$this->load->library('email');
	}

	/**
	 * Tableau de bord de l'admin des utilisateurs
	 *
	 * @return [views:manage/users/index]
	 */
	public function index()
	{

		$this->data->users =  $this->user_model->get_all();


		$this->template->set('page_title', 'Gestion des clients');
		$this->template->set_layout('manage');
		$this->template->build('views/manage/users/index', $this->data);


	}

	public function remove($id_user)
	{
		$data_to_update['deleted'] = 1;
		$this->user_model->update($id_user , $data_to_update);
	}	

	public function send_mail($id_client){
		if($this->user_model->get_once_by_id($id_client)){

			$user = $this->user_model->get_once_by_id($id_client);

			$temp_password = substr(md5(time()), 0, 10);
			$data = array(
				'password' => $this->user_lib->hash($temp_password)
			);

			if ($this->user_model->update($id_client,$data) === true) {
				$this->user_model->update($id_client,$data);

				$data['firstname'] = $user->firstname;
				$data['lastname'] = $user->lastname;
				$data['email'] =  $user->email;
				$data['temp_password'] = $temp_password;
				$data['id'] = $id_client;
				$message_mail = $this->template->set_layout('mail')->build('views/manage/mail/registrer', $data, TRUE);

				$config_email = array(
					'protocol' => 'mail',
					'charset' => 'utf-8',
					'mailtype' => 'html'
				);
				$this->email->initialize($config_email);

				//On envoi le mail:

				$this->email->from('internet@gmail.com');
				$this->email->to($user->email);
				$this->email->subject('Vous êtes invités sur le site Agencora');
				$this->email->message($message_mail);

				$this->email->send();

				alert("Un mail a été envoyé; Regardez votre boite mail", 'success', true);
			} else {
				alert("Impossible de valider l'inscription pour le moment. Veuillez réessayer ultérieurement.", 'error', true);
			}
		}else{
			alert("Impossible de valider l'inscription pour le moment. Veuillez réessayer ultérieurement.", 'error', true);
		}
		redirect('admin/clients');
	}

	public function add()
	{

		//$this->data->entreprises = $this->entreprise_model->get_all();


		if ($this->input->post('user_add_form') == 'sent'){
			$rules = array(
				array(
					'field' => 'email',
					'label' => 'Adresse email',
					'rules' => 'required',
				),
				array(
					'field' => 'prenom',
					'label' => 'Prénom',
					'rules' => 'required',
				),
				array(
					'field' => 'nom',
					'label' => 'Nom',
					'rules' => 'required',
				));

			$this->form_validation->set_rules($rules);

				if ($this->form_validation->run() === true) {

					if($this->user_model->get_once_by('email',$this->input->post('email')) === false) {
						//Generation du mots de passe temporaire:
						$temp_password = substr(md5(time()),0,10);

						$data = array(
							'email' => trim(strtolower($this->input->post('email'))),
							'firstname' => trim(ucwords(strtolower($this->input->post('prenom')))),
							'lastname' => trim(ucwords(strtolower($this->input->post('nom')))),
							'address' => trim(strtolower($this->input->post('adress'))),
							'level' => 1,
							'password' =>  $this->user_lib->hash($temp_password)
						);



						if ($this->user_model->add($data) === true) {

							$data['id'] = $this->user_model->get_once_by('email',$this->input->post('email'))->id;

							//On créé les relations user/entreprise
							//$entreprises_user = $this->input->post('entreprises');

							//$this->user_model->update_relation_entreprise_user($entreprises_user,$data['id']);

							//On edite le message du mail

							

							$data['temp_password'] = $temp_password;
							$data['message_mail'] = $this->input->post('message_mail');
							$message_mail = $this->template->set_layout('mail')->build('views/manage/mail/registrer', $data, TRUE);
							/*
							'smtp_host' => 'SSL0.OVH.NET',
							'smtp_user' => 'internet@agencora.fr',
							'smtp_pass' => 'de664bae1630c04',
							'smtp_port' => '5025',
							*/

							$config_email = array(
								'protocol' => 'mail',
								'charset' => 'utf-8',
								'mailtype' => 'html'
							);
							$this->email->initialize($config_email);



							//On envoi le mail:

							$this->email->from('internet@gmail.com');
							$this->email->to(trim(strtolower($this->input->post('email'))));
							$this->email->subject('Vous êtes invités sur le site Agencora');
							$this->email->message($message_mail);
							$this->email->send();

							alert("Un mail a été envoyé. Regardez votre boite mail", 'success', true);
						} else {
							alert("Impossible de valider l'inscription pour le moment. Veuillez réessayer ultérieurement.", 'error', true);
						}
					}else{
						alert("Ce mail :" . $this->input->post('email') . " est déjà inscrit dans la base de donnée!", 'error', true);
						}
				} else {
					alert(validation_errors('- ', '<br />'),'error',true);
				}
			}
		$this->template->set('page_title', 'Ajouter un client');
		$this->template->set_layout('manage');
		$this->template->build('views/manage/users/add', $this->data);
	}

	public function update($id_client){

		//$this->data->entreprises = $this->entreprise_model->get_all();

		if($this->user_model->get_once_by_id($id_client)){


			if ($this->input->post('user_update_form') == 'sent') {
				$rules = array(
					array(
						'field' => 'email',
						'label' => 'Adresse email',
						'rules' => 'required',
					),
					array(
						'field' => 'prenom',
						'label' => 'Prénom',
						'rules' => 'required',
					),
					array(
						'field' => 'nom',
						'label' => 'Nom',
						'rules' => 'required',
					));


				$this->form_validation->set_rules($rules);

				if ($this->form_validation->run() === true) {

					//Generation du mots de passe temporaire:
					$temp_password = substr(md5(time()), 0, 10);
					$data = array(
						
						'firstname' => trim(ucwords(strtolower($this->input->post('prenom')))),
						'lastname' => trim(ucwords(strtolower($this->input->post('nom')))),
						'email' => trim(strtolower($this->input->post('email'))),
						'password' => $this->user_lib->hash($temp_password)
					);
					if ($this->user_model->update($id_client,$data) === true) {
						$this->user_model->update($id_client,$data);

						//On update les relations user/entreprise
						//$entreprises_user = $this->input->post('entreprises');

						//$this->user_model->update_relation_entreprise_user($entreprises_user,$id_client);


						alert("Le compte a bien été modifié", 'success', true);

					}else{
						alert("Impossible de modifier ce compte pour le moment. Veuillez réessayer ultérieurement.", 'error');
					}
				}else{
					alert("Les données sont mauvaises.", 'error', true);
				}
			}
		}else{
			alert("Une erreur s'est produite.", 'error', true);
		}
		$this->data->user = $this->user_model->get_once_by_id($id_client);
		$this->template->set('page_title', 'Modifier un client');
		$this->template->set_layout('manage');
		$this->template->build('views/manage/users/update', $this->data);
	}

	public function change_client()
	{
		if ($this->input->post('prendre-main') == 'sent'){
			//On stock en session l'ancien id, c-a-d celui de l'administrateur
			$this->session->set_userdata(array('id_admin' => $this->user_lib->user->id) );	

			//Ensuite on change l'user actuel
			if( $this->user_model->get_once_by_id( $this->input->post('id_user_to_control') ) ){
				$this->user_lib->connect_by_id($this->input->post('id_user_to_control'));
				alert('Vous avez pris la main sur le client: '.$this->user_lib->user->fullname);
				redirect(site_url());
			}else{
				alert('L\'utilisateur demandé n\'existe pas', 'error', true);
			}
		}

		$this->data->users = $this->user_model->back_get_all();
		$this->template->set('page_title', 'Prendre le controle sur un client');
		$this->template->set_layout('manage');
		$this->template->build('views/manage/users/change_user', $this->data);

			

	}
	public function stop_change_client()
	{
		if( $this->session->has_userdata('id_admin') ){
			$this->user_lib->connect_by_id( $this->session->userdata('id_admin') );
			$this->session->unset_userdata('id_admin');
			alert('Vous avez arreter la prise en main');
			redirect(site_url());
		}

	}


}