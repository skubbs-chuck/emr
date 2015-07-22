<?php
/**
 * Forms
 * 		id_forms, id_form_category, id_form_type, table_name, name, 
 */
class Model_Form_Template extends Base_Model {
	public $categories = array(
		'All', 
		'General medicine', 
		'Pediatrics', 
		'Dermatology', 
		'Surgery', 
		'Obstetrics and Gynecology', 
		'Ophthalmology', 
		'Otorhinolaryngology', 
		'Pulmonology', 
		'Scanned Consultation', 
	);

	public $types = array(
		'All', 
		'Consultation Notes', 
		'Letters', 
		'Results', 
		'Diagnostic Study', 
		'Procedure', 
		'Operation', 
		'Nurses Visit', 
	);

	public $forms = array(
		'Complete Blood Count', 
		'Complete Blood Count Form', 
		'Certificate of Medical Fitness', 
		'Chest X-ray', 
		'Gen SOAP Follow Up', 
		'Medical Certificate 1', 
		'Medical Certificate 2', 
		'Medical Certificate 3', 
		'Ob First Trimester Ultrasound', 
		'Patient History', 
		'Thank You Letter', 
		'Wound Assessment Form', 
		'[Derma] Consultation', 
		'[Derma] Follow-Up Consultation', 
		'[ENT] Consult 1', 
		'[ENT] Consult 2', 
		'[Gen] SOAP Follow-up', 
		'[Gen] SOAP Note', 
		'[Gen] SOAP w/ Notes Template', 
		'[LABMERGE] Urinalysis', 
		'[Ob/Gyn] Gynecology Consult', 
		'[Ob/Gyn] Prenatal Consult', 
		'[Ob/Gyn] Prenatal Flowsheet', 
		'[Ophtha] Consult 1', 
		'[Ophtha] Consult 2', 
		'[Ophtha] Consult 3', 
		'[Pedia] Consult', 
		'[Pulmo] Consult', 
		'[Surgery] Consult', 
		'[Aesthetics] Therapist\'s Notes', 
		'[Gen] Nurse Visit', 
		'[Preventive Wellness] Nurse\'s Notes', 
	);

	public function getAllForms() {
		$forms = array();
		foreach ($this->forms as $form_name => $category_type) 
			$forms[] = $form_name;
		

		return $forms;
	}

	public function getAllCategories() {
		return $this->categories;
	}

	public function getAllTypes() {
		return $this->types;
	}

	// public function getForm

	// public function getForm
}