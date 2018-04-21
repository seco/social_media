<?php 

	class Db {

		private static $instance = null;


		private $pdo,
				$stmt,
				$result,
				$error = false,
				$count = 0;


		private function __construct() {

			$this->pdo = new PDO("mysql:host=localhost;dbname=socialmedia", 'root', 'root');


		
		}



		public static function get_instance() {

			if(!isset(self::$instance)) {

				self::$instance = new Db;
			}

			return self::$instance;
		}



		public function query($sql, $fields = array()) {

			$this->error = false;

			if($this->stmt = $this->pdo->prepare($sql)) {

					
					if($fields) {

						$counter = 1;

						foreach($fields as $field) {

							$this->stmt->bindValue($counter, $field);

							$counter +=1;
						}
					}


					if($this->stmt->execute()) {

						

							$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);
							$this->count = $this->stmt->rowCount();



					} else {

						$this->error = true;
					}



			} else {

				$this->error = true;
			}

			return $this;
		}


		//extractin sql from fields

		public function action($action, $table, $where = array()) {

			$sql = "{$action} from {$table}";

			if($where && count($where) === 3) {


				$field = $where[0];
				$condition = $where[1];
				$value = $where[2];

				$sql .= " where {$field} {$condition} ?";

				if(!$this->query($sql, array($value))->error()) {

					return $this;
				}


			} else if(!$where) {

				if(!$this->query($sql)->error()) {

					return $this;
				}
			}

			return $this;

		}


		public function get($table, $where = array()) {

			$action = "select *";

			return $this->action($action, $table, $where);
		}


		public function delete($table, $where = array()) {


			$action = "delete";

			return $this->action($action, $table, $where);
		}




		//insert data into database

		public function insert($table, $fields) {

			//var_dump($fields);

			$columns = implode(', ', array_keys($fields));
			$marks = "";
			$counter = 1;

			foreach($fields as $field) {

				$marks .="?";

				if($counter < count($fields)) {

					$marks .=", ";
				}

				$counter +=1;
			}

			$sql = "insert into {$table} ({$columns}) values ({$marks})";

			if(!$this->query($sql, $fields)->error()) {

				return true;
			}

			return false;
		}


		//update fields in database

		public function update($table, $fields, $id) {

			$set = "";
			$counter = 1;


			foreach($fields as $field => $value) {

					$set .="{$field} = ?";


					if($counter < count($fields)) {

						$set .=", ";
					}

					$counter +=1;

			}  

			$sql = "update {$table} set {$set} where id = $id";

			if(!$this->query($sql, $fields)->error()) {

				echo "account updated";

				return true;
			}

			return false;
		}

		//general getters

		public function error() {

			return $this->error;
		}


		public function count() {

			return $this->count;
		}

		public function result() {

			return $this->result;
		}

		public function first() {

			return $this->result[0];
		}
	}