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
					$this->load->view('long_story/message/add_fail', $data);
					$this->load->view('general/footer');
					return;
			}
		}

		curl_close($con);

		$data = array(
			'message' => json_decode($response, true)
		);
		//print_r($data); exit;
		$this->load->view('general/header_html');
		$this->load->view('general/menu');
		$this->load->view('long_story/message/add_success_add_book', $data);
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
		$this->form_validation->set_rules('idGender', 'IdGender', '');
		$this->form_validation->set_rules('idRegister', 'IdRegister', 'required');

		if ($this->form_validation->run() === TRUE)
		{
			$post_data = array(
				'name' => str_replace(' ', '%20',$this->input->post('name')),
				'author' => str_replace(' ', '%20',$this->input->post('author')),
				'description' => str_replace(' ', '%20',$this->input->post('description')),
				'ISBN' => $this->input->post('ISBN'),
				//'idProfile' =>$this->input->post('image'),
				'idGender' =>$this->input->post('idGender'),
				'idRegister' =>$this->input->post('idRegister')
			);

			//print_r($post_data);exit;

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

	///////////////////////////////////// EDIT BOOK ///////////////////////////////////
	function editBook($post_data)
	{
		//print_r($post_data);exit;
		$con = curl_init();
		curl_setopt($con, CURLOPT_URL, $this->api_url. '/editBook/');
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

		$data = array('books' => json_decode($response, true));
		//print_r($data);exit;
		$this->getBookInfo($data['books'][0]['idBook']);

	}

	function editBookForm($id)
	{
		$con = curl_init();
		if ($id == 0)
			curl_setopt($con, CURLOPT_URL, $this->api_url.'/getbookinfo/');
		else
			curl_setopt($con, CURLOPT_URL, $this->api_url.'/getbookinfo/'. $id);


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
			'book' => json_decode($response, true)
		);
		//print_r($data);exit;

		$this->load->view('general/header_html');
		$this->load->view('general/menu');
		$this->load->view('long_story/book/edit_book', $data);
		$this->load->view('general/footer');
	}

	function editBookValidation()
	{
		$this->form_validation->set_rules('idBook', 'IdBook', '');
		$this->form_validation->set_rules('name', 'Name', 'required');
		//$this->form_validation->set_rules('author', 'Author', 'required');
		$this->form_validation->set_rules('description', 'Description', '');
		$this->form_validation->set_rules('idStatusBook', 'IdStatusBook', '');
		$this->form_validation->set_rules('idAprover', 'IdAprover', '');

		/*if ($this->form_validation->run() === TRUE)
		{
			$post_data = array(
				'idBook' => $this->input->post('idBook'),
				'name' => $this->input->post('name'),
				'description' => $this->input->post('description'),
				'idStatusBook' => $this->input->post('idStatusBook'),
				'idAproved' =>$this->input->post('idAproved')
			);


			//print_r($post_data); exit;
			$this->editBook($post_data);
		}
		else
		{
			$this->editBookForm($this->input->post('idBook'));
		}*/

		if ($this->form_validation->run() === TRUE)
		{
			$post_data = array(
				'idBook' => $this->input->post('idBook'),
				'name' => str_replace(' ', '%20',$this->input->post('name')),
				//'author' => str_replace(' ', '%20',$this->input->post('author')),
				'description' => str_replace(' ', '%20',$this->input->post('description')),
				'idStatusBook' => $this->input->post('idStatusBook'),
				'idAproved' =>$this->input->post('idAprover')
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

			//print_r($post_data); exit;
			$this->editBook($post_data);
		}
		else
		{
			$this->editBookForm($this->input->post('idBook'));
		}
	}
	//http://localhost:8888/webServices/LongStory/client/index.php/User/editUserForm
/////////////////////////////////////// EDIT BOOK ///////////////////////////////////

	///////////////////////////////////// SET OWNED ///////////////////////////////////
	function setOwned($post_data)
	{
		//print_r($post_data); exit;
		$con = curl_init();
		curl_setopt($con, CURLOPT_URL, $this->api_url . '/setowned/');
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
					$this->load->view('long_story/message/add_fail', $data);
					$this->load->view('general/footer');
					return;
			}
		}

		curl_close($con);

		$data = array(
			'message' => json_decode($response, true)
		);
		//print_r($data); exit;
		$this->load->view('general/header_html');
		$this->load->view('general/menu');
		$this->load->view('long_story/message/add_success_owned', $data);
	//	$this->getOwned($post_data['myIdUser']);
		$this->load->view('general/footer');
	}

	function setOwnedValidation()
	{
		$this->form_validation->set_rules('myIdUser', 'MyIdUser', 'required');
		$this->form_validation->set_rules('idBook', 'IdBook', 'required');

		if ($this->form_validation->run() === TRUE)
		{
			$data = array(
				'myIdUser' => $this->input->post('myIdUser'),
				'idBook' => $this->input->post('idBook')
			);

			//print_r($data); exit;
			$this->setOwned($data);
		}
	}
	///////////////////////////////////// END SET OWNED ///////////////////////////////////

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

	///////////////////////////////////// SET READ ///////////////////////////////////
	function setRead($post_data)
	{
		//print_r($post_data); exit;
		$con = curl_init();
		curl_setopt($con, CURLOPT_URL, $this->api_url . '/setread/');
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
					$this->load->view('long_story/message/add_fail', $data);
					$this->load->view('general/footer');
					return;
			}
		}

		curl_close($con);

		$data = array(
			'message' => json_decode($response, true)
		);
		//print_r($data); exit;
		$this->load->view('general/header_html');
		$this->load->view('general/menu');
		$this->load->view('long_story/message/add_success_read', $data);
		$this->load->view('general/footer');
		//$this->getRead($post_data['idBook']);
	}

	function setReadValidation()
	{
		$this->form_validation->set_rules('myIdUser', 'MyIdUser', 'required');
		$this->form_validation->set_rules('idBook', 'IdBook', 'required');

		if ($this->form_validation->run() === TRUE)
		{
			$data = array(
				'myIdUser' => $this->input->post('myIdUser'),
				'idBook' => $this->input->post('idBook')
			);

			//print_r($data); exit;
			$this->setRead($data);
		}
	}
	///////////////////////////////////// END SET READ ///////////////////////////////////

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

	///////////////////////////////////// SET WISHLIST ///////////////////////////////////
	function setWishlist($post_data)
	{
		//print_r($post_data); exit;
		$con = curl_init();
		curl_setopt($con, CURLOPT_URL, $this->api_url . '/setwishlist/');
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
					$this->load->view('long_story/message/add_fail', $data);
					$this->load->view('general/footer');
					return;
			}
		}

		curl_close($con);

		$data = array(
			'message' => json_decode($response, true)
		);
		//print_r($data); exit;
		$this->load->view('general/header_html');
		$this->load->view('general/menu');
		$this->load->view('long_story/message/add_success_wishlist', $data);
		$this->load->view('general/footer');
		//$this->getRead($post_data['idBook']);
	}

	function setWishlistValidation()
	{
		$this->form_validation->set_rules('myIdUser', 'MyIdUser', 'required');
		$this->form_validation->set_rules('idBook', 'IdBook', 'required');

		if ($this->form_validation->run() === TRUE)
		{
			$data = array(
				'myIdUser' => $this->input->post('myIdUser'),
				'idBook' => $this->input->post('idBook')
			);

			//print_r($data); exit;
			$this->setWishlist($data);
		}
	}
	///////////////////////////////////// END SET WISHLIST ///////////////////////////////////

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
		$post_data['name'] = str_replace(' ', '%20', $post_data['name']);
		$post_data['author'] = str_replace(' ', '%20', $post_data['author']);

		//print_r($post_data);exit;
		$con = curl_init();
		$url = $this->api_url.'/searchBook/';

		if ($post_data['name']!=""){
			$url.='/name/'.$post_data['name'];
		}
		if ($post_data['author']!=""){
			$url.='/author/'.$post_data['author'];
		}
		//print_r($post_data['author']);exit;

		if ($post_data['ISBN']!=""){
			$url.='/ISBN/'.$post_data['ISBN'];
		}

		//echo $url;exit;

		curl_setopt($con, CURLOPT_URL, $url);
		curl_setopt($con, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($con);
		//print_r($response);exit;
		// Check HTTP status code
		$books =array('books'=> json_decode($response,TRUE));
		curl_close($con);
		//print_r($books);exit;
		if (empty($books))
		{
			echo "não foi encontrado o livro";
		}
		else
		{
			$this->load->view('general/header_html');
			$this->load->view('general/menu');
			$this->load->view('long_story/book/search', $books);
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
					$this->load->view('long_story/message/add_fail', $data);
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
