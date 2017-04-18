<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

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
	
	//This Controller loads the Main_Page view.
	public function index()
	{
		$this->load->view('main_page');
	}
	
	//Loads the portal view
	public function portal() {
		

		//If this is true then load the portal page. Else redirect to the restricted page.
		//Basically, if the user is logged in, go to the portal page, else it will take the user to a restricted page. 
		if ($this->session->userdata('is_logged_in')) {

			$this->load->view('portal_page'); 
		} else {
			redirect('Main/restricted');	 
		}	
	}

	//Loads the Select Difficulty view for the English test
	public function select_difficulty_english() {
		

		//If this is true then load the difficulty page. Else redirect to the restricted page.
		//Basically, if the user is logged in, go to the difficulty page for English, else it will take the user to a restricted page. 
		if ($this->session->userdata('is_logged_in')) {

			$this->load->view('select_difficulty_english'); 
		} else {
			redirect('Main/restricted');	 
		}	
	}

	//Loading the restricted view. 
	public function restricted() {
		$this->load->view('restricted'); 
	}

	
	//This controller valides the login page
	public function login_validation() {
		$this->load->model('Models_users');
		
		//Load the form validation library 
		$this->load->library('form_validation');

		//Setting the rules for the Email Field
		$this->form_validation->set_rules('STU_EMAIL', 'Email', 'required|trim|callback_validate_credentials');

		//Setting the rules for the password field, including MD5 hashing
		$this->form_validation->set_rules('STU_PASSWORD', 'Password', 'required|md5');

		//If this is successful, then go to the portal page. Else, stay on the main page
		if ($this->form_validation->run()){

			//Includes email and is_logged_in with the session data
			$data = array (
					'email' => $this->input->post('STU_EMAIL'),
					'full_name' => $this->Models_users->get_name(),
					'is_logged_in' => 1
				); 
			$this->session->set_userdata($data); 
			redirect('Main/portal');
		} else {
			$this->load->view('main_page'); 
		}
	}
	
	//Sets the validate credentials, so throws out messages like Incorrect username/password if user types in bad information. If user types in correct information, it will return true. 
	public function validate_credentials() {
		//Loads the Model_users model
		//This model will check if the Email/Password is in the database
		$this->load->model('Models_users');
		
		//If it found 1 record, then it will return true
		if ($this->Models_users->can_log_in()){
			return true;
		} else {
			$this->form_validation->set_message('validate_credentials', 'Incorrect username/password.');
			return false;
		}
	}

	//When the user clicks on the logout button, it kills the session. In other words, it logs them out. 
	public function logout () {
		$this->session->sess_destroy(); 
		redirect('Main/index'); 
	}

	//Loads the sign up view
	public function signup () {
		$this->load->view('signup'); 
	}

	//Runs the signup validation function 
	public function signup_validation() {
		//Loading the form validation library 
		$this->load->library('form_validation');
		//Setting the rules for the first name
		$this->form_validation->set_rules('STU_FNAME', 'First Name', 'required|trim|strtoupper');
		//Setting the rules for the Last Name
		$this->form_validation->set_rules('STU_LNAME', 'Last Name', 'required|trim|strtoupper');
		//Setting the rules for the Address
		$this->form_validation->set_rules('STU_ADDRESS', 'Address', 'required|trim|strtoupper');
		//Setting the rules for the City
		$this->form_validation->set_rules('STU_CITY', 'City', 'required|trim|strtoupper');
		//Setting the rules for the State
		$this->form_validation->set_rules('STU_STATE', 'State', 'required|trim|strtoupper|min_length[2]|max_length[2]');
		//Setting the rules for the zip
		$this->form_validation->set_rules('STU_ZIP', 'Zip Code', 'required|trim|strtoupper|min_length[5]|max_length[5]|is_natural');
		//Setting the rules for the Email Field
		$this->form_validation->set_rules('STU_EMAIL', 'Email', 'required|trim|valid_email|is_unique[STUDENT.STU_EMAIL]|strtoupper');
		//Setting the rules for the Password Field
		$this->form_validation->set_rules('STU_PASSWORD', 'Password', 'required|trim');
		//Setting the rules for the confirm Pasword Field, including matching the password field. 
		$this->form_validation->set_rules('STU_CPASSWORD', 'Confirm Password', 'required|trim|matches[STU_PASSWORD]');

		//Modifying the default message if the email address already exists.
		$this->form_validation->set_message('is_unique', "That email address already exists." );

		if ($this->form_validation->run()) {
			
			//Generate a random key
			$key = md5(uniqid());

			//Get first name
			$STU_FULLNAME = $_POST['STU_FNAME'];

			//Put a space
			$STU_FULLNAME .= " ";

			//Get last name
			$STU_FULLNAME .= $_POST['STU_LNAME'];

			//Correcting the casing for the email.
			$STU_FULLNAME = ucwords(strtolower($STU_FULLNAME));

			//This loads the email library
			$this->load->library('email', array('mailtype'=>'html'));
			//Load the Models_users model
			$this->load->model('Models_users');

			//This is where the email is from
			$this->email->from('noreply@preparetestcse345.co', "Prepare Test"); 

			//Who to send the email to 
			$this->email->to($this->input->post('STU_EMAIL'));

			//The subject of the email
			$this->email->subject("Confirm your account on preparetestcse345.co!");

			//The message of the email in a variable
			$message = "<p>Hello $STU_FULLNAME, </p> <br/>";
			//Adding more things to the message variable
			$message .= "<p>Thank you for signing up for Prepare Test CSE 345!</p>";
			$message .= "<p><a href='".base_url()."main/register_user/$key' >Click here</a> to confirm your account</p>"; 
			$message .= "<p>If you are unable to click on the above link, please copy and paste this url: <a href='".base_url()."main/register_user/$key' >".base_url()."main/register_user/$key </a></p><br/>"; 
			$message .= "<p>Thanks!</p>"; 
			$message .= "<p>The Prepare Test CSE 345 TEAM</p>"; 

			//The message the email library will send
			$this->email->message($message);

			//Adding the user to the temp student database.
			if ($this->Models_users->add_temp_student($key)) {
				//Telling the user the confirmation email has been sent. Else it will send a message stating the email could not be sent. 
				if ($this->email->send()) {
					$this->load->view('confirmhasbeensent'); 
				} else {
					echo "The email could not be sent.";
				}
			} else echo "Problem adding to the database. Contact Andrew"; 

			//If this is invalid, it will load the signup view
		} else {
			$this->load->view('signup'); 
		}

	}
	
	//This is what the user runs when they click on the confirmation link in their email
	//This adds the user into the STUDENT table from the TEMP_STUDENT table
	public function register_user($key) {
		//Load the model, Models_users
		$this->load->model('Models_users');
		
		//If the key is valid 
		if ($this->Models_users->is_key_valid($key)) {
			
			//Once we add the student to the STUDENT table
			if ($items = $this->Models_users->add_student_to_db($key)) {
				
				//Setting the email variable
				$neweemail = $items['STU_EMAIL'];
				
				//Setting STU_FULLNAME
				$STU_FULLNAME = $items['STU_FULLNAME'];

				//Creating the session array
				$data = array(
					'email' => $neweemail,
					'full_name' => $STU_FULLNAME,
					'is_logged_in' => 1
					);
				//Setting the session from the data array.
				$this->session->set_userdata($data);
				redirect('Main/portal');
			} else echo "Failed to add the student. Please contact Andrew.";


		} else echo "invalid key";

	  }

	  //Loads the confirmation page for the user 
	  public function confirm_test_english($difficulty) {
	  	//Checking if the string is entered is easy, medium, or hard. If it is anything else, it will take them to the restricted page.
	  	if (strtolower($difficulty) == 'easy' || strtolower($difficulty) == 'medium' || strtolower($difficulty) == 'hard' ) {
	  		//Confirming if the user is logged in
			if ($this->session->userdata('is_logged_in')) {
				//Putting the difficulty in an array (PHP/CI requires this when passing variables to a view)
				$arr_difficulty = array('diff' => ucwords(strtolower($difficulty)) ); 
				//Loading the confirm_test_english view, and passing the array. 
				$this->load->view('confirm_test_english', $arr_difficulty); 

			} else {
				//If user is not logged in, take them to the restricted page.
				redirect('Main/restricted');	 
			}	
		} else {
				//If difficulty is not easy, medium, hard, take them to the restricted page. 
				redirect('Main/restricted');	 
			}	

	  }

	  //Loading the English Test 
	  public function english_test($difficulty){
	  	  	//Checking if the string is entered is easy, medium, or hard. If it is anything else, it will take them to the restricted page.
	 
	  	if (strtolower($difficulty) == 'easy' || strtolower($difficulty) == 'medium' || strtolower($difficulty) == 'hard' ) {
	  		//Confirming if the user is logged in
			if ($this->session->userdata('is_logged_in')) {
				//Putting the difficulty in an array (PHP/CI requires this when passing variables to a view)
				$arr_difficulty = array('diff' => ucwords(strtolower($difficulty)) );

			  	$this->load->model('Models_users');

			  	$this->dataEnglish['Eng_Paragraph'] = $this->Models_users->get_english_paragraph($difficulty);
			  	$this->dataEnglish['Question'] = $this->Models_users->get_english_question($difficulty) ;

			  	$data = array_merge($arr_difficulty, $this->dataEnglish);

			  	//$this->load->view('english_test', $this->dataEnglishParagraph); 
				//Loading the english_test view, and passing the array. 
				$this->load->view('english_test', $data); 

			} else {
				//If user is not logged in, take them to the restricted page.
				redirect('Main/restricted');	 
			}	
		} else {
				//If difficulty is not easy, medium, hard, take them to the restricted page. 
				redirect('Main/restricted');	 
			}	

	  }

	  /*public function quiz_display_english() {

	  	$this->load->model('Models_users');
	  	$this->dataEnglishParagraph['Eng_Paragraph'] = $this->Models_users->get_english_paragraph();
	  	$this->load->view('english_test', $this->data);
	  } */
	  public function english_result_display($difficulty){
	 
	  	if (strtolower($difficulty) == 'easy' || strtolower($difficulty) == 'medium' || strtolower($difficulty) == 'hard' ) {
	  		
			if ($this->session->userdata('is_logged_in')) {

				$arr_difficulty = array('diff' => ucwords(strtolower($difficulty)) );

			  	$this->load->model('Models_users');

			  	$this->dataEnglish['Eng_Paragraph'] = $this->Models_users->get_english_paragraph($difficulty);
			  	$this->dataEnglish['results'] = $this->Models_users->get_english_question($difficulty) ;


				$this->dataCheck['checks'] = array(
				     'ques1' => $this->input->post('quizid1'),
				     'ques2' => $this->input->post('quizid2'),
					 'ques3' => $this->input->post('quizid3'),
					 'ques4' => $this->input->post('quizid4'),
				     'ques5' => $this->input->post('quizid5'),
					 'ques6' => $this->input->post('quizid6'),
					 'ques7' => $this->input->post('quizid7'),
					 'ques8' => $this->input->post('quizid8'),
				     'ques9' => $this->input->post('quizid9'),
					 'ques10' => $this->input->post('quizid10'),
					 'ques11' => $this->input->post('quizid11'),
					 'ques12' => $this->input->post('quizid12'),
					 'ques13' => $this->input->post('quizid13'),
					 'ques14' => $this->input->post('quizid14'),
					 'ques15' => $this->input->post('quizid15')
				);

				$arr_checks = $this->dataCheck;
				$arr_dataEnglish = $this->dataEnglish;

			  	$data = array_merge($arr_difficulty,$arr_dataEnglish, $arr_checks );


				$this->load->view('english_result_display', $data); 

			} else {
				//If user is not logged in, take them to the restricted page.
				redirect('Main/restricted');	 
			}	
		} else {
				//If difficulty is not easy, medium, hard, take them to the restricted page. 
				redirect('Main/restricted');	 
			}	

	  }

	//Loads the Select Difficulty view for the English test
	public function select_difficulty_reading() {
		

		//If this is true then load the difficulty page. Else redirect to the restricted page.
		//Basically, if the user is logged in, go to the difficulty page for English, else it will take the user to a restricted page. 
		if ($this->session->userdata('is_logged_in')) {

			$this->load->view('select_difficulty_reading'); 
		} else {
			redirect('Main/restricted');	 
		}	
	}
	  //Loads the confirmation page for the user 
	  public function confirm_test_reading($difficulty) {
	  	//Checking if the string is entered is easy, medium, or hard. If it is anything else, it will take them to the restricted page.
	  	if (strtolower($difficulty) == 'easy' || strtolower($difficulty) == 'medium' || strtolower($difficulty) == 'hard' ) {
	  		//Confirming if the user is logged in
			if ($this->session->userdata('is_logged_in')) {
				//Putting the difficulty in an array (PHP/CI requires this when passing variables to a view)
				$arr_difficulty = array('diff' => ucwords(strtolower($difficulty)) ); 
				//Loading the confirm_test_english view, and passing the array. 
				$this->load->view('confirm_test_english', $arr_difficulty); 

			} else {
				//If user is not logged in, take them to the restricted page.
				redirect('Main/restricted');	 
			}	
		} else {
				//If difficulty is not easy, medium, hard, take them to the restricted page. 
				redirect('Main/restricted');	 
			}	

	  }

	  //Loading the English Test 
	  public function reading_test($difficulty){
	  	  	//Checking if the string is entered is easy, medium, or hard. If it is anything else, it will take them to the restricted page.
	 
	  	if (strtolower($difficulty) == 'easy' || strtolower($difficulty) == 'medium' || strtolower($difficulty) == 'hard' ) {
	  		//Confirming if the user is logged in
			if ($this->session->userdata('is_logged_in')) {
				//Putting the difficulty in an array (PHP/CI requires this when passing variables to a view)
				$arr_difficulty = array('diff' => ucwords(strtolower($difficulty)) );

			  	$this->load->model('Models_users');

			  	$this->dataEnglish['CONTENT'] = $this->Models_users->get_reading_paragraph($difficulty);
			  	$this->dataEnglish['Question'] = $this->Models_users->get_reading_question($difficulty) ;

			  	$data = array_merge($arr_difficulty, $this->dataEnglish);

			  	//$this->load->view('english_test', $this->dataEnglishParagraph); 
				//Loading the english_test view, and passing the array. 
				$this->load->view('english_test', $data); 

			} else {
				//If user is not logged in, take them to the restricted page.
				redirect('Main/restricted');	 
			}	
		} else {
				//If difficulty is not easy, medium, hard, take them to the restricted page. 
				redirect('Main/restricted');	 
			}	

	  }



}
