<?php

class MY_Router extends CI_Router {
	public function fetch_class()
	{
		return strtolower($this->class);
	}

	public function fetch_method()
	{
		return strtolower($this->method);
	}
}