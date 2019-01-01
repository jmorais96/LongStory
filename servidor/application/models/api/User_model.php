<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 18-12-2018
 * Time: 15:37
 */

if (!defined('BASEPATH')) die();

class Movie_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct()          ;
    }


    function getMovies($id=0)
    {
        $this->db->select("m.id, m.photo, m.title, m.year, m.description, m.user_id, u.name, group_concat(distinct g.name) as gender, ifnull(round(avg(r.rating),1),'') as rating", false);
        $this->db->from("movie as m");
        $this->db->join("users as u" , "u.id=m.user_id");
        $this->db->join("rating as r", "r.movie_id=m.id", "LEFT");
        $this->db->join("gender_has_movie as mh" , "m.id=mh.movie_id", "LEFT");
        $this->db->join("gender as g", "g.id=mh.gender_id", "LEFT");

        if ($id != 0)
            $this->db->where('m.id', $id);

        $this->db->group_by('m.id, m.photo, m.title, m.year, m.description, m.user_id, u.name');
        $query=$this->db->get();


        $movies = array();
        foreach ($query->result() as $t)
            $movies[] = (array) $t;

        return $movies;
            /*select
                m.id, m.photo, m.title, m.year, m.description, m.user_id,
                u.name
            from movies as m
            join users as u on u.id = m.user_id*/
    }

    function addMovie($movie, $genders)
    {
        $ret = $this->db->insert('movie', $movie);

        if (!$ret)
            return -1;

        $movie_id = $this->db->insert_id();
        $genders_arr = explode(',', $genders);
        //print_r($genders_arr);
        foreach ($genders_arr as $g) {
            if ($g !=''){
                $ret = $this->db->insert('gender_has_movie',
                    array('movie_id' => $movie_id,
                        'gender_id' => $g)
                );
                if (!$ret)
                    return -2;
            }
        }

        return $movie_id;
    }



}
