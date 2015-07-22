<?php

class Model_Password extends Base_Model {
	public function hash($password, $salt) {
		return md5($password . md5($password . $salt));
	}

	function generateSalt($max = 8) {
		$characterList = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*?";
		$i = 0;
		$salt = "";
		while ($i < $max) {
			$salt .= $characterList{mt_rand(0, (strlen($characterList) - 1))};
			$i++;
		}
		return $salt;
	}

	public function verify($pass, $db_pass, $db_salt) {
		return ($this->hash($pass, $db_salt) == $db_pass) ? TRUE : FALSE;
	}
}