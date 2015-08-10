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

    public function form_dropdown($name, $options, $selected, $js = '') {
        $selected = array_key_exists($this->input->post($name), $options) 
            ? $this->input->post($name, TRUE) : $selected;
        return form_dropdown($name, $options, $selected, $js);
    }

    public function form_input($name, $value, $attr = array()) {
        $value = $this->input->post($name) ? $this->input->post($name, TRUE) : $value;
        $inp = array_merge_recursive(array('name' => $name, 'value' => $value), $attr);
        return form_input($inp);
    }

    public function form_textarea($name, $value, $attr = array()) {
        $value = $this->input->post($name) ? $this->input->post($name, TRUE) : $value;
        $inp = array_merge_recursive(array('name' => $name, 'value' => html_escape($value), 'rows' => 3), $attr);
        return form_textarea($inp);
    }
}