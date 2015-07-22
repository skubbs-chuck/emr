<?php

class Misc extends Base_Controller {
    private $_backupFolder;
    
    public function __construct() {
        parent::__construct();
        $this->_backupFolder = PATH_ROOT . 'misc' . DS;
    }

    public function export_db() {
        $command = 'C:\xampp\mysql\bin\mysqldump.exe --opt -uroot ' . $this->db->database . ' > ' . $this->_backupFolder . '_' . $this->db->database . '.sql';
        exec($command);
    }

    public function import_db() {
        $file = $this->_backupFolder . '_' . $this->db->database . '.sql';
        $command = 'C:\xampp\mysql\bin\mysql.exe -uroot ' . $this->db->database . ' < ' . $this->_backupFolder . '_' . $this->db->database . '.sql';
        exec($command);
    }
}