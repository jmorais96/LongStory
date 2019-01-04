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
class Book extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 *        http://example.com/index.php/welcome
	 *    - or -
	 *        http://example.com/index.php/welcome/index
	 *    - or -
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


		$this->api_url = 'http://localhost:8888/webServices/LongStory/server/index.php/api/book';

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
	}

	public function index()
	{
		$this->load->view('general/header');
		$this->load->view('general/menu');
		$this->load->view('general/footer');


		//$this->getMovies();
	}

	///////////////////////////////////// CREATE BOOK ///////////////////////////////////
	function addBook($post_data)
	{
		//print_r($post_data); exit;
		$con = curl_init();
		curl_setopt($con, CURLOPT_URL, $this->api_url . '/addbook/');
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
					$this->load->view('long_story/add_book_fail', $data);
					$this->load->view('general/footer');
					return;
			}
		}

		curl_close($con);

		$data = array(
			'books' => json_decode($response, true)
		);
		//print_r($data); exit;
		$this->load->view('general/header_html');
		$this->load->view('general/menu');
		$this->load->view('long_story/books', $data);
		$this->load->view('general/footer');
	}

	function addBookForm()
	{
		$this->load->view('general/header_html');
		$this->load->view('general/menu');
		$this->load->view('long_story/add_book');
		$this->load->view('general/footer');
	}

	function addBookValidation()
	{
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('author', 'Author', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('isbn', 'Isbn', 'required');
	//	$this->form_validation->set_rules('image', 'Image', 'required');
		$this->form_validation->set_rules('idGender', 'IdGender', 'required');
		$this->form_validation->set_rules('idRegister', 'IdRegister', 'required');

		if ($this->form_validation->run() === TRUE)
		{
			$post_data = array(
				'name' => $this->input->post('name'),
				'author' => $this->input->post('author'),
				'description' => $this->input->post('description'),
				'isbn' => $this->input->post('isbn'),
				//'idProfile' =>$this->input->post('image'),
				'idGender' =>$this->input->post('idGender'),
				'idRegister' =>$this->input->post('idRegister')
			);

			//print_r($post_data); exit;
			$this->addBook($post_data);
		}
		else
		{
			$this->addBookForm();
		}
	}
	//http://localhost:8888/webServices/LongStory/client/index.php/User/addBookForm
	///////////////////////////////////// END CREATE BOOK ///////////////////////////////////

	///////////////////////////////////// GET BOOK ///////////////////////////////////

	function getBooks($id = 0)
	{

		$con = curl_init();
		if ($id == 0)
			curl_setopt($con, CURLOPT_URL, $this->api_url . '/getbooks/');
		else
			curl_setopt($con, CURLOPT_URL, $this->api_url . '/getbooks/idUser/' . $id);


		curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($con);
		if (!curl_errno($con)) {
			switch ($http_code = curl_getinfo($con, CURLINFO_HTTP_CODE)) {
				case 200:
					break;
				default:
					echo "Unexpected HTTP code: ", $http_code, "\n";
					exit;
			}
		}

		curl_close($con);

		$data = array(
			'books' => json_decode($response, true)
		);
		$this->load->view('general/header_html');
		$this->load->view('general/menu');
		$this->load->view('long_story/books', $data);
		$this->load->view('general/footer');
	}
	//http://localhost:8888/webServices/LongStory/client/index.php/Book/getBook
	///////////////////////////////////// END GET BOOK ///////////////////////////////////
}
