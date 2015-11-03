<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_lib
{
	private $ci;
	public  $user = null;

	private $cookie_name = "ni_persist_id";
	private $cookie_hash = "ni_persist_hash";

	public function __construct()
	{
		$this->ci =& get_instance();

		$this->ci->load->model('user_model');

		if ($this->ci->session->userdata('user_id') !== null)
		{
			$this->user = $this->ci->user_model->get_once_by_id($this->ci->session->userdata('user_id'));
		}
	}


	/**
	 * Renvoie l'utilisateur connecté
	 *
	 * @param void
	 * @return bool
	 */
	public function get_user_connected()
	{
		if (empty($this->user))
		{
			return false;
		}
		else
		{
			return $this->user;
		}
	}

	/**
	 * Vérifie que l'utilisateur soit connecté
	 *
	 * @param void
	 * @return bool
	 */
	public function connected()
	{
		if (empty($this->user))
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	/**
	 * Retourne le niveau de l'utilisateur
	 *
	 * @param void
	 * @return int Le niveau de l'utilisateur
	 */
	public function access()
	{
		if ($this->connected() === true)
		{
			return (int) $this->user->level;
		}

		return (int) 0;
	}

	/**
	 * Vérifie si l'utilisateur est administrateur
	 *
	 * @param void
	 * @return bool
	 */
	public function is_admin()
	{
		return $this->connected() AND $this->user->level == 9;
	}

	/**
	 * Hash un password
	 *
	 * @param string $string Le mot de passe à hasher
	 * @return string Le mot de passe hashé
	 */
	public function hash($string)
	{
		$hash_type = 'sha256';
		$hash_salt = '){G+-MJ=5K^g<{w$$W1<W@;B^[xgcLV}y#YgHadfLclI]IA-<@;U]R[[Gl#JXQx[';

		$data_hashed = hash_hmac($hash_type, $string, $hash_salt, false);

		return $data_hashed;
	}

	/**
	 * Récupère les informations d'un utilisateur
	 *
	 * @param int $id L'id de l'utilisateur
	 * @return mixed (object) Les données de l'utilisateur || (bool) L'utilisateur n'existe pas
	 */
	public function get_by_id($id)
	{
		return $this->ci->user_model->get_once_by_id($id);
	}

	/**
	 *
	 *
	 *  On verifie si il l'utilistaeur changer son mdp temporaire et donc à accès ou non à certaines pages du sites
	 */
	function check_acces_front()
	{

		if ($this->connected() === true){
			if($this->user->active == 0){
				redirect(site_url('changer-mdp-temporaire'));
			}
		}else{
			redirect(site_url());
		}
	}

	/**
	 * Créée une connexion à l'aide d'un mot de passe et d'un email
	 *
	 * @param string $email L'adresse email de l'utilisateur
	 * @param string $password Le mot de passe hashé
	 * @return bool La connexion a réussie ou non
	 */
	public function login($email, $password)
	{
		$result = $this->ci->user_model->get_once_by_email($email);

		if ( $result->deleted == 0 ){
			if ($result !== false)
			{
				$this->user = $result;

				
				if ($this->user->active == 0
					AND empty($this->user->password))
				{
					if ($this->hash($password) === $this->user->password_acces)
					{
						$this->ci->user_model->update_password($this->user->id, $password);
						$this->ci->user_model->update_login($this->user->id);
						$this->ci->session->set_userdata('user_id', $this->user->id);

						return true;
					}
				}
				else
				{
					if ($this->hash($password) === $this->user->password)
					{
						$this->ci->user_model->update_login($this->user->id);
						$this->ci->session->set_userdata('user_id', $this->user->id);

						return true;
					}
				}
			}
		}
		
		return false;
	}

	/**
	 * Envoi un email avec une procédure de changement de mot de passe
	 *
	 * @param string $email L'email de l'utilisateur pour qui on déclence la procédure
	 * @return bool L'utilisateur existe et la procédure a été envoyée ou pas ?
	 */
	public function forgot_password($email)
	{
		$user = $this->ci->user_model->get_once_by_email($email);

		if ($user !== false)
		{
			$data['email'] = $user->user_email;
			$data['fullname'] = $user->user_fullname;
			$data['url'] = $this->change_password_url($user->user_id, $user->user_email);
			
			$this->ci->daemon_lib->task('email_mail_forgot_password', $data);

			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Retourne une url pour le changement de mot de passe
	 *
	 * @todo Réfléchir à l'implémentation de cette fonction
	 */
	public function change_password_url($id, $email)
	{
		$this->ci->load->helper('hashids');

		$id = hashids_encrypt($id);
		$hash = sha1($this->ci->config->item('encryption_key').$email);

		return site_url('mon-compte/changement-mot-de-passe/'.$id.'/'.$hash);
	}

	/**
	 * Connecte l'utilisateur par son email
	 *
	 * @param $email string Connecte un utilisateur par son email
	 * @return bool Connexion effectuée ou non
	 */
	public function connect($email)
	{
		$result = $this->ci->user_model->get_once_by_email($email);

		if ($result !== false)
		{
			$this->user = $result;

			$this->ci->session->set_userdata('user_id', $this->user->user_id);
			return true;
		}

		return false;
	}

	/**
	 * Connecte l'utilisateur par son id
	 *
	 * @param $id int Connecte un utilisateur par son id
	 * @return bool Connexion effectuée ou non
	 */
	public function connect_by_id($id_user)
	{
		$result = $this->ci->user_model->get_once_by_id($id_user);

		if ($result !== false)
		{
			$this->user = $result;

			$this->ci->session->set_userdata('user_id', $this->user->id);
			return true;
		}

		return false;
	}


	/**
	 * Retourne la liste des utilisateurs
	 */
	public function get_all()
	{
		$this->ci->db->select("users.*");
		return $this->ci->user_model->get_all();
	}

	/**
	 * Crée un cookie de connexion persistante
	 */
	public function create_persistent_connexion()
	{
		$hash = $this->_cookie_create_hash($this->user);

		$c1 = $this->ci->input->set_cookie(array('name' => $this->cookie_name,
												 'value' => $this->user->user_email,
												 'expire' => 31536000));

		$c2 = $this->ci->input->set_cookie(array('name' => $this->cookie_hash,
												 'value' => $hash,
												 'expire' => 31536000));

		return $c1 AND $c2;
	}

	/**
	 * Connecte l'utilisation par son cookie
	 *
	 * @param void
	 * @return mixed (bool) Connexion réussie ou non || [action:logout] Le cookie est corrompu
	 */
	public function use_persistent_connexion()
	{
		$email = $this->ci->input->cookie($this->cookie_name);
		$hash = $this->ci->input->cookie($this->cookie_hash);

		if ($email AND $hash)
		{
			if ($this->connect($email) === true)
			{
				if ($this->_cookie_check_hash($hash, $this->user) === true)
				{
					return true;
				}
				else
				{
					$this->logout();
				}
			}
		}

		return false;
	}

	/**
	 * Vérifie l'existence d'une connexion persitante
	 *
	 * @param void
	 * @return bool
	 */
	public function check_persistent_connexion()
	{
		return $this->ci->input->cookie($this->cookie_name) AND $this->ci->input->cookie($this->cookie_hash) ? true : false;
	}

	/**
	 * Détruit la connexion persistente
	 *
	 * @param void
	 * @return void
	 */
	public function destroy_persistent_connexion()
	{
		$this->ci->load->helper('cookie');
		delete_cookie($this->cookie_name);
		delete_cookie($this->cookie_hash);
	}

	/**
	 * Détruit la connexion
	 *
	 * @param void
	 * @return void
	 */
	public function logout()
	{
		$this->user = null;
		$this->destroy_persistent_connexion();
		$this->ci->session->unset_userdata('last_page');
		$this->ci->session->unset_userdata('user_id');
	}

	/**
	 * Crée un hash en mixant l'id et l'adresse email
	 *
	 * @param object Un objet de type Query::User
	 * @return string Un hash valide pour l'utilisateur
	 */
	private function _cookie_create_hash($user)
	{
		$part_data = md5($user->user_id).md5($user->user_email);
		$part_info = md5($this->ci->input->user_agent()).md5($this->ci->input->ip_address());
		return sha1(base64_encode($part_data.$part_info));
	}

	/**
	 * Vérifie la validité d'un hash
	 *
	 * @param string Le hash a vérifié
	 * @param object Un objet Query::User pour lequel on vérifie le hash
	 */
	private function _cookie_check_hash($hash, $user)
	{
		return $hash === $this->_cookie_create_hash($user) ? true : false;
	}
}