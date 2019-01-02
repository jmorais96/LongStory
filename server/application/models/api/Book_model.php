<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 18-12-2018
 * Time: 15:37
 */

if (!defined('BASEPATH')) die();

class Book_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function addBook($book)
    {
        $book['author']=$this->addAuthor($book['author']);
        $ret = $this->db->insert('book', $book);

        if (!$ret)
            return -1;

        $book_id = $this->db->insert_id();

        return $book_id;
    }

    function addAuthor($author)
    {

        $author= array('author' =>$author);

        $this->db->select("a.author, a.idAuthor", false);
        $this->db->from("author as a");
        $this->db->where('a.author', $author['author'] );
        $query=$this->db->get();

        $authors = array();
        foreach ($query->result() as $t)
            $authors[] = (array) $t;

        //print_r($authors);exit;

        if (isset($authors[0]['idAuthor']))
            return $authors[0]['idAuthor'];

        $ret = $this->db->insert('author', $author);

        if (!$ret)
            return -1;

        $authorId = $this->db->insert_id();

        return $authorId;
    }



}
