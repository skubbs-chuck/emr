<?php

class Item extends Base_Controller {
    public function management() {
        $this->_homeAssets();
        $this->display('comming_soon');
    }
}