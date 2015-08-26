<?php

class Base_Controller Extends MY_Controller {
    // protected $_data = array(); // data from config and base
    protected $data = array(); // data from anything else
    protected $module; // base module
    protected $tplUrl = '';
    protected $controller; // current controller
    protected $method; // current method
    protected $cm; // controller and method (controller/method)
    protected $c_m; // controller and method (controller_method)

    public function __construct() {
        parent::__construct();
        $this->controller = $this->router->fetch_class();
        $this->method = $this->router->fetch_method();
        $this->cm = $this->controller . '/' . $this->method;
        $this->c_m = $this->controller . '_' . $this->method;

        $data = $this->config->item('data');
        $this->module = new Module;
        // add css & js
        $this->tplUrl = base_url() . $data['url_theme'];
        $this->_mainAssets();
    }

    protected function _post() {
        $arr = func_get_args();
        if ($arr) {
            $result = array();
            foreach ($arr as $key) {
                $result[$key] = $this->input->post($key);
            }

            return $result;
        }

        return $this->input->post(false, $xss_clean);
    }

    protected function mysqlDate($date) {
        return date("Y-m-d", strtotime($date));
    }

    protected function mysqlDateTimeNow() {
        return date("Y-m-d H:i:s");
    }

    protected function formatDate($date, $format = "jS F, Y") {
        return date($format, strtotime($date));
    }

    protected function _mainAssets() {
        $this->addCss($this->tplUrl . 'css/bootstrap.min.css')
             ->addCss($this->tplUrl . 'css/font-awesome.min.css')
             ->addCss($this->tplUrl . 'css/AdminLTE.min.css')
             ->addCss($this->tplUrl . 'css/skubbs.css');

        $this->addJs($this->tplUrl . 'plugins/jQuery/jQuery-2.1.4.min.js', false)
             ->addJs($this->tplUrl . 'js/bootstrap.min.js');   
    }

    protected function _homeAssets() {
        $this->addCss($this->tplUrl . 'css/ionicons.min.css')
             ->addCss($this->tplUrl . 'css/skins/skin-blue.min.css');

        $this->addJs($this->tplUrl . 'plugins/slimScroll/jquery.slimscroll.min.js')
             ->addJs($this->tplUrl . 'js/app.min.js');
    }

    protected function setFlashAlert($message, $type = false) {
        $flashdata = '';
        switch ($type) {
            case 'error':
            case 'danger':
            case 3:
                $flashdata .= '<div class="alert alert-danger">';
                $flashdata .= '<i class="icon fa fa-ban"></i> ' . $message;
                $flashdata .= '</div>';
                break;
            case 'warning':
            case 2:
                $flashdata .= '<div class="alert alert-warning">';
                $flashdata .= '<i class="icon fa fa-warning"></i> ' . $message;
                $flashdata .= '</div>';
                break;
            case 'success':
            case 1:
                $flashdata .= '<div class="alert alert-success">';
                $flashdata .= '<i class="icon fa fa-check"></i> ' . $message;
                $flashdata .= '</div>';
                break;
            default:
                $flashdata .= '<div class="alert alert-info">';
                $flashdata .= '<i class="icon fa fa-info"></i> ' . $message;
                $flashdata .= '</div>';
                break;
        }

        $this->session->set_flashdata('alert_message', $flashdata);
    }

    protected function addCss($path) {
        $this->module->addCss($path);
        return $this;
    }

    protected function addJs($path, $bottom = TRUE) {
        $this->module->addJs($path, $bottom);
        return $this;
    }

    protected function display($name = false, $other_data = array()) {
        $this->module->init();
        $this->module->hooks();
        $this->module->createHooksVar();
        $data = $this->config->item('data');
        $data['tpl_url'] = $this->tplUrl;
        $data['user'] = $this->session->userdata('user') ? $this->session->userdata('user') : false;
        $data['cm'] = $this->cm;
        $data['current_page'] = isset($other_data['current_page']) ? $other_data['current_page'] : $this->cm;
        
        $data['inc_header'] = VIEWPATH . $data['theme'] . DS . 'inc' . DS . 'header.php';
        $data['inc_left_column'] = VIEWPATH . $data['theme'] . DS . 'inc' . DS . 'left_column.php';
        $data['inc_right_column'] = VIEWPATH . $data['theme'] . DS . 'inc' . DS . 'right_column.php';
        $data['inc_footer'] = VIEWPATH . $data['theme'] . DS . 'inc' . DS . 'footer.php';
        $data = array_replace_recursive($data, $this->data, $other_data);

        
        if (file_exists(VIEWPATH . $data['theme'] . DS . $this->cm . '.php')) 
            $name = $this->cm; // controller_name/method_name.php
        else if (file_exists(VIEWPATH . $data['theme'] . DS . $this->c_m . '.php')) 
            $name = $this->c_m; // controller_name_method_name.php
        
        $name = ($this->method == 'index') ? $this->controller : ((!$name) ? strtoupper($this->controller) . '-' . strtoupper($this->method) . ' doesnt exist' : $name);
        

        $this->load->view($data['theme'] . '/' . $name, $data);
    }

    protected function _pagination($config = array()) {
        $this->load->library('pagination');
        $pagination = array();
        $pagination["base_url"] = base_url() . $this->cm;
        $pagination["total_rows"] = 0;
        $pagination["per_page"] = 10;
        $pagination["uri_segment"] = 3;
        $pagination['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $pagination['full_tag_close'] = '</ul>';
        $pagination['first_link'] = false;
        $pagination['last_link'] = false;
        $pagination['first_tag_open'] = '<li>';
        $pagination['first_tag_close'] = '</li>';
        $pagination['prev_link'] = '&laquo';
        $pagination['prev_tag_open'] = '<li class="prev">';
        $pagination['prev_tag_close'] = '</li>';
        $pagination['next_link'] = '&raquo';
        $pagination['next_tag_open'] = '<li>';
        $pagination['next_tag_close'] = '</li>';
        $pagination['last_tag_open'] = '<li>';
        $pagination['last_tag_close'] = '</li>';
        $pagination['cur_tag_open'] = '<li class="active"><a href="#">';
        $pagination['cur_tag_close'] = '</a></li>';
        $pagination['num_tag_open'] = '<li>';
        $pagination['num_tag_close'] = '</li>';
        $pagination['page'] = ($this->uri->segment($pagination["uri_segment"])) ? (int) $this->uri->segment($pagination["uri_segment"]) : 0;

        return array_replace_recursive($pagination, $config);
    }
}