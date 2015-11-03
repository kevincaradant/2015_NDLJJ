<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model
{
	public $table;
	public $pk;

	public function __construct()
	{
		parent::__construct();

	}

	public function add($data)
	{
		if (!empty($data))
		{
			foreach ($data as $key => $value)
			{
				$this->db->set($key, $value);
			}

			$this->db->insert($this->table);

			return $this->db->affected_rows() > 0 ? $this->db->insert_id($this->pk) : false;
		}

		return false;
	}

	public function update($id, $data = array(), $column = false)
	{	
		if (count($data) > 0)
		{
			foreach ($data as $key => $value)
			{
				$this->db->set($key, $value);
			}
		}

		if ($column === false)
		{
			$this->db->where($this->pk, $id);
		}
		else
		{
			$this->db->where($column, $id);
		}
	
		$this->db->update($this->table);

		return $this->db->affected_rows() > 0 ? true : false;
	}

	public function get_by($key = null, $value = null)
	{
		$query = $this->db->where($key, $value)->limit(1)->get($this->table);

		if ($query->num_rows() > 0)
		{
			$result = $query->row();
			$this->_presenter($result);

			return $result;
		}
		else
		{
			return false;
		}
	}

	public function get($id)
	{
		$query = $this->db->where($this->table.'.'.$this->pk, $id)->get($this->table);

		if ($query->num_rows() > 0)
		{
			$result = $query->row();
			$this->_presenter($result);

			return $result;
		}
		else
		{
			return false;
		}
	}

	public function first()
	{
		$query = $this->db->get($this->table);

		if ($query->num_rows() > 0)
		{
			$result = $query->row();
			$this->_presenter($result);

			return $result;
		}
		else
		{
			return false;
		}
	}

	public function count_all()
	{
		$query = $this->db->count_all_results($this->table);

		if ($query > 0)
		{
			return $query;
		}
		else
		{
			return false;
		}
	}

	public function get_all_by($key = null, $value = null)
	{
		$query = $this->db->where($this->table.'.'.$key, $value)->get($this->table);

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

	public function get_all()
	{
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
	 * Supprime une entrée de manière "soft"
	 *
	 * @param string $column Le nom de la colonne faisant levier sur la suppression
	 * @param mixed $id L'identifiant de l'entrée à supprimer en "soft"
	 * @return bool La suppression est faite ou non
	 */
	public function soft_delete($column, $id)
	{
		$this->db->where($this->pk, $id)
				 ->limit(1);

		$this->db->update($this->table, array($column => 2));

		return $this->db->affected_rows() > 0 ? true : false;
	}

	public function delete($id = null)
	{
		if (!empty($id))
		{
			$this->db->where($this->pk, $id);
		}

		$this->db->delete($this->table);

		return $this->db->affected_rows() > 0 ? true : false;
	}

	public function delete_by($key = null, $value = null)
	{
		if (!empty($key) && !empty($value))
		{
			$this->db->where($key, $value);
		}

		$this->db->delete($this->table);

		return $this->db->affected_rows() > 0 ? true : false;
	}

	public function delete_by_in($key = null, $values = array())
	{
		if (empty($values))
		{
			return false;
		}

		if ($key == null)
		{
			$key = $this->pk;
		}

		$this->db->where_in($key, $values);
		$this->db->delete($this->table);

		return $this->db->affected_rows() > 0 ? true : false;
	}

	/**
	 * Génère une liste pour un clé => valeur
	 * 
	 * @param string $key_value La clé de la table qui sert de valeur du tableau retourné
	 * @return mixed (bool) Aucune données || (array) Un tableau de données
	 */ 
	public function dropdown($key_value)
	{
		$cache = $this->table . '_model/dropdown' . CACHE_EXT;

		if (false === $collection = $this->cache->get($cache))
		{
			$query = $this->db->order_by($this->pk, 'DESC')->get($this->table);

			$return = $query->num_rows() > 0 ? $query->result() : false;

			$collection = array();

			if ($return != false)
			{
				foreach ($return as $item)
				{
					$collection[$item->{$this->pk}] = $item->{$key_value};
				}
			}

			$this->cache->save($cache, $collection, CACHE_LIFE);
		}

		return $collection;
	}


	/** 
	 * Permet lors d'une jointure d'une table vers une autre table qui contient plusieurs retours
	 * de regrouper lignes multiples et d'éviter la duplication
	 * 
	 * @return object MY_Model
	 */
	public function group_left($primary, $secondary = null)
	{
		$values = array();

		$values[] = $primary;
		$values[] = is_null($secondary) ? $this->table.'.'.$this->pk : $secondary;

		$this->db->group_by($values);
		return $this;
	}

	public function belong($foreignkey = null)
	{
		$this->db->join($this->table, $this->table.'.'.$this->pk.' = '.$foreignkey, 'left');
		return $this;
	}

	public function belong_by($key = null, $foreignkey = null)
	{
		$this->db->join($this->table, $this->table.'.'.$key.' = '.$foreignkey, 'left');
		return $this;
	}

	public function jointable_key($key = null)
	{
		$key = is_null($key) ? $this->pk : $key;
		return $this->table.'.'.$key;
	}

	/**
	 * Ajoute une jointure à une requête
	 * 
	 * @param object $db L'object Query_Builder auquel ajouter une jointure
	 * @param string $foreign_key La clé étrangère sur laquelle effectuer la jointure
	 * @param (optional) string $model_key Par défaut la jointure se fera sur $this->pk mais peut être overridé
	 * @return void
	 */
	public function join(&$db, $foreign_key, $model_key = false)
	{
		$key = $model_key != false ? $model_key : $this->table.'.'.$this->pk;

		$db->join($this->table, $key .' = '.$foreign_key, 'left');
	}

	/**
	 * Envoi une collection d'item de type Query::{Model} à son Presenter
	 * 
	 * @param array &$collection Le tableau d'objet à présenter
	 * @return void 
	 */
	protected function _collection_presenter(&$collection)
	{
		if (empty($collection))
		{
			$collection = false;
		}
		else
		{
			foreach ($collection as &$item)
			{
				$this->_presenter($item);
			}
		}

		return;
	}

	/**
	 * Presenter par défaut d'un model
	 * 
	 * @param object &$item L'object de type Query::{Model} à Presenter
	 * @return void
	 */
	protected function _presenter(&$item)
	{
		if (is_array($item))
		{
			return $this->_collection_presenter($item);
		}

		if (empty($item))
		{
			$item = false;
		}

		return;
	}
}