<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller
{
	/**
	 * Constructeur de la classe du controller
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');

	    $this->load->model('user_model');
	    $this->load->library('email');

		$this->template->set_layout('default');
	}

	/**
	 * Index du module
	 */
	public function index()
	{
		$this->login();
	}

	/**
	 * Page de connexion
	 *
	 * @return mixed [views:account/login]
	 */
	public function login($id = false, $mdp = false)
	{
		// L'utilisateur est-il connecté ?
		if ($this->user_lib->connected() === false)
		{
			// Le formulaire est-il envoyé ?
			if ($this->input->post('user_email') !== null)
			{
				$rules = array(
					array(
						'field' => 'user_email',
						'label' => 'Adresse email',
						'rules' => 'required|trim'
					),
					array(
						'field' => 'user_password',
						'label' => 'Mot de passe',
						'rules' => 'required|trim'
					)
				);

				$this->form_validation->set_rules($rules);

				// Le formulaire est-il valide ?
				if ($this->form_validation->run() === true)
				{
					if ($this->user_lib->login(strtolower($this->input->post('user_email')),
											   $this->input->post('user_password')) === true)
					{
						alert("Vous êtes désormais connectés !", 'success');

						if ($this->input->post('user_persist') == '1')
						{
							$this->user_lib->create_persistent_connexion();
						}

						$last_page = $this->session->userdata('last_page');

						//on verifie qu'il ne doit pas changer son mdp temporaire
						$this->user_lib->check_acces_front();

						$redirect_uri = 'accueil';

						if ($this->user_lib->user->user_level == 9)
						{
							$redirect_uri = 'admin';
						}

						redirect(site_url($redirect_uri));
					

					}
					else
					{
						alert("Les informations de connexion saisies sont incorrectes.", 'error');
						redirect(site_url('connexion'));
					}
				}
				else
				{
					alert('Oops, il y\'a une erreur :<br>'.validation_errors('- ', '<br />'), 'error', true);
				}
			}else{
				//on verifie si on utilise pas le pseudo lien d'auto-log
				if( $id & $mdp)
				{
					$this->data->user_email = $this->user_model->get_once_by_id($id)->email;
					$this->data->user_password = $mdp;
				}
			}

			$this->template->build('views/account/login', $this->data);
			
		}
		else
		{
			alert("Vous êtes déjà connectés !", false, 'error');
			redirect(site_url('accueil'));
		}
	}

	/**
	* Contact
	*
	*@return [views:account/contact]
	*
	*/
	public function contact()
	{

		if ($this->input->post('do_contact') == 'sent'){
			$rules = array(
				array(
					'field' => 'name',
					'label' => 'Name',
					'rules' => 'required',
				),
				array(
					'field' => 'telephone',
					'label' => 'Téléphone',
					'rules' => 'required',
				),
				array(
					'field' => 'email',
					'label' => 'Adresse email',
					'rules' => 'required',
				),
				array(
					'field' => 'message',
					'label' => 'Message',
					'rules' => 'required',
				));

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run() === true) {

				$data = array(
					'name' => trim(strtolower($this->input->post('name'))),
					'email' => trim(strtolower($this->input->post('email'))),
					'telephone' => trim(ucwords(strtolower($this->input->post('telephone')))),
					'message' => trim(strtolower($this->input->post('message'))),
				);

				//On edite le message du mail

				$message_mail = $this->template->set_layout('mail')->build('views/mail/contact', $data, TRUE);

				$config_email = array(
					'protocol' => 'mail',
					'charset' => 'utf-8',
					'mailtype' => 'html'
				);
				$this->email->initialize($config_email);

				//On envoi le mail:

				$this->email->from('MySource@gmail.com');
				$this->email->to('Myemail@gmail.com');
				$this->email->subject('Subject');
				$this->email->message($message_mail);

				$this->email->send();

				alert("Votre demande a bien été envoyé, merci et à bientôt.", 'success', true);
		
			} else {
				alert(validation_errors('- ', '<br />'),'error',true);
			}
		}

		$this->template->set_layout('default');
		$this->template->title('Contact', $this->config->item('app_title'));
		$this->template->set('page_title', 'Contact');
		$this->template->build('views/account/contact', $this->data);
	}



	/**
	 * mon compte
	 *
	 * @return [views:account/update]
	 */
	public function update()
	{
		if ($this->input->post('update_form') == 'sent')
		{
			$rules = array(
				
				array(
					'field' => 'user_firstname',
					'label' => 'Prénom',
					'rules' => 'required|trim|min_length[2]|max_length[100]',
				),
				array(
					'field' => 'user_lastname',
					'label' => 'Nom',
					'rules' => 'required|trim|min_length[2]|max_length[100]',
				),
				array(
					'field' => 'user_address',
					'label' => 'Adresse',
					'rules' => 'trim|min_length[5]|max_length[255]',
				),
			);

			if ($this->input->post('user_update_password') == 1)
			{
				$rules[] = array(
					'field' => 'user_current_password',
					'label' => 'Mot de passe actuel',
					'rules' => 'differs[user_password]|required|callback_check_password'
				);

				$rules[] = array(
					'field' => 'user_password',
					'label' => 'Nouveau mot de passe',
					'rules' => 'required|trim',
				);

				$rules[] = array(
					'field' => 'user_password_confirm',
					'label' => 'Confirmation du nouveau mot de passe',
					'rules' => 'required|trim|matches[user_password]',
				);
			}

			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run() === true)
			{
				$data = array(
					'lastname' => ucwords(strtolower($this->input->post('user_lastname'))),
					'firstname' => ucwords(strtolower($this->input->post('user_firstname'))),
					'address' => ucwords(strtolower($this->input->post('user_address'))),
				);

				if ($this->input->post('user_update_password') == 1)
				{
					$data['password'] = $this->user_lib->hash($this->input->post('user_password'));
				}

				if ($this->user_model->update($this->user_lib->user->id, $data))
				{
					alert("Votre compte a correctement été mis à jour " . $data['firstname'], 'success');
				}
				else
				{
					alert("Impossible de modifier votre compte pour le moment. Veuillez réessayer ultérieurement.", 'error');
				}

				redirect(site_url('mon-compte'));
			}
			else
			{
				alert('Oups, il y\'a une erreur :<br>'.validation_errors('- ', '<br />'), 'error', true);
			}
		}

		$this->template->title('Mon compte', $this->config->item('app_title'));
		$this->template->set('page_title', 'Mon compte');
		$this->template->build('views/account/update', $this->data);
	}

	/**
	 * Page d'inscription
	 *
	 * @return [views:account/register]
	 */
	public function register()
	{
		if ($this->input->post('register_form') == 'sent')
		{
			$rules = array(
				array(
					'field' => 'user_email',
					'label' => 'Adresse email',
					'rules' => 'required|trim|xss_clean|valid_email|is_unique[users.user_email]',
				),
				array(
					'field' => 'user_password',
					'label' => 'Mot de passe',
					'rules' => 'required|trim|xss_clean',
				),
				array(
					'field' => 'user_password_confirm',
					'label' => 'Confirmation du mot de passe',
					'rules' => 'required|trim|xss_clean|matches[user_password]',
				),
				array(
					'field' => 'user_firstname',
					'label' => 'Prénom',
					'rules' => 'required|trim|xss_clean|min_length[2]|max_length[100]',
				),
				array(
					'field' => 'user_lastname',
					'label' => 'Nom',
					'rules' => 'required|trim|xss_clean|min_length[2]|max_length[100]',
				),
				array(
					'field' => 'user_address',
					'label' => 'Adresse',
					'rules' => 'required|trim|xss_clean|min_length[5]|max_length[255]',
				),
				/*array(
					'field' => 'user_captcha',
					'label' => 'Code de sécurité',
					'rules' => 'required|trim|xss_clean|callback_check_captcha',
				),*/
			);

			$this->form_validation->set_message('is_unique', "Un compte utilisant cette adresse email existe déjà.");
			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run() === true)
			{
				$data = array(
					'user_email' => strtolower($this->input->post('user_email')),
					'user_password' => $this->user_lib->hash($this->input->post('user_password')),
					'user_lastname' => ucwords(strtolower($this->input->post('user_lastname'))),
					'user_firstname' => ucwords(strtolower($this->input->post('user_firstname'))),
					'user_date_register' => time(),
					'user_level' => 1
				);

				if ($this->user_model->add($data) === true)
				{
					$this->user_lib->connect($this->input->post('user_email', true));
					$message  = "Bienvenue sur le site <strong>" . $data['user_firstname'] . "</strong> !<br>";
					$message .= "Pour plus de confort, vous avez été connecté automatiquement.<br>";
					$message .= "Bonne visite !";
					alert($message, 'success');
					redirect(site_url('accueil'));
				}
				else
				{
					alert("Impossible de valider l'inscription pour le moment. Veuillez réessayer ultérieurement.", 'error', true);
				}
			}
			else
			{
				alert('Oups, il y\'a une erreur :<br>'.validation_errors('- ', '<br />'), 'error', true);
			}
		}

		$this->template->title('Inscription', $this->config->item('app_title'));
		$this->template->set('page_title', 'Inscription');
		$this->template->build('views/account/register', $this->data);
	}

	/**
	 * Page de déconnexion
	 *
	 * @param string $token Le jeton de sécurité CSRF
	 * @return [redirect:home/homepage]
	 */
	public function logout()
	{

			$this->user_lib->logout();
			alert("Vous avez été déconnecté !");
			$this->session->sess_destroy();
			redirect(site_url());
	}




	/**
	 * forgot_password
	 *
	 * Page de mot de passe oublié
	 *
	 * @param void
	 * @return [views:views/account/forgot_password]
	 */
	public function forgot_password()
	{
		if ($this->input->post('forgot_password_form'))
		{
			$identifier       = $this->input->post('forgot_password_identifier');
			$this->data->user = $this->user_model->get_once_by('email', $identifier);

			$time = time();

			if ($this->data->user != false)
			{
				$key = $this->user_model->add_forgot_password($this->data->user->user_id, $time);

				$params = array(
					'autologin_url'  => site_url('password-recovery/'.$key),
					'autologin_text' => 'Changer mon mot de passe',
					'user_fullname'  => $this->data->user->user_fullname,
					'form_validity'  => date(DATE_FORMAT, $time + FORGOT_PASS_VALIDITY),
					'email'			 => $this->data->user->user_email,
				);

				$this->load->library('daemon');
				$this->daemon->sync()->task('email_mail_forgot_password', $params);
			}

			alert("Si ce compte existe, un email de changement de mot de passe lui a été envoyé !", 'info');
			redirect(site_url('connexion'));
		}

		$this->template->title('Mot de passe oublié', $this->config->item('app_title'))
					   ->set('page_title', 'Mot de passe oublié')
					   ->build('views/account/forgot_password', $this->data);
	}

	/**
	 * password_recovery
	 *
	 * Formulaire de changement de mot de passe
	 *
	 * @param string $key La clé utilisateur de changement de mot de passe
	 */
	public function password_recovery($key)
	{
		if (empty($key))
		{
			redirect(site_url('connexion'));
		}

		$this->data->user = $this->user_model->get_once_by('forgot_password_key', $key);

		if ($this->data->user == false
			OR empty($this->data->user->user_forgot_password_key)
			OR $this->data->user->user_forgot_password_date < time())
		{
			alert("Le formulaire de changement de mot de passe a expiré !", 'info');
			redirect(site_url('connexion'));
		}
		else
		{
			if ($this->input->post('password_recovery_form'))
			{
				$rules = array(
					array(
						'field' => 'new_password',
						'label' => 'Nouveau mot de passe',
						'rules' => 'required|trim|xss_clean',
					),
					array(
						'field' => 'new_password',
						'label' => 'Nouveau mot de passe',
						'rules' => 'required|trim|xss_clean|matches[new_password]',
					),
				);

				$this->form_validation->set_rules($rules);

				if ($this->form_validation->run() === true)
				{
					$this->user_model->update_password($this->data->user->user_id, $this->input->post('new_password'));
					$this->user_model->reset_forgot_password($this->data->user->user_id);

					$params = array(
						'autologin_url'  => site_url('connexion'),
						'autologin_text' => "Accèder au site du Stade Toulousain",
						'user_fullname'  => $this->data->user->user_fullname,
						'user_email'	 => $this->data->user->user_email,
						'email'			 => $this->data->user->user_email,
					);

					$this->load->library('daemon');
					$this->daemon->sync()->task('email_mail_password_recovery', $params);
					$this->user_lib->connect($this->data->user->user_email);

					alert("Votre mot de passe a bien été changé ! Pour votre confort, vous avez été connectés automatiquement.", 'success');
					redirect(site_url('accueil'));
				}
				else
				{
					alert('Oups, il y\'a une erreur :<br>'.validation_errors('- ', '<br />'), 'error', true);
				}
			}

			$this->template->title('Changement de mot de passe', $this->config->item('app_title'))
						   ->set('page_title', 'Changement de mot de passe')
						   ->build('views/account/password_recovery', $this->data);
		}
	}



	public function change_mdp_temp(){
		if($this->user_lib->user->active == 0){
			if ($this->input->post('change_mdp_temps_form') == 'sent') {

				$rules[] = array(
					'field' => 'password_acces',
					'label' => 'Mot de passe actuel',
					'rules' => 'differs[password]|required|callback_check_password_temp'
				);

				$rules[] = array(
					'field' => 'password',
					'label' => 'Nouveau mot de passe',
					'rules' => 'required|trim',
				);

				$rules[] = array(
					'field' => 'password_repeat',
					'label' => 'Confirmation du nouveau mot de passe',
					'rules' => 'required|trim|matches[password]',
				);

				$this->form_validation->set_rules($rules);

				if ($this->form_validation->run() === true)
				{
					$data['password'] = $this->user_lib->hash($this->input->post('password'));
					$data['active'] = 1;

					if ($this->user_model->update($this->user_lib->user->id, $data))
					{
						alert("Votre compte a correctement été mis à jour " . $data['firstname'] . " vous pouvez donéravant utiliser l'intranet", 'success');
					}
					else
					{
						alert("Impossible de modifier votre compte pour le moment. Veuillez réessayer ultérieurement.", 'error');
					}

					redirect(site_url('mon-compte'));
				}else{
					alert("Vos données ne sont pas bonnes".validation_errors(), 'error');
				}
			}else{
				alert('Votre mots de passe n\'est pas correct', 'error');
			}


			$this->template->title('Changement du mot de passe temporaire', $this->config->item('app_title'))
						   ->build('views/account/change_mdp_temp', $this->data);

		}else{
			redirect(site_url('mon-compte'));
		}
	}


	/**
	 * Vérifie le mot de passe actuel
	 * Callback de Form_validation
	 *
	 * @param int $str Le mot de passe à valider
	 */
	public function check_password($str)
	{
		if ($this->user_lib->user->password === $this->user_lib->hash($str))
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('check_password', "Le mot de passe actuel est invalide");
			return false;
		}
	}

	/**
	 * Vérifie le mot de passe actuel
	 * Callback de Form_validation
	 *
	 * @param int $str Le mot de passe à valider
	 */
	public function check_password_temp($str)
	{
		if ($this->user_lib->user->password_acces === $this->user_lib->hash($str))
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('check_password_temp', "Le mot de passe actuel est invalide");
			return false;
		}
	}

	/**
	 * Vérifie un numéro de téléphone
	 * Callback de Form_validation
	 *
	 * @param string $str Le numéro à valider
	 */
	public function check_phone($str)
	{
		$regex = '/^0([1-9]{1})([0-9]{8})$/';

		if (preg_match($regex, $str) != 0 OR empty($str))
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('check_phone', "Le numéro de téléphone n'est pas au bon format");
			return false;
		}
	}

	/**
	 * Vérifie le code postal
	 * Callback de Form_validation
	 *
	 * @param string $code La date à valider
	 */
	// public function check_postal($code)
	// {
	// 	$regex = "/^((0[1-9])|([1-8][0-9])|(9[0-8])|(2a)|(2b))[0-9]{3}$/";

	// 	if (preg_match($regex, $code) != 0 || empty($code) )
	// 	{
	// 		return true;
	// 	}
	// 	else
	// 	{
	// 		$this->form_validation->set_message('check_postal', "Le code postal saisi est invalide");
	// 		return false;
	// 	}
	// }

	
}