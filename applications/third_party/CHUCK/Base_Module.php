<?php
class Base_Module extends MY_Model {
    public $user_id;
    public $_controller;
    public $_method;
    public $_moduleInstance = array();

    public function __construct() {
        parent::__construct();
        $user = $this->model_session->user();
        $this->user_id = isset($user->id) ? $user->id : 0;
        $this->_controller = $this->router->fetch_class();
        $this->_method = $this->router->fetch_method();
        // $this->output->enable_profiler(TRUE);
    }

    public function canAdd($user_id = FALSE) {
        $user_id = $user_id ? $user_id : $this->user_id;
    }

    public function run($hook) {
        $hook = '_hook' . ucfirst($hook);
        $this->runner($hook);
    }



    public function runner($hook) {
        $this->db->select('modules.name');
        $this->db->from('controllers');
        $this->db->join('controller_module', 'controllers.id_controller = controller_module.controller');
        $this->db->join('modules', 'controller_module.module = modules.id');
        $this->db->where('controllers.name', $this->_controller);
        $this->db->where('controllers.hook', $hook);
        $this->db->order_by("controller_module.position", "asc"); 
        $result = $this->db->get();
        
        foreach ($result->result() as $module) {
            if (!isset($this->_moduleInstance[$module->name])) {
                if ($this->includeModule($module->name)) {
                    $class = 'Module_' . $module->name;
                    $this->_moduleInstance[$module->name] = new $class;
                } else {
                    continue;
                }
            }

            if (method_exists($this->_moduleInstance[$module->name], $hook)) {
                $this->_moduleInstance[$module->name]->$hook();
            }
        }
    }

    public function includeModule($module_name) {
        $path = PATH_APP . 'modules' . DS . strtolower($module_name) . DS . strtolower($module_name) . '.php';
        if (file_exists($path)) {
            include_once $path;
            $class = 'Module_' . $module_name;
            if (!class_exists($class)) {
                return false;
            }
            return true;
        }
        return false;
    }
}