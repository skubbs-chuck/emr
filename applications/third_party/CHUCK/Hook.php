<?php

class Hook extends Base_Model {
    public function exec($hook_name) {
        $this->db->select('hooks.id_hook, hooks.name AS hook_name, modules.*, hook_module.position');
        $this->db->from('hooks');
        $this->db->join('hook_module', 'hook_module.id_hook = hooks.id_hook');
        $this->db->join('modules', 'modules.id_module = hook_module.id_module');
        $this->db->where('hooks.name', $hook_name);
        $this->db->order_by('hook_module.position', 'DESC');
        $hook = $this->db->get();
        if ($hook->num_rows()) {
            foreach ($hook->result() as $module) {
                # code...
            }
        }
    }
}