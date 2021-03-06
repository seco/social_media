<?php 



	class User {

		private $db = null,
				$session_name = null,
				$logged_in = false,
				$data = array();


		public function __construct($user = null) {

			$this->db = db::get_instance();
			$this->session_name = config::get('session/session_name');

			if(!$user) {



				//check if session exist

				if(session::exist($this->session_name)) {


					$user = session::get($this->session_name);

					if($this->find($user)) {


						$this->logged_in =  true;
					}
				} 
			}

		}


		public function find($user) {

			$field = (is_numeric($user)) ? "id" : "email";
 
			$user = $this->db->get('users', array($field, '=', $user));

			if($user->count()) {

				$this->data = $user->first();

				return true;
			}


			return false;

		}



		public function login($username, $password) {

			$user = $this->find($username);

			if($user) {



				if($password  == $this->data()->password) {
					
					session::put($this->session_name, $this->data()->id);
					return true;
				}
			}

			return false;
		} 


		public function update_profile($file) {

			$file_name = File::upload($file);

			$fields = array(

				"user_id" => $this->data()->id,
				'file_name' => $file_name

			);

			$user = $this->db->get('profile_images', array('user_id', '=', $this->data()->id));

			if($user->count()) {


				$profile_id = $user->first()->id;

				$update = $this->db->update('profile_images', array('file_name' => $file_name), $profile_id);

				if($update) {


					return true;
				}

			}



			//insert data into profile images;

			$profile_insert = $this->db->insert('profile_images', $fields);


			//if insert success update the user profile in  the user table
			if($profile_insert) {

				$update = $this->db->update('users', array('profile_status'=> 1), $this->data()->id);

				if($update) {


					return true;
				}
			}

			return false;
		}



		public function update_account($fields) {


			if($this->exist()) {

					$account_update = $this->db->update('users', $fields, $this->data()->id);

					echo $this->data()->id;

					if($account_update) {

						return true;
					}
			}

			return false;
		}


		public function get_profile_picture($user_id = false) {



			if($this->exist()) {

					if(!$user_id) {

						$user_id = $this->data()->id;
					}

					$profile_pic = $this->db->get('profile_images', array('user_id', '=', $user_id));

					if($profile_pic->count()) {

						$file = $profile_pic->first()->file_name;

						return $file;
					}

			}

			return "default.jpg";

		}



		public function create_account($fields) {

			$account = $this->db->insert('users', $fields);

			if($account) {

				session::flash("account", "Your account ".input::get('email')." was successfully created");
				return true;
			}

			return false;

		}




		public function search($search) {

			$users = $this->db->get('users', array("username", "like", "%$search%"));

			if($users->count()) {

				return $users->result();
			}

			return false;
		}





		public function get_user_profile($user_id) {

			$user = $this->db->get('users', array('id', '=', $user_id));

			if($user->count()) {

				return $user->first();
			}

			return false;
		}



		public function check_follow($fields) {

				$sql = "select * from follow where user_id = ? and follower_id = ?";

				$check = $this->db->query($sql, $fields);

				if($check->count()) {

					return true;
				}

				return false;
		}

		public function follow($fields) {

			$check = $this->check_follow($fields);

			if(!$check) {

				//inert data inot followers table

				$insert = $this->db->insert('follow', $fields);

				if($insert) {

					return true;
				}

				return false;
			}


		}


		public function get_following($user_id) {


			$sql = "select * from follow  

			inner join users
			on follow.follower_id = users.id

			where follow.user_id = ?";

			$fields = array(

				'user_id' => $user_id

			);

			$user = $this->db->query($sql, $fields);

			if($user->count()) {

				return $user->result();
			}

			return false;
		}



		public function logout() {

			session::delete($this->session_name);


		}




		public function data() {

			return $this->data;
		}





		public function logged_in() {

			return $this->logged_in;
		}


		public function exist() {

			return (!empty($this->data())) ? true : false;
		}
	}