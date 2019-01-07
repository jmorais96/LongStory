<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 18-12-2018
 * Time: 15:37
 */

if (!defined('BASEPATH')) die();

class User_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}



    public function userExists($id)
    {

        $user = $this->getUsers($id);

        if (count($user) > 0)
            return true;

        return false;

    }

    public function isAdmin($id)
    {
        $user = $this->getUsers($id);

        if ($user[0]['idProfile'] == 1)
            return true;

        return false;

    }

    public function isActive($id)
    {
        $user = $this->getUsers($id);

        if ($user[0]['userStatus'] == 1)
            return true;

        return false;

    }

	function getUsers($id=0)
	{
		$this->db->select("u.idUser, u.name, u.email, u.pass, u.birthDate, u.idProfile, p.type", false);
		$this->db->from("user as u");
		$this->db->join("profile as p" , "u.idProfile=p.idProfile");
        $this->db->where('u.userStatus', 1);

		if ($id != 0)
			$this->db->where('u.idUser', $id);

		$query=$this->db->get();


		$users = array();
		foreach ($query->result() as $t)
			$users[] = (array) $t;

		return $users;

	}
	function getUsersBooks($id=0)
	{
		$this->db->select("u.idUser, u.name, u.email, u.pass, u.birthDate, u.idProfile, p.type", false);
		$this->db->from("user as u");
		$this->db->join("profile as p" , "u.idProfile=p.idProfile");
        $this->db->where('u.userStatus', 1);

		if ($id != 0)
			$this->db->where('u.idUser', $id);

		$query=$this->db->get();


		$users = array();
		foreach ($query->result() as $t)
			$users[] = (array) $t;

		return $users;

	}

	function addUser($user)
	{
		$ret = $this->db->insert('user', $user);

		if (!$ret)
			return -1;

		$user_id = $this->db->insert_id();

		return $user_id;
	}

	function editUser($user)
	{
		if ($user['name']!='')
		{
			$this->db->set('name', $user['name']);
		}

		if ($user['pass']!='')
		{
			$this->db->set('pass', $user['pass']);
		}

		if ($user['birthDate']!='')
		{
			$this->db->set('birthDate', $user['birthDate']);
		}

		if ($user['idProfile']!='')
		{
			$this->db->set('idProfile', $user['idProfile']);
		}

		$this->db->where('idUser', $user['idUser']);


		$ret = $this->db->update('user');

		if (!$ret)
			return -1;


		return $this->getUsers($user['idUser']);
	}


	function addFriend($user)
	{
		$ret = $this->db->insert('friends', $user);


		if (!$ret)
			return -1;

		return 1;
	}

	function getFriend($id)
	{
		$this->db->select("f.idFriend, uf.name, uf.email", false);
		$this->db->from("user as u");
		$this->db->join("friends as f" , "u.idUser = f.idUser");
		$this->db->join("user as uf" , "f.idFriend = uf.idUser");
		$this->db->where('f.idUser', $id);
        $this->db->where('u.userStatus', 1);

		//echo $this->db->get();

		$query=$this->db->get();


		$users = array();
		foreach ($query->result() as $t)
			$users[] = (array) $t;

		return $users;

	}

	function getProfile()
	{
		$this->db->select("p.idProfile, p.type", false);
		$this->db->from("profile as p");

		$query=$this->db->get();


		$profiles = array();
		foreach ($query->result() as $t)
			$profiles[] = (array) $t;

		return $profiles;
	}

}
