<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 13-12-2018
 * Time: 15:53
 */

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller0
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Book extends REST_Controller {


    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        $this->load->model('api/book_model');
        $this->load->model('api/user_model');

    }

    public function getBooks_get()
    {
        if ($this->get('idUser')=="")
        {
            $message = [
                'id' => -2,
                'message' => 'necessita de mandar o id do utilizador'
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);

            return;

        }

        if ($this->user_model->isAdmin($this->get('idUser'))){

            $book= $this->book_model->getAllBooks();

            $this->response($book, REST_Controller::HTTP_OK);

        }else{
            $book= $this->book_model->getApprovedBooks();

            $this->response($book, REST_Controller::HTTP_OK);

        }


    }

    function addBook_post()
    {
        $book = array(
            'name' =>$this->post('name'),
            'author' =>$this->post('author'),
            'description' =>$this->post('description'),
            'ISBN' =>$this->post('ISBN'),
            'image' =>$this->post('image'),
            'idRegister' =>$this->post('idRegister')
        );

        $genders = $this->post('idGender');


        if ($book['name'] == '' || $book['author']== '' || $book['description']=="" || $book['ISBN']=="" || $book['image']=="" || $genders=="" || $book['idRegister']=="")
        {
            $message = [
                'id' => -1,
                'message' => 'não foi passivel registar o livro na base de dados'
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            return;
        }

        $ret=$this->book_model->addBook($book, $genders);

        if ($ret<0)
        {
            $message = [
                'id' => -2,
                'message' => 'não foi passivel registar o livro na base de dados    '
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            return;
        }
        else
        {
            $message = [
                'id' => $ret,
                'message' => 'Livro criado',
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_CREATED);

        }

    }

    public function getGenders_get()
    {

        $gender= $this->book_model->getGender();

        $this->response($gender, REST_Controller::HTTP_OK);
    }

    public function getBookInfo_get($id)
    {

        $book= $this->book_model->getBookInfo();

        $this->response($book, REST_Controller::HTTP_OK);

    }

}
