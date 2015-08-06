<div class="box-body no-margin" id="atn-results">
    <form action="#" method="post" id="atn-form">
        <ul class="products-list product-list-in-box margin">
            <li class="item" id="atn-message">
                <?php if (isset($atn['var']['message'])): ?>
                    <div class="alert alert-<?php echo $atn['var']['message_type'] ?>"><?php echo $atn['var']['message'] ?></div>
                <?php endif ?>
            </li>
            <li class="item">
                <div class="btn-group pull-right">
                    <button class="btn btn-primary atn-save">Save</button>
                    <button class="btn atn-cancel">Cancel</button>
                </div>
            </li>
            <li class="item">
                <label for="to">To: <span class="text-danger">*</span></label>
                <?php echo form_input(array('name' => 'to', 'value' => $this->input->post('to'), 'class' => 'form-control', 'required' => 'required')) ?>
            </li>
            <li class="item">
                <label>This is to certify that I have seen and examined {last_name}, {first_name} {middle_name} on</label>
                <?php echo form_input(array('name' => 'date_examined', 'value' => ($this->input->post('date_examined') ? $this->input->post('date_examined') : date("Y-m-d")), 'class' => 'form-control skubbs_datepicker', 'data-inputmask' => "'alias': 'dd/mm/yyyy'", 'data-mask' => '')) ?>
            </li>
            <li class="item">
                <label for="diagnosis">Diagnosis: <span class="text-danger">*</span></label>
                <?php echo form_input(array('name' => 'diagnosis', 'value' => $this->input->post('diagnosis'), 'class' => 'form-control', 'required' => 'required')) ?>
            </li>
            <li class="item">
                <label for="rest_day_no"># of Rest day:</label>
                <?php echo form_input(array('name' => 'rest_day_no', 'value' => $this->input->post('rest_day_no'), 'class' => 'form-control', 'required' => 'required', 'type' => 'number', 'min' => 1, 'max' => 999)) ?>
            </li>
            <li class="item">
                <label>Upon re-examination and follow-up, the patient is now:</label>
                <div class="radio">
                    <label>
                        <input type="radio" name="patient_now" class="patient_now" value="0">
                        In good mental and physical health and is free from any physical defects.
                    </label>
                    <label>
                        <input type="radio" name="patient_now" class="patient_now" value="1">
                        Cleared to return to work, performing his/her usual duties and hours of work
                    </label>
                    <div id="patient_now_1">
                        on: <?php echo form_input(array('name' => 'date_examined', 'value' => ($this->input->post('date_examined') ? $this->input->post('date_examined') : date("Y-m-d")), 'class' => 'form-control skubbs_datepicker', 'data-inputmask' => "'alias': 'dd/mm/yyyy'", 'data-mask' => '')) ?>
                    </div>
                    <label>
                        <input type="radio" name="patient_now" class="patient_now" value="2">
                        Cleared to return to work, but limitation or modification should be considered:
                    </label>
                    <div id="patient_now_2">
                        <?php echo form_input(array('name' => 'date_examined', 'value' => ($this->input->post('date_examined') ? $this->input->post('date_examined') : date("Y-m-d")), 'class' => 'form-control skubbs_datepicker', 'data-inputmask' => "'alias': 'dd/mm/yyyy'", 'data-mask' => '')) ?>
                        <div>
                            <label>
                                <?php echo form_checkbox('no_lifting', 'accept'); ?>
                                No Heavy Lifting
                            </label>
                        </div>
                        <div>
                            <label>
                                <?php echo form_checkbox('no_bending', 'accept'); ?>
                                No Strenuous Bending/Twisting
                            </label>
                        </div>
                        <div>
                            <label>
                                <?php echo form_checkbox('no_prolonged', 'accept'); ?>
                                No Prolonged Walking/Standing/Sitting
                            </label>
                        </div>
                        <div>
                            <label>
                                <?php echo form_checkbox('limit_equipment', 'accept'); ?>
                                Limitation in Operating Equipments
                            </label>
                        </div>
                        <div>
                            <label>
                                <?php echo form_checkbox('other', 'accept'); ?>
                                Other
                            </label>
                        </div>
                    </div>
                    <label>
                        <input type="radio" name="patient_now" class="patient_now" value="3">
                        Unable to work this time due to:
                    </label>
                    <div id="patient_now_3">
                        World!
                    </div>
                </div>
            </li>
            
            <li class="item">
                <div class="btn-group pull-right">
                    <button class="btn btn-primary atn-save">Save</button>
                    <button class="btn atn-cancel">Cancel</button>
                </div>
            </li>
        </ul>
    </form>
</div>