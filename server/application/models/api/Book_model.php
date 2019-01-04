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

    function getApprovedBooks()
    {

        $this->db->select("b.idBook, b.name, a.author, b.description, b.ISBN, b.image", false);
        $this->db->from("book as b");
        $this->db->join("author as a" , "b.idAuthor=a.idAuthor");
        $this->db->where('b.idStatusBook', 1);

        $query=$this->db->get();

        $books = array();
        foreach ($query->result() as $t)
            $books[] = (array) $t;

        return $books;

    }

    function getAllBooks()
    {
        $this->db->select("b.idBook, b.name, a.author, b.description, b.ISBN, b.image", false);
        $this->db->from("book as b");
        $this->db->join("author as a" , "b.idAuthor=a.idAuthor");

        $query=$this->db->get();

        $books = array();
        foreach ($query->result() as $t)
            $books[] = (array) $t;

        return $books;
    }

    function addBook($book, $genders)
    {
        $book['idAuthor']=$this->addAuthor($book['author']);

        unset($book['author']);
        $book['idstatusBook']=3;
        $ret = $this->db->insert('book', $book);

        if (!isset($genders[1]))
        {
            $genders=array($genders);
        }

        $book_id = $this->db->insert_id();

        foreach ($genders as $key => $value){

            $book_gender=array('idBook'=>$book_id, 'idGender'=>$value);
            //print_r($book_gender);exit;
            $this->db->insert('book_has_gender', $book_gender);
        }


        if (!$ret)
            return -1;



        return $book_id;
    }

    function getBook($id)
    {
        $this->db->select("b.name, b.name, a.author, b.description, b.ISBN, b.image");
        $this->db->from("book as b");
        $this->db->join("author as a", "b.idAuthor = a.idAuthor");
        $this->db->where('b.idBook', $id );
        $query=$this->db->get();

        $book = array();
        foreach ($query->result() as $t)
            $book[] = (array) $t;


        $this->db->select("g.gender");
        $this->db->from("gender as g");
        $this->db->join("book_has_gender as bg", "g.idGender = bg.idGender");
        $this->db->where('bg.idBook', $id );


        $book['genders'] = "";
        foreach ($query->result() as $t)
            $book['genders'].=",". (string) $t;


        return $book;
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


    function getGender()
    {
        $this->db->select("g.idGender, g.gender", false);
        $this->db->from("gender as g");

        $query=$this->db->get();


        $genders = array();
        foreach ($query->result() as $t)
            $genders[] = (array) $t;

        return $genders;
    }

    function getBookInfo()
    {
        
    }

}
