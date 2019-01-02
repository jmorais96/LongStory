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
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class User extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        $this->load->model('api/user_model');

    }

    public function getUser_get()
    {
        $id= $this->get('id');

        if ($id===NULL)
            $user= $this->user_model->getUsers();
        else
            $user= $this->user_model->getUsers($id);

        $this->response($user, REST_Controller::HTTP_OK);
    }

    function addUser_post()
    {
        $user = array(
            'name' =>$this->post('name'),
            'email' =>$this->post('email'),
            'pass' =>$this->post('pass'),
            'birthDate' =>$this->post('birthDate'),
        );
        $user['idProfile']=2;



        if ($user['name'] == '' || $user['email']== '' || $user['pass']=="")
        {
            $message = [
                'id' => -1,
                'message' => 'não foi passivel registar o utilizador na base de dados'
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            return;
        }
        $ret=$this->user_model->addUser($user);
        if ($ret<0)
        {
            $message = [
                'id' => -2,
                'message' => 'não foi passivel registar o utilizador na base de dados'
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            return;
        }
        else
        {
            $message = [
                'id' => $ret,
                'message' => 'utilizador criado',
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_CREATED);

        }

    }

    function editUser_post()
    {
        $user = array(
            'idUser' =>$this->post('idUser'),
            'name' =>$this->post('name'),
            'pass' =>$this->post('pass'),
            'birthDate' =>$this->post('birth'),
            'idProfile' =>$this->post('idProfile')
        );

        if ($user['idUser']=='')
        {
            $message = [
                'id' => -1,
                'message' => 'É necessario o id do utilizador que deseja editar'
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            return;
        }

        $ret=$this->user_model->editUser($user);
        if ($ret<0)
        {
            $message = [
                'id' => -2,
                'message' => 'não foi passivel atualizar o utilizador na base de dados'
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            return;
        }
        else
        {

            $this->set_response($ret, \Restserver\Libraries\REST_Controller::HTTP_CREATED);

        }

    }

    function addFriend_post()
    {
        $user = array(
            'idUser' =>$this->post('idUser'),
            'idFriend' =>$this->post('idFriend'),
        );

        if ($user['idUser'] == '' || $user['idFriend']== '')
        {
            $message = [
                'id' => -1,
                'message' => 'não foi passivel adicionar amigo'
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            return;
        }

        $ret=$this->user_model->addFriend($user);
        if ($ret<0)
        {
            $message = [
                'id' => -2,
                'message' => 'não foi passivel adicionar amigo'
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_NOT_FOUND);
            return;
        }
        else
        {
            $message = [
                'id' => 1,
                'message' => 'Amigo adicionado',
            ];

            $this->set_response($message, \Restserver\Libraries\REST_Controller::HTTP_CREATED);

        }

    }

    public function getFriends_get()
    {
        $id= $this->get('id');

        $users= $this->user_model->getFriend($id);

        $this->response($users, REST_Controller::HTTP_OK);
    }

}
