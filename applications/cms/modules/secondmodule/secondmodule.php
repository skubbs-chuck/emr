<?php
class Module_SecondModule extends Module {
	public function __construct() {
		$this->name = 'secondmodule';
		parent::__construct();
		$this->displayName = 'My Second Module';
		$this->version = '1.0';
		$this->author = 'Chuck Lagumbay';
	}

	public function install() {
		// parent::install();
		if (parent::install() && $this->registerHook('header') && $this->registerHook('home')) 
			return true;
		
		return false;
	}

	public function uninstall() {
		if (parent::uninstall()) 
			return true;
		
		return false;
	}

	public function _hookHeader() {
        // Template::addJs($this->_path . 'js/app.min.js');
        // Template::addCss($this->_path . 'css/app.min.css');
		// echo "<div>hook header here from '$this->name'</div>";
	}
}