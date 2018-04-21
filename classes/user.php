<?php 

	class User {

		private $db  = null,
				$session_name = null,
				$cookie_name = null,
				$data = array(),
				$logged_in = false;


		public function __construct($user = null) {


			$this->db = db::get_instance();

			$this->session_name = config::get('session/session_name');

			$this->cookie_name = config::get('cookie/cookie_name');

			if(!$user) {

				if(session::exist($this->session_name)) {

					$user = session::get($this->session_name);

					if($this->find($user)) {

						$this->logged_in = true;
					}

				}
			} else {

				$this->find($user);
			}

		}


		public function create($fields) {

			$account = $this->db->insert('users', $fields);

			if(!$account) {

				return false;
			}
			session::flash('account', 'Your account '.input::get('username').' was successfully created');
			return true;
		}

		public function find($user = null) {

			$field = (is_numeric($user)) ? 'id' : 'username';

			$user = $this->db->get('users', array($field, '=', $user));

			if($user->count()) {

				$this->data = $user->first();

				//var_dump($this->data);

				return true;
			}

			return false;
		}

		public function login($username = null, $password = null) {


			$user = $this->find($username);

			if($user) {

				if($this->data()->password === hash::make($password, $this->data()->salt)) {

					session::put($this->session_name, $this->data()->id);

					return true;
				}

			}


			return false;
		}



		public function data() {

			return $this->data;
		}


		public function logged_in() {

			return $this->logged_in;
		}

		public function logout() {

			session::delete($this->session_name);
		}
	}