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

    function getGenders_get()
    {

        $gender= $this->book_model->getGender();

        $this->response($gender, REST_Controller::HTTP_OK);
    }

    function getBookInfo_get($id)
    {

        $book= $this->book_model->getBookInfo($id);

        $this->response($book, REST_Controller::HTTP_OK);

    }


    function setOwned_post()
    {

        $idUser = $this->post('myIdUser');
        $idBook = $this->post('idBook');


        if ($idBook == '' || $idUser == '')
        {
            $message = [
                'id' => -1,
                'message' => 'É necessário enviar o id do livro e do utilizador'
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            return;
        }


        if (!$this->book_model->bookExists($idBook))
        {
            $message = [
                'id' => -3,
                'message' => 'O livro não existe'
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            return;
        }

        if (!$this->user_model->userExists($idUser))
        {
            $message = [
                'id' => -3,
                'message' => 'O utilizador não existe'
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            return;
        }



        $ret=$this->book_model->setOwned($idUser, $idBook);

        if ($ret<0)
        {
            $message = [
                'id' => -2,
                'message' => 'não foi possivel adicionar livro à lista de livros possuidos'
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            return;
        }
        else
        {
            $message = [
                'id' => 1,
                'message' => 'Livro adicionado',
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_CREATED);

        }
    }

    public function getOwned_get()
    {
        $id= $this->get('id');

        $books= $this->book_model->getOwned($id);

        $this->response($books, REST_Controller::HTTP_OK);
    }

    function setRead_post()
    {

        $idUser = $this->post('myIdUser');
        $idBook = $this->post('idBook');


        if ($idBook == '' || $idUser == '')
        {
            $message = [
                'id' => -1,
                'message' => 'É necessário enviar o id do livro e do utilizador'
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            return;
        }


        if (!$this->book_model->bookExists($idBook))
        {
            $message = [
                'id' => -3,
                'message' => 'O livro não existe'
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            return;
        }

        if (!$this->user_model->userExists($idUser))
        {
            $message = [
                'id' => -3,
                'message' => 'O utilizador não existe'
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            return;
        }

        if (!$this->book_model->isOwned($idUser, $idBook))
        {
            $message = [
                'id' => -4,
                'message' => 'O utilizador não possui o livro'
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            return;
        }



        $ret=$this->book_model->setRead($idUser, $idBook);

        if ($ret<0)
        {
            $message = [
                'id' => -2,
                'message' => 'não foi possivel adicionar livro à lista de livros possuidos'
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            return;
        }
        else
        {
            $message = [
                'id' => 1,
                'message' => 'Livro adicionado',
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_CREATED);

        }
    }

    public function getRead_get()
    {
        $id= $this->get('id');

        $books= $this->book_model->getRead($id);

        $this->response($books, REST_Controller::HTTP_OK);
    }



    function setWishlist_post()
    {

        $idUser = $this->post('myIdUser');
        $idBook = $this->post('idBook');


        if ($idBook == '' || $idUser == '')
        {
            $message = [
                'id' => -1,
                'message' => 'É necessário enviar o id do livro e do utilizador'
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            return;
        }


        if (!$this->book_model->bookExists($idBook))
        {
            $message = [
                'id' => -3,
                'message' => 'O livro não existe'
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            return;
        }

        if (!$this->user_model->userExists($idUser))
        {
            $message = [
                'id' => -3,
                'message' => 'O utilizador não existe'
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            return;
        }

        if ($this->book_model->isOwned($idUser, $idBook))
        {
            $message = [
                'id' => -4,
                'message' => 'Não pode adicionar à wishlist um livro que possua'
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            return;
        }


        $ret=$this->book_model->setWishlist($idUser, $idBook);

        if ($ret<0)
        {
            $message = [
                'id' => -2,
                'message' => 'não foi possivel adicionar livro à lista de livros possuidos'
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            return;
        }
        else
        {
            $message = [
                'id' => 1,
                'message' => 'Livro adicionado',
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_CREATED);

        }
    }

    public function getWishlist_get()
    {
        $id= $this->get('id');

        $books= $this->book_model->getWishlist($id);

        $this->response($books, REST_Controller::HTTP_OK);
    }


    function rateBook_post()
    {
        $rating = array(
            'idUser' =>$this->post('myIdUser'),
            'idBook' =>$this->post('idBook'),
            'rating' =>$this->post('rating'),
            'date'=>date('Y-m-d')
        );


        if ($rating['idUser'] == '' || $rating['idBook']== '' || $rating['rating']=="")
        {
            $message = [
                'id' => -1,
                'message' => 'É necessário o id do utilizador o id do livro e o rating'
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            return;
        }

        if (!$this->user_model->userExists($rating['idUser']))
        {
            $message = [
                'id' => -3,
                'message' => 'O utilizador não existe'
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            return;
        }

        if (!$this->book_model->bookExists($rating['idBook']))
        {
            $message = [
                'id' => -4,
                'message' => 'O livro não existe'
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            return;
        }


        $ret=$this->book_model->rateBook($rating);

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
                'message' => 'Rating adicionado',
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_CREATED);

        }

    }

    public function searchBook_get()
    {
        $search = array(
            'name' =>$this->get('name'),
            'author' =>$this->get('author'),
            'ISBN' =>$this->get('ISBN'),
        );


        $ret=$this->book_model->searchBook($search);

        if ($ret<0)
        {
            $message = [
                'id' => -2,
                'message' => 'não foi possivel de pesquisar livros'
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            return;
        }


        $this->set_response($ret, \Restserver\Libraries\REST_Controller::HTTP_CREATED);

    }

}
