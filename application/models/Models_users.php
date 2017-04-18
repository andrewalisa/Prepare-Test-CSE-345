<?php

class Models_users extends CI_Model {
	

	public function can_log_in() {

		//Looking for the STU_EMAIL that the user typed in
		$this->db->where('STU_EMAIL', $this->input->post('STU_EMAIL'));

		//Looking for the STU_PASSWORD that the user typed in
		$this->db->where('STU_PASSWORD', md5($this->input->post('STU_PASSWORD')));

		//Looking for the information the user typed in, from the STUDENT table. 
		$query = $this->db->get('STUDENT');
		

		//If it found the user (so they entered in valid credentials) then return true! Otherwise, return false.
		if ($query->num_rows() == 1){
			return true;
		} else {
			return false;
		}

		if ($query) {
			$row = $query->row_array();
		}
	}


		public function get_name() {

		//Looking for the STU_EMAIL that the user typed in
		$this->db->where('STU_EMAIL', $this->input->post('STU_EMAIL'));

		//Looking for the information the user typed in, from the STUDENT table. 
		$query = $this->db->get('STUDENT');
		

		//If it found the user (so they entered in valid credentials) then return true! Otherwise, return false.
		if ($query->num_rows() == 1){
			$row = $query->row_array();

			$Fullname =  $row['STU_FNAME'];
			$Fullname .= " ";
			$Fullname .=  $row['STU_LNAME'];
			return $Fullname;
		} else {
			return false;
		}

		if ($query) {
			$row = $query->row();
		}
	}
    

	//Adding the student that signed up on the sign up page to our temp student table. 
	public function add_temp_student($key) {

		$data = array (
		'STU_FNAME' => $this->input->post('STU_FNAME'), 
		'STU_LNAME' => $this->input->post('STU_LNAME'),
		'STU_ADDRESS' => $this->input->post('STU_ADDRESS'),
		'STU_CITY' => $this->input->post('STU_CITY'),
		'STU_STATE' => $this->input->post('STU_STATE'),
		'STU_ZIP' => $this->input->post('STU_ZIP'),
		'STU_EMAIL' => $this->input->post('STU_EMAIL'), 
		'STU_PASSWORD' => md5($this->input->post('STU_PASSWORD')),
		'STU_KEY' => $key

		);

		//Inserting the student into the TEMP_STUDENT table
		$query = $this->db->insert('TEMP_STUDENT', $data);

		//If it is successful, return true, else return false. 
		if ($query) {
			return true;
		} else {
			return false; 
		}

	}

	//Checking if the key is valid
	public function is_key_valid($key) {
		$this->db->where('STU_KEY', $key);
		$query = $this->db->get('TEMP_STUDENT');

		if ($query->num_rows() == 1) {
			return true;
		} else {
			return false; 
		}
	}

	//Adding the user to the regular STUDENT database. 
	public function add_student_to_db($key) {
		//Looking for STU_KEY which is the key that is auto generated in the TEMP STUDENT table
		$this->db->where('STU_KEY', $key);
		$temp_student = $this->db->get('TEMP_STUDENT');

		if ($temp_student) {
			$row = $temp_student->row();

			$data = array(
				'STU_FNAME' => $row->STU_FNAME,
				'STU_LNAME' => $row->STU_LNAME,
				'STU_ADDRESS' => $row->STU_ADDRESS,
				'STU_CITY' => $row->STU_CITY,
				'STU_STATE' => $row->STU_STATE,
				'STU_ZIP' => $row->STU_ZIP, 
				'STU_EMAIL' => $row->STU_EMAIL,
				'STU_PASSWORD' => $row->STU_PASSWORD); 
				
			$out['STU_EMAIL'] = $data['STU_EMAIL'];
			$out['STU_FULLNAME'] = $data['STU_FNAME'];
			$out['STU_FULLNAME'] .= " "  ;
			$out['STU_FULLNAME'] .= $data['STU_LNAME'] ;

			//Inserting the data from the TEMP_STUDENT table into the STUDENT table
			$add_student = $this->db->insert('STUDENT', $data);
		}
		//Once I add the student, delete from the TEMP_STUDENT DB.
		if ($add_student) {
			$this->db->where('STU_KEY', $key);
			$this->db->delete('TEMP_STUDENT');
			return $out;
		} else {
			return false; 
		}
	}

