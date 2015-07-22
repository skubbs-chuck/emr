<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends Base_Controller {
    public function testdude() {
        $server_url =   "http://joyonto.net/envato_validation/index.php?xmlrpc_server";
        $this->load->library('xmlrpc');
        $this->xmlrpc->server($server_url, 80);
        $this->xmlrpc->method('Greetings');
        $buyer = 'zave82';
        $purchase_code = '1ca16867-cbf1-4bdf-98cd-34773420e960';
        $request        =   array(
            array(  
                array('buyer'   =>  $buyer , 
                    'purchase_code'    =>  $purchase_code , 
                    'server_name'  =>  'preskubbs.com'), 'struct'
            )
        );

        $this->xmlrpc->request($request);
        $this->xmlrpc->send_request();
        var_dump($this->xmlrpc->display_response());
    }

    public function index() {
    	$this->db->select('forms.table_name, forms.name, form_categories.name AS category, form_types.name AS type');
    	$this->db->from('forms');
    	$this->db->join('form_categories', 'forms.id_form_category = form_categories.id_form_category', 'left');
    	$this->db->join('form_types', 'forms.id_form_type = form_types.id_form_type', 'left');
    	$query = $this->db->get();
    	$result = $query->result();

    	// $this->db->query('ALTER TABLE `form_cbcf` ADD `creation_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP');

// exit();
    	// $this->load->dbforge();
    	foreach ($result as $form) {
   			// $myfile = fopen(VIEWPATH . 'default' . DS . str_replace('_', DS, $form->table_name) . '.php', "w+") or die("Unable to open file!");
			// fwrite($myfile, $form->name);
			// fclose($myfile);
    		// echo "// Category: " . ($form->category ? $form->category : 'None') . "\r\n";
    		// echo "// Type: $form->type\r\n";
    		// echo "// Name: $form->name\r\n";
    		// echo 'public function ' . str_replace('form_', '', $form->table_name) . "() {\r\n\t\$this->display();\r\n}\r\n\r\n";
			
			// $fields = array(
			// 	'id_' . $form->table_name => array(
			// 		'type' => 'INT',
			// 		'constraint' => 11, 
			// 		'unsigned' => TRUE,
			// 		'auto_increment' => TRUE
			// 	),
			// );

			// $this->dbforge->add_field($fields);
			// $this->dbforge->add_key('id_' . $form->table_name, TRUE);
   			// $this->dbforge->create_table($form->table_name, TRUE);
//    			id_patient	int(11)			No	None		Change Change	Drop Drop	
// Primary Primary
// Unique Unique
// Index Index
// More
// 	3	id_clinic	int(11)			No	None		Change Change	Drop Drop	
// Primary Primary
// Unique Unique
// Index Index
// More
// 	4	id_user
    		// $this->db->query('ALTER TABLE `' . $form->table_name . '` ADD `id_patient` INT(11) NOT NULL AFTER `id_' . $form->table_name . '`, ADD `id_clinic` INT(11) NOT NULL AFTER `id_patient`, ADD `is_user` INT(11) AFTER `id_clinic`');
    		// $this->db->query('ALTER TABLE `' . $form->table_name . '` ADD `id_user` INT(11) NOT NULL AFTER `id_clinic`');
    		// $this->db->query('ALTER TABLE `' . $form->table_name . '` DROP `is_user`');
    	}

    	exit();
    	$res = array();
    	$this->load->model('model_form_template', 'mft');

    	$res = $this->mft->getAllForms();
    	echo '<pre>';
    	print_r($res);
    	echo '</pre>';
    }
}
