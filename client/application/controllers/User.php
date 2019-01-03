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
		curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($con, CURLOPT_POST, TRUE);
		curl_setopt($con, CURLOPT_POSTFIELDS, http_build_query($post_data));
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
		//print_r($data); exit;
		$this->load->view('general/header_html');
		$this->load->view('general/header');
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
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('pass', 'Pass', 'required');
		$this->form_validation->set_rules('birthDate', 'BirthDate', 'required');

		if ($this->form_validation->run() === TRUE)
		{
			$post_data = array(
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'pass' => $this->input->post('pass'),
				'birthDate' => $this->input->post('birthDate'),
			);

		/*	if (isset($_FILES) && $_FILES['userfile']['error']==0){
				$config['upload_path'] = 'upload/';
				$config['allowed_types'] = '*';
				$this->load->library('upload', $config);

				if (! $this->upload->do_upload('userfile')){
					$data= array(
						'message' => $this->upload->display_errors()
					);

					$this->load->view('general/header');
					echo $data['message'];
					$this->load->view('general/footer');
				}
				else
				{
					$upload_data= $this->upload->data();
					//print_r($upload_data); exit;
					$post_data['userfile'] = base64_encode(
						file_get_contents($upload_data['full_path'])
					);
				}
			}
			else
			{
				echo "deu erro a fazer upload";
			}*/

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

	///////////////////////////////////// EDIT USER ///////////////////////////////////
	function editUser($post_data)
	{
		//$post_data = array ('start_date' => '2018-11-27 15:00:00', "execution_user_id"=>"2", 'id'=>$id);
		//print_r( $post_data);

		$con = curl_init();
		curl_setopt($con, CURLOPT_URL, $this->api_url);
		curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($con, CURLOPT_POST, true);
		curl_setopt($con, CURLOPT_POSTFIELDS, http_build_query($post_data));
		$response = curl_exec($con);

		if(!curl_errno($con)) {
			switch ($http_code = curl_getinfo($con, CURLINFO_HTTP_CODE))
			{
				case 201 : break;
				default : echo 'Unexpected HTTP code: ', $http_code, "\n";
					exit;
			}
		}
		curl_close($con);

		$data = array('tasks' => array(json_decode($response, true)));
		//print_r($data);
		$this->load->view('general/header_html');
		$this->load->view('general/menu');
		$this->load->view('long_story/users', $data);
		$this->load->view('general/footer');
	}

	function editUserForm()
	{
		$this->load->view('general/header_html');
		$this->load->view('general/menu');
		$this->load->view('long_story/edit_user');
		$this->load->view('general/footer');
	}

	function editUserValidation()
	{
		$this->form_validation->set_rules('idUser', 'idUser', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('pass', 'Pass', 'required');
		$this->form_validation->set_rules('birthDate', 'BirthDate', 'required');

		if ($this->form_validation->run() === TRUE)
		{
			$post_data = array(
				'idUser' => $this->input->post('idUser'),
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'pass' => $this->input->post('pass'),
				'birthDate' => $this->input->post('birthDate'),
			);

			/*	if (isset($_FILES) && $_FILES['userfile']['error']==0){
                    $config['upload_path'] = 'upload/';
                    $config['allowed_types'] = '*';
                    $this->load->library('upload', $config);

                    if (! $this->upload->do_upload('userfile')){
                        $data= array(
                            'message' => $this->upload->display_errors()
                        );

                        $this->load->view('general/header');
                        echo $data['message'];
                        $this->load->view('general/footer');
                    }
                    else
                    {
                        $upload_data= $this->upload->data();
                        //print_r($upload_data); exit;
                        $post_data['userfile'] = base64_encode(
                            file_get_contents($upload_data['full_path'])
                        );
                    }
                }
                else
                {
                    echo "deu erro a fazer upload";
                }*/

			//print_r($post_data); exit;
			$this->editUser($post_data);
		}
		else
		{
			$this->editUserForm();
		}
	}
	//http://localhost:8888/webServices/LongStory/client/index.php/User/editUserForm
	///////////////////////////////////// EDIT USER ///////////////////////////////////


}

