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


    public function ISBNExists($ISBN)
    {
        $this->db->select("b.idBook, b.name, a.author, b.description, b.ISBN, b.image", false);
        $this->db->from("book as b");
        $this->db->join("author as a" , "b.idAuthor=a.idAuthor");
        $this->db->where('b.ISBN', $ISBN);

        $query=$this->db->get();


        $book = array();
        foreach ($query->result() as $t)
            $book[] = (array) $t;

        if (count($book)>0)
            return true;

        return false;

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

    function getBookInfo($id)
    {

        $this->db->select("b.idBook, b.name, b.name, a.author, b.description, b.ISBN, b.image, group_concat(distinct g.gender) as gender, ifnull(round(avg(r.rating),1),'') as rating, b.idStatusBook, b.idAprover");
        $this->db->from("book as b");
        $this->db->join("author as a", "b.idAuthor = a.idAuthor");
        $this->db->join("rating as r", "r.idBook=b.idBook", "LEFT");
        $this->db->join("book_has_gender as gb" , "gb.idBook=b.idBook", "LEFT");
        $this->db->join("gender as g", "g.idGender=gb.idGender", "LEFT");
        $this->db->where('b.idBook', $id );
        $this->db->group_by('g.gender');
        $query=$this->db->get();

        $book = array();
        foreach ($query->result() as $t)
            $book[] = (array) $t;


        return $book;
    }

    function bookExists($id){

        $book = $this->getBookInfo($id);

        if (count($book) > 0)
            return true;

        return false;

    }

    function setOwned($idUser, $idBook)
    {

        $own= array(
            'idUser' => $idUser,
            'idBook' => $idBook
        );

        $ret = $this->db->insert('owned', $own);


        if (!$ret)
            return -1;

        return $idUser;
    }

    function getOwned($idUser)
    {

        $this->db->select("b.name, a.author, b.description");
        $this->db->from("book as b");
        $this->db->join("author as a", "b.idAuthor = a.idAuthor");
        $this->db->join("owned as o", "b.idBook = o.idBook");
        $this->db->where('o.idUser', $idUser);
        $query=$this->db->get();

        $book = array();
        foreach ($query->result() as $t)
            $book[] = (array) $t;

         return $book;
    }

    public function isOwned($idUser, $idBook)
    {

        //print_r($idBook);exit;
        //$where=array('o.idUser'=> $idUser, 'o.idBook'=>$idBook);

        $this->db->select("o.idUser, o.idBook");
        $this->db->from("owned as o");
        $this->db->where('o.idUser', $idUser);
        $this->db->where('o.idBook', $idBook);
        $query=$this->db->get();
        //print_r($query);exit;


        $owned = array();
        foreach ($query->result() as $t)
            $owned[] = (array) $t;


        if (!count($owned)==0)
            return true;

        return false;
    }

    function setRead($idUser, $idBook)
    {

        $read= array(
            'idUser' => $idUser,
            'idBook' => $idBook
        );

        $ret = $this->db->insert('read', $read);


        if (!$ret)
            return -1;

        return $idUser;
    }

    function getRead($idUser)
    {

        $this->db->select("b.name, a.author, b.description");
        $this->db->from("book as b");
        $this->db->join("author as a", "b.idAuthor = a.idAuthor");
        $this->db->join("read as r", "b.idBook = r.idBook");
        $this->db->where('r.idUser', $idUser);
        $query=$this->db->get();

        $book = array();
        foreach ($query->result() as $t)
            $book[] = (array) $t;


        return $book;
    }


    public function isRead($idUser, $idBook)
    {
        $this->db->select("r.idUser, r.idBook");
        $this->db->from("read as r");
        $this->db->where('r.idUser', $idUser);
        $this->db->where('r.idBook', $idBook);
        $query=$this->db->get();

        $owned = array();
        foreach ($query->result() as $t)
            $owned[] = (array) $t;


        if (count($owned)==0)
            return true;

        return false;
    }

    function setWishlist($idUser, $idBook)
    {

        $read= array(
            'idUser' => $idUser,
            'idBook' => $idBook
        );

        $ret = $this->db->insert('wishlist', $read);


        if (!$ret)
            return -1;

        return $idUser;
    }

    function getWishlist($idUser)
    {

        $this->db->select("b.name, a.author, b.description");
        $this->db->from("book as b");
        $this->db->join("author as a", "b.idAuthor = a.idAuthor");
        $this->db->join("wishlist as w", "b.idBook = w.idBook");
        $this->db->where('w.idUser', $idUser);
        $query=$this->db->get();

        $book = array();
        foreach ($query->result() as $t)
            $book[] = (array) $t;


        return $book;
    }


    public function isWishlist($idUser, $idBook)
    {
        $this->db->select("w.idUser, w.idBook");
        $this->db->from("wishlist as w");
        $this->db->where('w.idUser', $idUser);
        $this->db->where('w.idBook', $idBook);
        $query=$this->db->get();

        $wishList = array();
        foreach ($query->result() as $t)
            $wishList[] = (array) $t;


        if (count($wishList)==0)
            return true;

        return false;
    }

    function rateBook($book)
    {
        $ret = $this->db->insert('rating', $book);

        $book_id = $this->db->insert_id();

        if (!$ret)
            return -1;

        return $book_id;
    }

    function searchBook($search)
    {
        $this->db->select("b.name, a.author, b.description, b.ISBN, b.image, group_concat(distinct g.gender) as gender, ifnull(round(avg(r.rating),1),'') as rating");
        $this->db->from("book as b");
        $this->db->join("author as a", "b.idAuthor = a.idAuthor");
        $this->db->join("rating as r", "r.idBook=b.idBook", "LEFT");
        $this->db->join("book_has_gender as gb", "gb.idBook=b.idBook", "LEFT");
        $this->db->join("gender as g", "g.idGender=gb.idGender", "LEFT");

        if (!$search['name'] == "") {
            $this->db->where('b.name', $search['name']);
        }

        if (!$search['author'] == "") {
            $this->db->where('a.author', $search['author']);
        }

        if (!$search['ISBN'] == "") {

            $this->db->where('b.ISBN', $search['ISBN']);
        }

        $this->db->group_by('g.gender, b.name, a.author, b.description, b.ISBN, b.image');

        $query=$this->db->get();

        $book = array();
        foreach ($query->result() as $t)
            $book[] = (array) $t;

        return $book;
    }

    
    function editBook($book, $genders){
        if ($book['name']!='')
        {
            $this->db->set('name', $book['name']);
        }

        if ($book['description']!='')
        {
            $this->db->set('description', $book['description']);
        }

        if ($book['image']!='')
        {
            $this->db->set('image', $book['image']);
        }

        if ($book['idStatusBook']!='')
        {
            $this->db->set('idStatusBook', $book['idStatusBook']);
            $this->db->set('idAprover', $book['idAprover']);
        }

        $this->db->where('idBook', $book['idBook']);


        $ret = $this->db->update('book');

        if (isset($genders))
        {
            $this->db->delete("book_has_gender", array('idBook'=> $book['idBook']));

            foreach ($genders as $key => $value){

                $book_gender=array('idBook'=>$book['idBook'], 'idGender'=>$value);
                $this->db->insert('book_has_gender', $book_gender);
            }
        }

        if (!$ret)
            return -1;


        return $this->getBookInfo($book['idBook']);
    }



}
