<?php
class Module_ThirdModule extends Module {
    public function __construct() {
        $this->name = 'thirdmodule';
        parent::__construct();
        $this->displayName = 'My Third Module';
        $this->version = '2.1.0';
        $this->author = 'Chuck Lagumbay';
    }

    public function install() {
        // parent::install();
        if (parent::install() && $this->registerHook('header') && $this->registerHook('footer') && $this->registerHook('other')) 
            return true;
        
        return false;
    }

    public function uninstall() {
        if (parent::uninstall()) 
            return true;
        
        return false;
    }

    public function _hookHeader() {
        // $this->addJs($this->_path . 'js/THIRDMODULE.js');
        // Template::addJs($this->_path . 'js/THIRDMODULE.js');
        // Template::addCss($this->_path . 'css/app.min.css');
        // echo "<div>hook header here from '$this->name'</div>";
        // echo "this is an header hook";
        // echo '<script type="text/javascript">alert("Hello World?")</script>';
    }

    public function _hookFooter() {
        // return 'asasasasasas';
    }

    public function _hookOther() {
        // return $this->display($this->_localPath . 'test.php', array('chuck' => 'Wew!!!'));
    }
}