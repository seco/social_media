<?php 


	class Post {


		private $db = null,
				$data = null;

		public function __construct($user_id = null) {

			$this->db = db::get_instance();

			if($user_id) {

				//get all from post with the user id;

				$post = $this->db->get('posts', array('user_id', '=', $user_id));

				if($post->count()) {

					$this->data = $post->result();
				}
			}
		}


		public function create_post($fields) {

		
				$post = $this->db->insert('posts', $fields);

				if($post) {

					return true;
				}
		
			return false;
		}


		public function exist() {

			return (!empty($this->data)) ? true : false;
		}

		public function data() {

			return $this->data;
		}
	}