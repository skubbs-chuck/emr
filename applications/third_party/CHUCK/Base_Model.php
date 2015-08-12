<?php
include_once __DIR__ . DS . 'Hook.php';
include_once __DIR__ . DS . 'Module.php';
class Base_Model extends MY_Model {
    protected $format = array(
        'sql_datetime' => 'Y-m-d H:i:s', 
        'sql_time' => 'H:i:s', 
        'sql_date' => 'Y-m-d', 
        'date' => 'Y-m-d', 
        'time' => 'h:i A', 
    );
    
    protected function _post() {
        $arr = func_get_args();
        if ($arr) {
            $result = array();
            foreach ($arr as $key) {
                $result[$key] = $this->input->post($key);
            }

            return $result;
        }

        return $this->input->post(NULL);
    }
}