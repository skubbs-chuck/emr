<?php

class Calendar extends Base_Controller {
    public function __construct() {
        parent::__construct();
        $this->_mainAssets();
        $this->_homeAssets();
        $this->addCss($this->tplUrl . 'plugins/datepicker/datepicker3.css')
             ->addCss($this->tplUrl . 'plugins/fullcalendar/fullcalendar.min.css')
             ->addCss($this->tplUrl . 'plugins/fullcalendar/fullcalendar.print.css" media="print')
             ->addJs($this->tplUrl . 'plugins/moment.min.js', false)
             ->addJs($this->tplUrl . 'plugins/datepicker/bootstrap-datepicker.js', false)
             ->addJs($this->tplUrl . 'plugins/fullcalendar/fullcalendar.js', false)
             ->addJs($this->tplUrl . 'js/calendar.js', false);
        $this->display();
    }

    public function index() {

    }
}