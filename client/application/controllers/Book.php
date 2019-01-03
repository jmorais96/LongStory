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


///////////////////////////////////// GET BOOK ///////////////////////////////////

	function getBook($id = 0)
	{

		$con = curl_init();
		if ($id == 0)
			curl_setopt($con, CURLOPT_URL, $this->api_url . '/getbook/');
		else
			curl_setopt($con, CURLOPT_URL, $this->api_url . '/getbook/id/' . $id);


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
			'users' => json_decode($response, true)
		);
		$this->load->view('general/menu');
		$this->load->view('long_story/books', $data);
		$this->load->view('general/footer');
	}
//http://localhost:8888/webServices/LongStory/client/index.php/User/getUser
///////////////////////////////////// END GET BOOK ///////////////////////////////////
}