	public function get_english_paragraph($difficulty){
		$diff = substr($difficulty, 0, 1); 
		$where = "ENGLISH_PROB.ENG_PARA_ID = ENGLISH_PARAGRAPH.ENG_PARA_ID
							AND ENGLISH_PROB.PROB_ID = PROBLEM.PROB_ID
							AND PROBLEM.DIFF_LEVEL = '";
		$where .= $diff;
		$where .= "'";
		$this->db->distinct();
		$this->db->select("ENGLISH_PARAGRAPH.CONTENT");
		$this->db->where($where);
		$query = $this->db->get('ENGLISH_PROB, PROBLEM, ENGLISH_PARAGRAPH');

		return $query->result();

		$num_data_return = $query->num_rows;

		if ($num_data_return < 1) {
			echo "There is nothing in the database";
			exit();
		}
	}

	public function get_english_question($difficulty){
		$diff = substr($difficulty, 0, 1);

		$where = "ENGLISH_PROB.PROB_ID = PROBLEM.PROB_ID AND PROBLEM.DIFF_LEVEL = '";
		$where .= $diff;
		$where .= "'";

		$this->db->select("ENG_PROB_ID, PROB_QUESTION, PROB_CHOICE_1, PROB_CHOICE_2, PROB_CHOICE_3, PROB_ANSWER");
		$this->db->where($where);
		$query = $this->db->get('ENGLISH_PROB, PROBLEM');

		return $query->result();

		$num_data_return = $query->num_rows;

	}

	public function creating_log() {
		$now = new DateTime(null, new DateTimeZone('America/New_York'));
		$date = $now->format('Y-m-d H:i:s');

		$email = $this->session->userdata('email');

		$this->db->where('STU_EMAIL', $email);

		$query = $this->db->get('STUDENT');

		$this->db->select('MAX(TEST_ID)');
		$query_test_id = $this->db->get('TEST'); 


			if ($query_test_id->num_rows() == 1) {
				$row = $query->row_array();

				$TEST_ID = $row['TEST_ID'] + 1;

			} else {
				$TEST_ID = 1; 
			}

			if ($query->num_rows() == 1) {
				$row = $query->row_array();

				$STU_ID =  $row['STU_ID'];

				$data = array(
					'TEST_ID' => $TEST_ID,
					'STU_ID' => $STU_ID,
					'TEST_DATETIME' => $date
				); 

				$this->db->insert('test', $data); 
				return true;
			} else {
				return false;
			}


	}

	public function get_reading_paragraph($difficulty){
		$diff = substr($difficulty, 0, 1); 
		$where = "READING_PROB.PARA_ID = PARAGRAPH.PARA_ID
							AND READING_PROB.PROB_ID = PROBLEM.PROB_ID
							AND PROBLEM.DIFF_LEVEL = '";
		$where .= $diff;
		$where .= "'";
		$this->db->distinct();
		$this->db->select("PARAGRAPH.CONTENT");
		$this->db->where($where);
		$query = $this->db->get('READING_PROB, PROBLEM, PARAGRAPH');

		return $query->result();

		$num_data_return = $query->num_rows;

		if ($num_data_return < 1) {
			echo "There is nothing in the database";
			exit();
		}
	}

	public function get_reading_question($difficulty){
		$diff = substr($difficulty, 0, 1);

		$where = "READING_PROB.PROB_ID = PROBLEM.PROB_ID AND PROBLEM.DIFF_LEVEL = '";
		$where .= $diff;
		$where .= "'";

		$this->db->select("READING_PROB_ID, PROB_QUESTION, PROB_CHOICE_1, PROB_CHOICE_2, PROB_CHOICE_3, PROB_ANSWER");
		$this->db->where($where);
		$query = $this->db->get('READING_PROB, PROBLEM');

		return $query->result();

		$num_data_return = $query->num_rows;

	}

}