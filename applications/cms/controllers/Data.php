<?php

class Data extends Base_Controller {
    public function import() {
        $this->_homeAssets();
        $this->display('comming_soon');
    }

    public function export() {
        $this->_homeAssets();
        $this->display('comming_soon');
    }

    public function usage() {
        $this->_homeAssets();
        $this->display('comming_soon');
    }
}