<?php
class Module_FirstModule extends Module {
	public function __construct() {
		$this->name = 'firstmodule';
		parent::__construct();
		$this->displayName = 'My First Module';
		$this->version = '8';
		$this->author = 'Chuck Lagumbay';
	}

	public function install() {
		// parent::install();
		if (parent::install() && $this->registerHook('header')) 
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
        // $this->addJs($this->_path . 'js/first_module.js', FALSE);
        // $this->addJs($this->_path . 'js/first_module1.js', false);
        // $this->addCss($this->_path . 'css/first_module.css');
	}
}