<?php
function sortByPosition($a, $b) {
    return $a['position'] - $b['position'];
}

class Module extends Base_Model {
    public $data = array(
        'jsTop' => array(), 
        'jsBottom' => array(), 
        'css' => array(), 
        'js' => array()
    );
    private $_modules = array();
    private $_modulePrefix = 'Module_';
    private $_hookPrefix = '_hook';
    private $_hookVarPrefix = 'HOOK_';
    private $_installed = false;
    private $_id = false;
    protected $_path;
    protected $_localPath;
    protected $name;
    protected $displayName;
    protected $version = '1.0';
    protected $author = 'Chuck Osme&#241;a Lagumbay';

    public function __construct() {
        parent::__construct();
        $this->_path = isset($this->name) ? base_url() . DIR_APPS . '/' . DIR_APP . '/modules/' . $this->name . '/' : false;
        $this->_localPath = isset($this->name) ? $this->name . DS : false;
    }

    public function init() {
        $dirs = scandir(MODULES_DIR);
        foreach ($dirs as $module_name) 
            if ($module_name != '.' && $module_name != '..') 
                $this->includeByName($module_name);

        $this->db->select('*');
        $this->db->from('modules');
        $db_modules = $this->db->get();

        if ($db_modules->num_rows()) 
            foreach ($db_modules->result() as $db_module) 
                if (isset($this->_modules[$db_module->name])) {
                    $this->_modules[$db_module->name]->_installed = true;
                    $this->_modules[$db_module->name]->_id = $db_module->id_module;
                }
           
        return $this;
    }

    public function install() {
        // if ID exists, it means the module already installed so we're done here.
        if ($this->_id) // OR $this->_installed
            return true;

        // if module name doesnt exist, why do we insert this? throw an error
        if (!$this->name) 
            return false;
        
        // inserting module to database table 'modules' then set ID
        if ($this->db->insert('modules', array('name' => $this->name))) {
            $this->_id = $this->db->insert_id();
            return true;
        }

        // error inserting? throw an error (please use log here when updating)
        return false;
    }

    public function uninstall() {
        // if ID doesnt exist it means it's not yet install so why uninstalling this module? throw an error
        if (!$this->_id) 
            return false;

        // delete this module to database 'modules'
        if ($this->db->delete('modules', array('id_module' => $this->_id))) {
            // also delete all registered hooks in database 'hook_module' that this module inserted
            $this->db->delete('hook_module', array('id_module' => $this->_id));
            return true;
        }

        // error deleting this module to database 'modules'
        return false;
    }

    public function registerHook($hook_name) {
        // hey if module id does not exist, we cant register the hook (are you a human?)
        if (!$this->_id) 
            return false;

        // if hook name exist we dont need to add hook (just get the id)
        $this->db->select('id_hook');
        $this->db->where('name', $hook_name);
        $query = $this->db->get('hooks');

        $hook_id = false;
        if ($query->num_rows()) {
            $hook = $query->row();
            $hook_id = $hook->id_hook;
        } else {
            // hook name doesnt exist so let's insert dude! :))
            if ($this->db->insert('hooks', array('name' => $hook_name))) 
                $hook_id = $this->db->insert_id();
            else 
                return false; // error inserting new hook </3 :(
        }

        
        // add our module to the hook
        if ($this->db->insert('hook_module', array('id_hook' => $hook_id, 'id_module' => $this->_id))) 
            return true;
        
        // problem? no problem. throw an error please XD
        return false;
    }

    public function unregisterHook($hook_name) {} // to be filled later

    public function display($path, $other_data = array()) {
        $data = $this->config->item('data');
        ob_start();
        $this->load->view($path, array_replace_recursive($data, $other_data));
        $display = ob_get_contents();
        ob_end_clean();
        return $display;
    }

    public function includeByName($module_name) {
        $module_file = MODULES_DIR . $module_name . DS . $module_name . '.php';
        $class_name = 'Module_' . ucfirst($module_name);

        // if we already have an instance of this module, we're done here.
        if (isset($this->_modules[$module_name])) 
            return true;
        

        if (file_exists($module_file)) {
            // include the module and instanciate the module
            include_once $module_file;
            if (class_exists($class_name)) {
                $this->_modules[$module_name] = new $class_name;
                return true;
            }
            
            $this->log('module_error', "class 'Module_$module_name' does not exists.");
        }

        $this->log('module_error', "Module '$module_name' does not exists.");

        return false;
    }

    public function log($code, $message) {
        $this->data['log'][$code][] = $message;
    }

