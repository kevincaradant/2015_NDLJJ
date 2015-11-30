<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends MY_Model
{
	public $table = 'users';
	public $pk    = 'id';

	public $levels = array(
		'1' => 'Client',
		'9' => 'Administrateur'
	);


	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Compte les utilisateurs pour le back-office
	 * 
	 * @param void
	 * @return int Le nombre d'utilisateur
	 */
	public function back_count_all()
	{
		$count = $this->user_model->count_all();
		return $count;
	}

	/**
	 * Retourne tout les utilisateurs pour le back-office
	 * 
	 * @param void
	 * @return mixed (bool) Aucun utilisateur || (object) Query::Users
	 */
	public function back_get_all()
	{
		$users = $this->get_all();
		$this->_collection_presenter($users);


		return $users;
	}

	public function get_all()
	{

		$this->db->where('deleted',0);
		$query = $this->db->get($this->table);

		if ($query->num_rows() > 0)
		{
			$result = $query->result();
			$this->_collection_presenter($result);

			return $result;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Retourne un utilisateur par son Id
	 *
	 * @param int $id
	 * @param mixed (bool) || (object) Query::User
	 */
	public function get_once_by_id($id)
	{
		$query = $this->db->get_where($this->table, array('id' => $id), 1);

		if ($query->num_rows() > 0)
		{
			$user = $query->row();
			$this->_presenter($user);
			return $user;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Retourne un utilisateur par son Email
	 *
	 * @param string $email
	 * @return mixed (bool) || (object) Query::User
	 */
	public function get_once_by_email($email)
	{
		$query = $this->db->get_where($this->table, array('email' => $email), 1);

		if ($query->num_rows() > 0)
		{
			$user = $query->row();
			$this->_presenter($user);
			return $user;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Retourne un utilisateur par une clé
	 *
	 * @param string $key Le nom de la colonne sans préfixe de la table. Ex: "id" pour "user_id".
	 * @param mixed $value La valeur de la clé.
	 *
	 * @return mixed (bool) || (object) Query::User
	 */
	public function get_once_by($key, $value)
	{
		$query = $this->db->get_where($this->table, array($key => $value), 1);

		if ($query->num_rows() > 0)
		{
			$user = $query->row();
			$this->_presenter($user);
			return $user;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Met à jour le mot de passe de l'utilisateur si celui-ci
	 * se connecte avec "user_password_legacy"
	 *
	 * @param int $user_id L'ID de l'utilisateur pour lequel on modifie le pass
	 * @param string $password
	 * @return void
	 */
	public function update_password($user_id, $password)
	{
		$this->db->where('id', $user_id)
				 ->limit(1)
				 ->set('password', $this->user_lib->hash($password));

		$this->db->update($this->table);

		return $this->db->affected_rows() > 0;
	}

	/**
	 * Met à jour les infos de connexion de l'utilisateur
	 *
	 * @param int $id
	 * @return bool
	 */
	public function update_login($id)
	{
		$result = $this->db->where('id', $id)
			->update($this->table,
				array('date_login' => time(),
					'ip_login' => $this->input->ip_address()));

		if ($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}


	/**
	 * Ajoute un utilisateur en base
	 *
	 * @param array $data
	 * @return bool
	 */
	public function add($data)
	{
		$this->db->insert($this->table, $data);

		if ($this->db->affected_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}


	/**
	 * Met à jour l'adresse email
	 *
	 * @param int $id
	 * @param string $email
	 * @return bool
	 */
	public function update_email($id, $email)
	{
		$result = $this->db->where('id', $id)
							->update($this->table, array('email' => $email));

		if ($this->db->affected_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Presenter de User_model
	 * 
	 * @param object &$user L'utilisateur à Presenter
	 * @return void
	 */
	protected function _presenter(&$user)
	{
		if (is_array($user))
		{
			return $this->_collection_presenter($user);
		}

		if (empty($user))
		{
			$user = false;
		}
		else
		{
			//On va recuperer les entreprises associés:

			$id_entreprises = $this->db->select('id_entreprise')
									->where('id_user',$user->id)
									->get('user_entreprise')
									->result();

			

			$user->entreprises = array();
			$user->id_entreprises = array();


			if( !empty($id_entreprises) ) {
				foreach ($id_entreprises as  $id_entreprise) {
					$user->entreprises[] = $this->entreprise_model->get_once_by_id($id_entreprise->id_entreprise);
					$user->id_entreprises[] = $id_entreprise->id_entreprise;
				}
			}else{
				$user->entreprises = false;
			}


			$user->fullname = $user->firstname.' '.$user->lastname;
			$user->libelle_level = array_key_exists($user->level, $this->levels) ? $this->levels[$user->level] : 'Inconnu';
		}

		return;
	}
}