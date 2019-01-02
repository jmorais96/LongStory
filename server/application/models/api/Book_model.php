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
        $ret = $this->db->insert('book', $book);

        if (!$ret)
            return -1;

        $book_id = $this->db->insert_id();

        return $book_id;
    }



}
