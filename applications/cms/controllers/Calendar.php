<?php

class Calendar extends Base_Controller {
    public function index() {
        $this->_mainAssets();
        $this->_homeAssets();
        $this->addCss($this->tplUrl . 'plugins/fullcalendar/fullcalendar.min.css');
        $this->addCss($this->tplUrl . 'plugins/fullcalendar/fullcalendar.print.css" media="print');
        $this->addJs($this->tplUrl . 'plugins/moment.min.js', false);
        $this->addJs($this->tplUrl . 'plugins/fullcalendar/fullcalendar.js', false);
        $this->addJs($this->tplUrl . 'js/calendar.js', false);
        $this->display();
    }
}