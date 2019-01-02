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


		$this->api_url='http://localhost:8888/webServices/ProjetoFinalWS/server/index.php/api/user';

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
	}

	public function index()
	{

		//$this->getMovies();
	}


	function getUsers($id = 0)
	{

		$con = curl_init();
		if ($id == 0)
			curl_setopt($con, CURLOPT_URL, $this->api_url.'/getUser/');
		else
			curl_setopt($con, CURLOPT_URL, $this->api_url.'/getUser/id/'. $id);


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
			'movies' => json_decode($response, true)
		);
		$this->load->view('general/header');
		$this->load->view('clientrest/movies', $data);
		$this->load->view('general/footer');
	}

	function getGender()
	{
		$con = curl_init();
		curl_setopt($con, CURLOPT_URL, $this->api_url.'/getgender/');
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
			'genders' => json_decode($response, true)
		);
		$this->load->view('geral/header');
		$this->load->view('clientrest/gender', $data);
		$this->load->view('geral/footer');
	}


	function addMovie($post_data)
	{
		//print_r($post_data); exit;
		$post_data['user_id'] ='1';
		$con = curl_init();
		curl_setopt($con, CURLOPT_URL, $this->api_url . '/addmovie/');
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
		$this->load->view('geral/header');
		$this->load->view('clientrest/movies', $data);
		$this->load->view('geral/footer');
	}


	function rateMovie($post_data)
	{
		$con = curl_init();
		curl_setopt($con, CURLOPT_URL, $this->api_url.'/rateMovie/');
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

		/*curl_close($con);

        $data = array(
            'movies' => json_decode($response, true)
        );
        $this->load->view('geral/header');
        $this->load->view('clientrest/movies', $data);
        $this->load->view('geral/footer');*/
		$this->getMovies($post_data['movie_id']);
	}

	function addMovieForm()
	{
		$this->load->view('geral/header');
		$this->load->view('clientrest/add_movie');
		$this->load->view('geral/footer');
	}

	/**
	 *
	 */
	function addMovieValidation()
	{


		$this->form_validation->set_rules('inputTitle', 'Title', 'required');
		$this->form_validation->set_rules('inputYear', 'Year', 'required');
		$this->form_validation->set_rules('inputDescription', 'Description', 'required');
		$this->form_validation->set_rules('inputImdb_id', 'IMDB', 'required');
		$this->form_validation->set_rules('inputGender', 'Gender', 'required');



		if ($this->form_validation->run() === TRUE)
		{
			$post_data= array(
				'title' => $this->input->post('inputTitle'),
				'year' => $this->input->post('inputYear'),
				'description' => $this->input->post('inputDescription'),
				'imdb_id' => $this->input->post('inputImdb_id'),
				'gender_id' => $this->input->post('inputGender'),
			);

			if (isset($_FILES) && $_FILES['userfile']['error']==0){
				$config['upload_path'] = 'upload/';
				$config['allowed_types'] = '*';
				$this->load->library('upload', $config);

				if (! $this->upload->do_upload('userfile')){
					$data= array(
						'message' => $this->upload->display_errors()
					);

					$this->load->view('geral/header');
					echo $data['message'];
					$this->load->view('geral/footer');
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
			}

			//print_r($post_data); exit;
			$this->addMovie($post_data);
		}
		else
		{
			$this->addMovieForm();
		}

	}

	/**
	 *
	 */
	function addRatingValidation()
	{
		$this->form_validation->set_rules('inputRating', 'Rating', 'required');
		$this->form_validation->set_rules('inputMovie', 'Movie', 'required');



		if ($this->form_validation->run() === TRUE)
		{
			$post_data= array(
				'rating' => $this->input->post('inputRating'),
				'movie_id' => $this->input->post('inputMovie'),
				'user_id' => '1'
			);

			$this->rateMovie($post_data);
		}
		else
		{
			$this->getMovies($this->input->post('inputMovie'));
		}

	}

	function viewMovie($id=0)
	{
		$con = curl_init();
		if ($id == 0)
			curl_setopt($con, CURLOPT_URL, $this->api_url.'/getmovie/');
		else
			curl_setopt($con, CURLOPT_URL, $this->api_url.'/getmovie/id/'. $id);


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
			'movies' => json_decode($response, true)
		);

		//print_r($data); exit;
		$this->load->view('geral/header');
		$this->load->view('clientrest/viewMovie', $data['movies'][0]);
		$this->load->view('geral/footer');
	}

}


//http://controlaltdelete.pt/uac/ws/index.php/api/taskmanager/tasks
