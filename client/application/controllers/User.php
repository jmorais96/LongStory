<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property string api_url_users
 * @property string api_url_task
 * @property  input
 * @property  form_validation
 * @property  upload
 * @property  form_validation
 * @property  form_validation
 * @property  form_validation
 */
class User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */


	var $api_url;

	/**
	 * Clientrest constructor.
	 */
	function __construct()
	{
		parent::__construct();


		$this->api_url='http://localhost:8888/webServices/LongStory/server/index.php/api/user';

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
	}

	public function index()
	{

		//$this->getMovies();
	}

	///////////////////////////////////// CREATE USER ///////////////////////////////////
	function addUser() //$post_data
	{
		//print_r($post_data); exit;
		//$post_data['user_id'] ='1';
		$post_data = array(
			'name' => 'Alice',
			'email' => 'alice@gg.com',
			'pass' => '123456',
			'birthDate' => '2018-12-06',
		);
		$con = curl_init();
		curl_setopt($con, CURLOPT_URL, $this->api_url . '/adduser/');
		curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($con, CURLOPT_POST, TRUE);
		curl_setopt($con, CURLOPT_POSTFIELDS, http_build_query($post_data));
		$response=curl_exec($con);
		if (!curl_errno($con)){
			switch ($http_code = curl_getinfo($con, CURLINFO_HTTP_CODE)){
				case 201: break;
				default: echo "Unexpected HTTP code: ", $http_code, "\n";
					exit;
			}
		}

		curl_close($con);

		$data = array(
			'movies' => json_decode($response, true)
		);
		//print_r($data); exit;
		//$this->load->view('geral/header');
		//$this->load->view('clientrest/movies', $data);
	//	$this->load->view('geral/footer');
	}



/*$post_data = array(
'name' => $this->input->post('name'),
'email' => $this->input->post('email'),
'pass' => $this->input->post('pass'),
'birthDate' => $this->input->post('birthDate'),
);*/
}


//http://controlaltdelete.pt/uac/ws/index.php/api/taskmanager/tasks
