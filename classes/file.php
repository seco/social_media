<?php 



Class File {

	public static function upload($file) {

		$file_name = $file['name'];
		$file_tmp_name = $file['tmp_name'];
		$file_error = $file['error'];


		$file_ext = explode('.', $file_name);
		$file_ext = strtolower(end($file_ext));

		$allowed = array('jpeg', 'png', 'jpg');




		if(in_array($file_ext, $allowed)) {



			$file_new_name = md5(uniqid()).".".$file_ext;

			$file_destination = "uploads/".$file_new_name;

			if(move_uploaded_file($file_tmp_name, $file_destination)) {


				return $file_new_name;	
			}

		}

		return false;
	}
}