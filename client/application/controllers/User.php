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
		$this->load->view('general/header_html');
		$this->load->view('general/header');
		$this->load->view('general/menu');
		$this->load->view('general/footer');


		//$this->getMovies();
	}

	///////////////////////////////////// CREATE USER ///////////////////////////////////
	function addUser($post_data)
	{
		//print_r($post_data); exit;
		$con = curl_init();
		curl_setopt($con, CURLOPT_URL, $this->api_url . '/adduser/');
		//echo $this->api_url . '/adduser/'; exit;
		curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($con, CURLOPT_POST, TRUE);
		curl_setopt($con, CURLOPT_POSTFIELDS, http_build_query($post_data));
		$response = curl_exec($con);
		if (!curl_errno($con)) {
			switch ($http_code = curl_getinfo($con, CURLINFO_HTTP_CODE)) {
				case 201:
					break;
				default: //echo "Unexpected HTTP code: ", $http_code, "\n";
					//print_r($response);exit;
					$data = array(
						'message' => json_decode($response, true)
					);
					$this->load->view('general/header_html');
					$this->load->view('general/menu');
					$this->load->view('long_story/add_fail', $data);
					$this->load->view('general/footer');
					return;
			}
		}

		curl_close($con);

		$data = array(
			'users' => json_decode($response, true)
		);
		//print_r($data); exit;
		$this->load->view('general/header_html');
		$this->load->view('general/menu');
		$this->load->view('long_story/users', $data);
		$this->load->view('general/footer');
	}

	function addUserForm()
	{
		$this->load->view('general/header_html');
		$this->load->view('general/menu');
		$this->load->view('long_story/add_user');
		$this->load->view('general/footer');
	}

	function addUserValidation()
	{
		$this->form_validation->set_rules('myIdUser', 'MyIdUser', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('pass', 'Pass', 'required');
		$this->form_validation->set_rules('birthDate', 'BirthDate', 'required');
		$this->form_validation->set_rules('idProfile', 'IdProfile', 'required');


		if ($this->form_validation->run() === TRUE)
		{
			$post_data = array(
				'myIdUser' => $this->input->post('myIdUser'),
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'pass' => $this->input->post('pass'),
				'birthDate' => $this->input->post('birthDate'),
				'idProfile' =>$this->input->post('idProfile')
			);

			//print_r($post_data); exit;
			$this->addUser($post_data);
		}
		else
		{
			$this->addUserForm();
		}
	}
	//http://localhost:8888/webServices/LongStory/client/index.php/User/addUserForm
	///////////////////////////////////// END CREATE USER ///////////////////////////////////

	///////////////////////////////////// CREATE FRIEND ///////////////////////////////////
	function addFriend($post_data)
	{
		//print_r($post_data); exit;
		$con = curl_init();
		curl_setopt($con, CURLOPT_URL, $this->api_url . '/addfriend/');
		//echo $this->api_url . '/adduser/'; exit;
		curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($con, CURLOPT_POST, TRUE);
		curl_setopt($con, CURLOPT_POSTFIELDS, http_build_query($post_data));
		$response = curl_exec($con);
		if (!curl_errno($con)) {
			switch ($http_code = curl_getinfo($con, CURLINFO_HTTP_CODE)) {
				case 201:
					break;
				default: //echo "Unexpected HTTP code: ", $http_code, "\n";
					//print_r($response);exit;
					$data = array(
						'message' => json_decode($response, true)
					);
					$this->load->view('general/header_html');
					$this->load->view('general/menu');
					$this->load->view('long_story/add_fail', $data);
					$this->load->view('general/footer');
					return;
			}
		}

		curl_close($con);

		$data = array(
			'friends' => json_decode($response, true)
		);
		//print_r($data); exit;
		$this->load->view('general/header_html');
		$this->load->view('general/menu');
		$this->load->view('long_story/friends', $data);
		$this->load->view('general/footer');
	}

	function addFriendForm()
	{
		$this->load->view('general/header_html');
		$this->load->view('general/menu');
		$this->load->view('long_story/add_friend');
		$this->load->view('general/footer');
	}

	function addFriendValidation()
	{
		$this->form_validation->set_rules('idUser', 'IdUser', 'required');
		$this->form_validation->set_rules('idFriend', 'IdFriend', 'required');

		if ($this->form_validation->run() === TRUE)
		{
			$post_data = array(
				'idUser' => $this->input->post('idUser'),
				'idFriend' => $this->input->post('idFriend'),
			);

			//print_r($post_data); exit;
			$this->addFriend($post_data);
		}
		else
		{
			$this->addFriendForm();
		}
	}
	///////////////////////////////////// END CREATE FRIEND ///////////////////////////////////

	///////////////////////////////////// GET USER ///////////////////////////////////

	function getUser($id = 0)
	{

		$con = curl_init();
		if ($id == 0)
			curl_setopt($con, CURLOPT_URL, $this->api_url.'/getuser/');
		else
			curl_setopt($con, CURLOPT_URL, $this->api_url.'/getuser/id/'. $id);


		curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
		$response=curl_exec($con);
		if (!curl_errno($con)){
			switch ($http_code = curl_getinfo($con, CURLINFO_HTTP_CODE)){
				case 200: break;
				default: echo "Unexpected HTTP code: ", $http_code, "\n";
					exit;
			}
		}

		curl_close($con);

		$data = array(
			'users' => json_decode($response, true)
		);
		$this->load->view('general/header_html');
		$this->load->view('general/menu');
		$this->load->view('long_story/users', $data);
		$this->load->view('general/footer');
	}
	//http://localhost:8888/webServices/LongStory/client/index.php/User/getUser
	///////////////////////////////////// END GET USER ///////////////////////////////////

	///////////////////////////////////// GET USER BOOKS ///////////////////////////////////
	function getUserBooks($id = 0)
	{

		$con = curl_init();
		if ($id == 0)
			curl_setopt($con, CURLOPT_URL, $this->api_url.'/getuserbooks/');
		else
			curl_setopt($con, CURLOPT_URL, $this->api_url.'/getuserbooks/id/'. $id);


		curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
		$response=curl_exec($con);
	//	print_r($response);exit;
		if (!curl_errno($con)){
			switch ($http_code = curl_getinfo($con, CURLINFO_HTTP_CODE)){
				case 200: break;
				default: echo "Unexpected HTTP code: ", $http_code, "\n";
					exit;
			}
		}

		curl_close($con);

		$data = array(
			'users' => json_decode($response, true)
		);
		//print_r($data);
		$this->load->view('general/header_html');
		$this->load->view('general/menu');
		$this->load->view('long_story/users_books', $data);
		$this->load->view('general/footer');
	}
	//http://localhost:8888/webServices/LongStory/client/index.php/User/getUserBooks
	///////////////////////////////////// END GET USER BOOKS ///////////////////////////////////

	///////////////////////////////////// EDIT USER ///////////////////////////////////
	function editUser($post_data)
	{
		//$post_data = array ('start_date' => '2018-11-27 15:00:00', "execution_user_id"=>"2", 'id'=>$id);
		//print_r( $post_data);

		$con = curl_init();
		curl_setopt($con, CURLOPT_URL, $this->api_url. '/editUser/');
		curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($con, CURLOPT_POST, true);
		curl_setopt($con, CURLOPT_POSTFIELDS, http_build_query($post_data));
		$response = curl_exec($con);
		//print_r($response);exit;

		if(!curl_errno($con)) {
			switch ($http_code = curl_getinfo($con, CURLINFO_HTTP_CODE))
			{
				case 201 : break;
				default : echo 'Unexpected HTTP code: ', $http_code, "\n";
					exit;
			}
		}
		curl_close($con);

		$data = array('users' => json_decode($response, true));
		//print_r($data);
		$this->load->view('general/header_html');
		$this->load->view('general/menu');
		$this->load->view('long_story/users', $data);
		$this->load->view('general/footer');
	}

	function editUserForm($id)
	{
		$con = curl_init();
		if ($id == 0)
			curl_setopt($con, CURLOPT_URL, $this->api_url.'/getuser/');
		else
			curl_setopt($con, CURLOPT_URL, $this->api_url.'/getuser/id/'. $id);


		curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
		$response=curl_exec($con);
		if (!curl_errno($con)){
			switch ($http_code = curl_getinfo($con, CURLINFO_HTTP_CODE)){
				case 200: break;
				default: echo "Unexpected HTTP code: ", $http_code, "\n";
					exit;
			}
		}

		curl_close($con);

		$data = array(
			'user' => json_decode($response, true)
		);

		$this->load->view('general/header_html');
		$this->load->view('general/menu');
		$this->load->view('long_story/edit_user', $data);
		$this->load->view('general/footer');
	}

	function editUserValidation()
	{
		$this->form_validation->set_rules('myIdUser', 'IdUser', 'required');
		$this->form_validation->set_rules('idUser', 'IdUser', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('pass', 'Pass', 'required');
		$this->form_validation->set_rules('birthDate', 'BirthDate', 'required');
		$this->form_validation->set_rules('idProfile', 'IdProfile', 'required');

		if ($this->form_validation->run() === TRUE)
		{
			$post_data = array(
				'myIdUser' => $this->input->post('myIdUser'),
				'idUser' => $this->input->post('idUser'),
				'name' => $this->input->post('name'),
				'pass' => $this->input->post('pass'),
				'birthDate' => $this->input->post('birthDate'),
				'idProfile' =>$this->input->post('idProfile')
			);


			//print_r($post_data); exit;
			$this->editUser($post_data);
		}
		else
		{
			$this->editUserForm($this->input->post('myIdUser'));
		}
	}
	//http://localhost:8888/webServices/LongStory/client/index.php/User/editUserForm
/////////////////////////////////////// EDIT USER ///////////////////////////////////

///////////////////////////////////// GET FRIENDS ///////////////////////////////////

	function getFriends($id = 0)
	{

		$con = curl_init();
		curl_setopt($con, CURLOPT_URL, $this->api_url.'/getfriends/id/'. $id);


		curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
		$response=curl_exec($con);
		if (!curl_errno($con)){
			switch ($http_code = curl_getinfo($con, CURLINFO_HTTP_CODE)){
				case 200: break;
				default: echo "Unexpected HTTP code: ", $http_code, "\n";
					exit;
			}
		}

		curl_close($con);

		$data = array(
			'friends' => json_decode($response, true)
		);
		$this->load->view('general/header_html');
		$this->load->view('general/menu');
		$this->load->view('long_story/friends', $data);
		$this->load->view('general/footer');
	}
	//http://localhost:8888/webServices/LongStory/client/index.php/User/getUser
///////////////////////////////////// END GET FRIENDS ///////////////////////////////////
}
