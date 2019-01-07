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


		$this->api_url = 'http://localhost:8888/webServices/LongStory/server/index.php/api/book/';

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
					$this->load->view('long_story/add_fail', $data);
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
		$this->load->view('long_story/book/books', $data);
		$this->load->view('general/footer');
	}

	function addBookForm()
	{
		$this->load->view('general/header_html');
		$this->load->view('general/menu');
		$this->load->view('long_story/book/add_book');
		$this->load->view('general/footer');
	}

	function addBookValidation()
	{
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('author', 'Author', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('ISBN', 'ISBN', 'required');
	//	$this->form_validation->set_rules('image', 'Image', 'required');
		$this->form_validation->set_rules('idGender', 'IdGender', 'required');
		$this->form_validation->set_rules('idRegister', 'IdRegister', 'required');

		if ($this->form_validation->run() === TRUE)
		{
			$post_data = array(
				'name' => $this->input->post('name'),
				'author' => $this->input->post('author'),
				'description' => $this->input->post('description'),
				'ISBN' => $this->input->post('ISBN'),
				//'idProfile' =>$this->input->post('image'),
				'idGender' =>$this->input->post('idGender'),
				'idRegister' =>$this->input->post('idRegister')
			);

			if (isset($_FILES) && $_FILES['image']['error']==0){
				$config['upload_path'] = 'upload/';
				$config['allowed_types'] = '*';
				$this->load->library('upload', $config);

				if (! $this->upload->do_upload('image')){
					$data= array(
						'message' => $this->upload->display_errors()
					);

					$this->load->view('general/header_html');
					$this->load->view('general/menu');
					echo $data['message'];
					$this->load->view('general/footer');
				}
				else
				{
					$upload_data= $this->upload->data();
					//print_r($upload_data); exit;
					$post_data['image'] = base64_encode(
						file_get_contents($upload_data['full_path'])
					);
				}
			}
			else
			{
				echo "deu erro a fazer upload";
			}

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
		$this->load->view('long_story/book/books', $data);
		$this->load->view('general/footer');
	}
	//http://localhost:8888/webServices/LongStory/client/index.php/Book/getBook
	///////////////////////////////////// END GET BOOK ///////////////////////////////////

	///////////////////////////////////// GET OWNED ///////////////////////////////////
	function getOwned($id = 0)
	{

		$con = curl_init();
		if ($id == 0)
			curl_setopt($con, CURLOPT_URL, $this->api_url . '/getowned/');
		else
			curl_setopt($con, CURLOPT_URL, $this->api_url . '/getowned/id/' . $id);


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
			'allOwned' => json_decode($response, true)
		);
		//print_r($data);exit;
		$this->load->view('general/header_html');
		$this->load->view('general/menu');
		$this->load->view('long_story/book/owned', $data);
		$this->load->view('general/footer');
	}
	///////////////////////////////////// END GET OWNED ///////////////////////////////////

	///////////////////////////////////// GET READ ///////////////////////////////////
	function getRead($id = 0)
	{

		$con = curl_init();
		if ($id == 0)
			curl_setopt($con, CURLOPT_URL, $this->api_url . '/getread/');
		else
			curl_setopt($con, CURLOPT_URL, $this->api_url . '/getread/id/' . $id);


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
			'allRead' => json_decode($response, true)
		);
		//print_r($data);exit;
		$this->load->view('general/header_html');
		$this->load->view('general/menu');
		$this->load->view('long_story/book/read', $data);
		$this->load->view('general/footer');
	}
	///////////////////////////////////// END GET READ ///////////////////////////////////

	///////////////////////////////////// SET READ  ///////////////////////////////////
	function setRead($id = 0)
	{
		$con = curl_init();
		if ($id == 0)
			curl_setopt($con, CURLOPT_URL, $this->api_url . '/setread/');
		else
			curl_setopt($con, CURLOPT_URL, $this->api_url . '/setread/id/' . $id);


		curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($con);
		//print_r($response);exit;
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
			'allRead' => json_decode($response, true)
		);
		//print_r($data);exit;
		$this->load->view('general/header_html');
		$this->load->view('general/menu');
		$this->load->view('long_story/book/read', $data);
		$this->load->view('general/footer');
	}
	///////////////////////////////////// SET READ ///////////////////////////////////

	///////////////////////////////////// GET WHISLIST ///////////////////////////////////
	function getWishlist($id = 0)
	{

		$con = curl_init();
		if ($id == 0)
			curl_setopt($con, CURLOPT_URL, $this->api_url . '/getwishlist/');
		else
			curl_setopt($con, CURLOPT_URL, $this->api_url . '/getwishlist/id/' . $id);


		curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($con);
		//print_r($response);exit;
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
			'wishlist' => json_decode($response, true)
		);
		//print_r($data);exit;
		$this->load->view('general/header_html');
		$this->load->view('general/menu');
		$this->load->view('long_story/book/wishlist', $data);
		$this->load->view('general/footer');
	}
	///////////////////////////////////// END GET WHISLIST ///////////////////////////////////

	///////////////////////////////////// VIEW BOOK ///////////////////////////////////
	function getBookInfo($id = 0)
	{
		//echo "bla";exit;
			$con = curl_init();
			$url = $this->api_url.'/getBookInfo/'.$id;
		//echo $url;exit;

		curl_setopt($con, CURLOPT_URL, $url);
			curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($con);

			// Check HTTP status code
			$book = json_decode($response,TRUE);
			curl_close($con);

			if (empty($book))
			{
				echo "não foi encontrado o livro";
			}
			else
			{
				if ($book[0]['rating']== "")
				{
					$book[0]['rating']=0;
				}
				$this->load->view('general/header_html');
				$this->load->view('general/menu');
				$this->load->view('long_story/book/info_book', $book[0]);
				$this->load->view('general/footer');
			}

	}
	///////////////////////////////////// END VIEW BOOK ///////////////////////////////////

	///////////////////////////////////// SEARCH BOOK ///////////////////////////////////
	function searchBook()
	{
		$post_data = array(
			'name' => $this->input->post('name'),
			'author' => $this->input->post('author'),
			'ISBN' => $this->input->post('ISBN')
		);

		//print_r($post_data);exit;
		//echo "bla";exit;
		$con = curl_init();
		$url = $this->api_url.'/searchBook/name/'.$post_data['name']. '/author/' .$post_data['author']. '/ISBN/' .$post_data['ISBN'];
		echo $url;exit;

		curl_setopt($con, CURLOPT_URL, $url);
		curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($con);

		// Check HTTP status code
		$books = json_decode($response,TRUE);
		curl_close($con);

		if (empty($books))
		{
			echo "não foi encontrado o livro";
		}
		else
		{
			$this->load->view('general/header_html');
			$this->load->view('general/menu');
			$this->load->view('long_story/book/search', $books[0]);
			$this->load->view('general/footer');
		}

	}
	///////////////////////////////////// END SEARCH BOOK ///////////////////////////////////

	///////////////////////////////////// ADD RATE ///////////////////////////////////
	function rateBook($post_data)
	{
		//print_r($post_data); exit;
		$con = curl_init();
		curl_setopt($con, CURLOPT_URL, $this->api_url . '/ratebook/');
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
			'ratings' => json_decode($response, true)
		);
		//print_r($data); exit;
		$this->getBookInfo($post_data['idBook']);
	}

	function rateBookValidation()
	{
		$this->form_validation->set_rules('myIdUser', 'MyIdUser', 'required');
		$this->form_validation->set_rules('idBook', 'IdBook', 'required');
		$this->form_validation->set_rules('rating', 'Rating', 'required');

		if ($this->form_validation->run() === TRUE)
		{
			$post_data = array(
				'myIdUser' => $this->input->post('myIdUser'),
				'idBook' => $this->input->post('idBook'),
				'rating' => $this->input->post('rating')
			);

			//print_r($post_data); exit;
			$this->rateBook($post_data);
		}

	}
	///////////////////////////////////// END ADD RATE ///////////////////////////////////

}
