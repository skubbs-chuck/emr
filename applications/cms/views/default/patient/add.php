<?php include_once $inc_header; ?>
<div class="content-wrapper" id="patient-result">
    <section class="content-header">
        <h1>Add New Patient</h1> 
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
            <?php echo $this->session->flashdata('alert_message') ?>
            </div>
        </div>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Add New Patient</h3>
                <span class="pull-right">
                    <a href="<?php echo base_url() . 'patient/management' ?>" class="btn btn-info btn-xs">BACK</a>
                </span>
            </div>
            <div class="box-body no-padding">
                <?php echo form_open(); ?>
                <table class="table table-hover table-striped">
                    <tbody>
                        <tr>
                            <td>
                                <?php echo validation_errors(); ?>
                                <?php echo isset($insert_error) ? $insert_error : '' ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'first_name', 'value' => $this->input->post('first_name'), 'placeholder' => 'First Name', 'class' => 'form-control', 'required' => 'required')) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'middle_name', 'value' => $this->input->post('middle_name'), 'placeholder' => 'Middle Name', 'class' => 'form-control', 'required' => 'required')) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'last_name', 'value' => $this->input->post('last_name'), 'placeholder' => 'Last Name', 'class' => 'form-control', 'required' => 'required')) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'alias', 'value' => $this->input->post('alias'), 'placeholder' => 'Alias', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td>
                            <div class="form-group">
                                <label>Birth Date:</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <?php echo form_input(array('name' => 'birth_date', 'value' => ($this->input->post('birth_date') ? $this->input->post('birth_date') : date("Y-m-d")), 'class' => 'form-control skubbs_datepicker', 'data-inputmask' => "'alias': 'dd/mm/yyyy'", 'data-mask' => '')) ?>
                                </div>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'birth_place', 'value' => $this->input->post('birth_place'), 'placeholder' => 'Place of Birth', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <?php
                                    echo form_label('Gender', 'gender');
                                    echo form_dropdown('gender', array('Male' => 'Male', 'Female' => 'Female'), ($this->input->post('gender') ? $this->input->post('gender') : 'Male'), 'id="gender" class="form-control"'); 
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <?php
                                    echo form_label('Civil Status', 'civil_status');
                                    echo form_dropdown('civil_status', array('Single' => 'Single', 'Married' => 'Married'), ($this->input->post('civil_status') ? $this->input->post('civil_status') : 'Single'), 'id="civil_status" class="form-control"'); 
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <?php
                                    echo form_label('Nationality', 'nationality');
                                    echo form_dropdown('nationality', config_item('nationalities'), ($this->input->post('nationality') ? $this->input->post('nationality') : 61), 'id="nationality" class="form-control"'); 
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'occupation', 'value' => $this->input->post('occupation'), 'placeholder' => 'Occupation', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'religion', 'value' => $this->input->post('religion'), 'placeholder' => 'Religion', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'address', 'value' => $this->input->post('address'), 'placeholder' => 'Residental Address', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'city', 'value' => $this->input->post('city'), 'placeholder' => 'City', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'zip_code', 'value' => $this->input->post('zip_code'), 'placeholder' => 'Zip Code', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <?php
                                    echo form_label('Country', 'country');
                                    echo form_dropdown('country', config_item('countries'), ($this->input->post('country') ? $this->input->post('country') : 'PH'), 'id="country" class="form-control"'); 
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'address2', 'value' => $this->input->post('address2'), 'placeholder' => 'Provincial Address', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'city2', 'value' => $this->input->post('city2'), 'placeholder' => 'City', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'zip_code2', 'value' => $this->input->post('zip_code2'), 'placeholder' => 'Zip Code', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <?php
                                    echo form_label('Country', 'country2');
                                    echo form_dropdown('country2', config_item('countries'), ($this->input->post('country2') ? $this->input->post('country2') : 'PH'), 'id="country" class="form-control"'); 
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('type' => 'email', 'name' => 'email', 'value' => $this->input->post('email'), 'placeholder' => 'Email Address', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo form_label('Contacts', 'contacts'); ?>
                                <div id="contacts"></div>
                                <a class="btn btn-info btn-xs skubbs_btn-add" s-id="contacts">Add Contact</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo form_label('Identifications', 'identifications'); ?>
                                <div id="identifications"></div>
                                <a class="btn btn-info btn-xs skubbs_btn-add" s-id="identifications">Add Identification</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <?php
                                    echo form_label('Account Type', 'account_type');
                                    echo form_dropdown('account_type', array('Individual' => 'Individual', 'HMO/Company' => 'HMO/Company'), ($this->input->post('account_type') ? $this->input->post('account_type') : 'Individual'), 'id="account_type" class="form-control"'); 
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <?php
                                    echo form_label('Client Source', 'client_source');
                                    echo form_dropdown('client_source', array('Campaign' => 'Campaign', 'Employee' => 'Employee', 'Existing Customer etc.' => 'Existing Customer etc.', 'Flier/Brochure' => 'Flier/Brochure', 'Friend' => 'Friend', 'Magazine' => 'Magazine', 'Newspaper' => 'Newspaper', 'Online' => 'Online', 'Others' => 'Others', 'Walkins' => 'Walkins', 'Website' => 'Website'), ($this->input->post('client_source') ? $this->input->post('client_source') : 'Walkins'), 'id="client_source" class="form-control"');
                                    ?>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-block">SUBMIT</button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </section>
</div>
<?php include_once $inc_footer; ?>