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


			$add_student = $this->db->insert('STUDENT', $data);
		}
		//Once I add the student, delete from the TEMP_STUDENT DB.
		if ($add_student) {
			$this->db->where('STU_KEY', $key);
			$this->db->delete('TEMP_STUDENT');
			return $data['STU_EMAIL'];
		} else {
			return false; 
		}
	}
}