    public function getIdByName($module_name) {
        if ($this->_id) {
            return $this->_id;
        }

        $query = $this->db->get_where('modules', array('name' => $module_name));
        if ($query->num_rows()) {
            $module = $query->row();
            return $module->id_module;
        }

        return false;
    }

    public function hooks() {
        $data = $this->config->item('data');
        $this->db->select("modules.*, GROUP_CONCAT(hooks.name,'_',hook_module.position SEPARATOR ',') AS hooks");
        $this->db->from('modules');
        $this->db->join('hook_module', 'modules.id_module = hook_module.id_module');
        $this->db->join('hooks', 'hooks.id_hook = hook_module.id_hook');
        $this->db->group_by('hook_module.id_module');

        $query = $this->db->get();
        $modules = array();
        $unsorted_module_hooks = array();
        foreach ($query->result() as $module) {
            if ($module->hooks) {
                $hooks = explode(', ', $module->hooks);
                foreach ($hooks as $hook) {
                    $hook_position = explode('_', $hook);
                    $unsorted_module_hooks[$hook_position[0]][] = array('position' => $hook_position[1], 'module' => $module->name);
                }
            }
        }

        $sorted_module_hooks = array();
        foreach ($unsorted_module_hooks as $hook => $pos_mod) {
            usort($pos_mod, 'sortByPosition');
            $sorted_module_hooks[$hook] = $pos_mod;
        }

        $module_hooks = array();
        foreach ($sorted_module_hooks as $hook_name => $configs) {
            foreach ($configs as $config) {
                $module_hooks[$hook_name][] = $config['module'];
            }
        }

        
        $data['hooks'] = $module_hooks;
        $this->config->set_item('data', $data);
    }

    public function createHooksVar() {
        $data = $this->config->item('data');
        $data_from_base_module = array();
        $data_from_modules = array();

        if (!isset($data['hooks'])) 
            return false;

        foreach ($data['hooks'] as $hook_name => $modules) {
            $var = $this->_hookVarPrefix . strtoupper($hook_name);
            $data[$var] = '';
            $method = $this->_hookPrefix . ucfirst($hook_name);
            
            if (method_exists($this, $method)) {
                $data_from_base_module = $this->$method($modules, $var);
                continue;
            }

            foreach ($modules as $module) 
                if (method_exists($this->_modules[$module], $method)) {
                    if (!isset($data_from_modules[$var])) 
                        $data_from_modules[$var] = '';
                    
                    $data_from_modules[$var] .= $this->_modules[$module]->$method();
                }
        }

        $data = array_replace_recursive($data_from_base_module, $data_from_modules);
        unset($data['hooks'], $data['css'], $data['jsTop']);
        $this->config->set_item('data', $data);
    }

    public function _hookHeader() {
        $args = func_get_args();
        $modules = $args[0];
        $var = $args[1];
        $method = __FUNCTION__;
        $html_head = '';

        foreach ($modules as $module) 
            if (method_exists($this->_modules[$module], $method)) 
                $this->_modules[$module]->$method();

        $data = $this->config->item('data');
        $data['css'] = array_unique($data['css']);
        $data['jsTop'] = array_unique($data['jsTop']);
        $data['jsBottom'] = array_unique($data['jsBottom']);

        if (isset($data['css'])) 
            foreach ($data['css'] as $css) 
                $html_head .= '<link rel="stylesheet" type="text/css" href="' . $css . '">' . "\r\n";

        if (isset($data['jsTop'])) 
            foreach ($data['jsTop'] as $jsTop) 
                $html_head .= '<script type="text/javascript" src="' . $jsTop . '"></script>' . "\r\n";
            
        // if (isset($data['jsBottom'])) 
        //     foreach ($data['jsBottom'] as $jsBottom) 
        //         $html_head .= '<script type="javascript" src="' . $jsBottom . '"></script>' . "\r\n";

        $data[$var] = $html_head;
        return $data;
    }

    public function addJs($path, $bottom = TRUE) {
        $path = array($path);
        $data = $this->config->item('data');
        if ($bottom) 
            $data['jsBottom'] = array_merge_recursive($data['jsBottom'], $path);
        else 
            $data['jsTop'] = array_merge_recursive($data['jsTop'], $path);

        $this->config->set_item('data', $data);
        return $this;
    }

    public function addCss($path) {
        $path = array($path);
        $data = $this->config->item('data');
        $data['css'] = array_merge_recursive($data['css'], $path);
        $this->config->set_item('data', $data);
        return $this;
    }

    public function __clone() {}
}