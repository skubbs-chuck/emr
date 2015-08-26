<?php include_once $inc_header; ?>
<div class="content-wrapper" id="patient-result">
    <section class="content-header">
        <h1><?php echo ucfirst($patient->first_name) ?> <?php echo ucfirst($patient->last_name) ?>'s Profile</h1> 
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
            <?php echo $this->session->flashdata('alert_message') ?>
            </div>
        </div>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Patient Information</h3>
                <span class="pull-right">
                    <a href="<?php echo base_url() . 'patient/profile/' . $patient->id_patient ?>" class="btn btn-info btn-xs">BACK</a>
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
                            <td><?php echo form_input(array('name' => 'first_name', 'value' => $post['first_name'] ? $post['first_name'] : $patient->first_name, 'placeholder' => 'First Name', 'class' => 'form-control', 'required' => 'required')) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'middle_name', 'value' => $post['middle_name'] ? $post['middle_name'] : $patient->middle_name, 'placeholder' => 'Middle Name', 'class' => 'form-control', 'required' => 'required')) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'last_name', 'value' => $post['last_name'] ? $post['last_name'] : $patient->last_name, 'placeholder' => 'Last Name', 'class' => 'form-control', 'required' => 'required')) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'alias', 'value' => $post['alias'] ? $post['alias'] : $patient->alias, 'placeholder' => 'Alias', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td>
                            <div class="form-group">
                                <label>Birth Date:</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <?php $bdate = date('Y-m-d', strtotime($patient->birth_date)); ?>
                                    <?php echo form_input(array('name' => 'birth_date', 'value' => ($post['birth_date'] ? $post['birth_date'] : $bdate), 'class' => 'form-control skubbs_datepicker', 'data-inputmask' => "'alias': 'dd/mm/yyyy'", 'data-mask' => '')) ?>
                                </div>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'birth_place', 'value' => $post['birth_place'] ? $post['birth_place'] : $patient->birth_place, 'placeholder' => 'Place of Birth', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <?php
                                    echo form_label('Gender', 'gender');
                                    echo form_dropdown('gender', array('Male' => 'Male', 'Female' => 'Female'), ($patient->gender ? $patient->gender : 'Male'), 'id="gender" class="form-control"'); 
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <?php
                                    echo form_label('Civil Status', 'civil_status');
                                    echo form_dropdown('civil_status', array('Single' => 'Single', 'Married' => 'Married'), ($patient->civil_status ? $patient->civil_status : 'Single'), 'id="civil_status" class="form-control"'); 
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <?php
                                    echo form_label('Nationality', 'nationality');
                                    echo form_dropdown('nationality', config_item('nationalities'), ($patient->nationality ? $patient->nationality : 61), 'id="nationality" class="form-control"'); 
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'occupation', 'value' => $post['occupation'] ? $post['occupation'] : $patient->occupation, 'placeholder' => 'Occupation', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'religion', 'value' => $post['religion'] ? $post['religion'] : $patient->religion, 'placeholder' => 'Religion', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'address', 'value' => $post['address'] ? $post['address'] : $patient->address, 'placeholder' => 'Residental Address', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'city', 'value' => $post['city'] ? $post['city'] : $patient->city, 'placeholder' => 'City', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'zip_code', 'value' => $post['zip_code'] ? $post['zip_code'] : $patient->zip_code, 'placeholder' => 'Zip Code', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <?php
                                    echo form_label('Country', 'country');
                                    echo form_dropdown('country', config_item('countries'), ($patient->country ? $patient->country : 'PH'), 'id="country" class="form-control"'); 
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'address2', 'value' => $post['address2'] ? $post['address2'] : $patient->address2, 'placeholder' => 'Provincial Address', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'city2', 'value' => $post['city2'] ? $post['city2'] : $patient->city2, 'placeholder' => 'City', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'zip_code2', 'value' => $post['zip_code2'] ? $post['zip_code2'] : $patient->zip_code2, 'placeholder' => 'Zip Code', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <?php
                                    echo form_label('Country', 'country2');
                                    echo form_dropdown('country2', config_item('countries'), ($patient->country2 ? $patient->country2 : 'PH'), 'id="country" class="form-control"'); 
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('type' => 'email', 'name' => 'email', 'value' => $post['email'] ? $post['email'] : $patient->email, 'placeholder' => 'Email Address', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo form_label('Contacts', 'contacts'); ?>
                                <div id="ci_contacts">
                                    <?php foreach ($patient->contacts as $contact): ?>
                                        <div class="row skubbs_input" style="display: block;">
                                            <div class="col-lg-3">
                                                <select class="form-control" name="contacts_type[]">
                                                    <option value="Mobile" <?php echo ($contact[0] == 'Mobile') ? 'selected="selected"' : '' ?>>Mobile</option>
                                                    <option value="Home Phone" <?php echo ($contact[0] == 'Home Phone') ? 'selected="selected"' : '' ?>>Home Phone</option>
                                                    <option value="Home Fax" <?php echo ($contact[0] == 'Home Fax') ? 'selected="selected"' : '' ?>>Home Fax</option>
                                                    <option value="Work" <?php echo ($contact[0] == 'Work') ? 'selected="selected"' : '' ?>>Work</option>
                                                    <option value="Work Fax" <?php echo ($contact[0] == 'Work Fax') ? 'selected="selected"' : '' ?>>Work Fax</option>
                                                    <option value="Other" <?php echo ($contact[0] == 'Other') ? 'selected="selected"' : '' ?>>Other</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="input-group" style="margin-bottom: 5px">
                                                    <input type="text" class="form-control" name="contacts_number[]" value="<?php echo $contact[1] ?>"><a href="#" class="input-group-addon skubbs_btn-remove btn btn-danger"><i class="fa fa-remove "></i></a></div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                                <a class="btn btn-info btn-xs skubbs_btn-add" s-id="contacts">Add Contact</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo form_label('Identifications', 'identifications'); ?>
                                <div id="ci_identifications">
                                    <?php foreach ($patient->identifications as $identification): ?>
                                        <div class="row skubbs_input" style="display: block;">
                                            <div class="col-lg-3">
                                                <select class="form-control" name="identifications_type[]">
                                                    <option value="Driver License" <?php echo ($identification[0] == 'Driver License') ? 'selected="selected"' : '' ?>>Driver License</option>
                                                    <option value="SSS" <?php echo ($identification[0] == 'SSS') ? 'selected="selected"' : '' ?>>SSS</option>
                                                    <option value="Senior Citizen" <?php echo ($identification[0] == 'Senior Citizen') ? 'selected="selected"' : '' ?>>Senior Citizen</option>
                                                    <option value="Passport" <?php echo ($identification[0] == 'Passport') ? 'selected="selected"' : '' ?>>Passport</option>
                                                    <option value="Company ID" <?php echo ($identification[0] == 'Company ID') ? 'selected="selected"' : '' ?>>Company ID</option>
                                                    <option value="HealthCare Pin" <?php echo ($identification[0] == 'HealthCare Pin') ? 'selected="selected"' : '' ?>>HealthCare Pin</option>
                                                    <option value="Employee No." <?php echo ($identification[0] == 'Employee <No class=""></No>') ? 'selected="selected"' : '' ?>>Employee No.</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="input-group" style="margin-bottom: 5px">
                                                    <input type="text" class="form-control" name="identifications_number[]" value="<?php echo $identification[1] ?>"><a href="#" class="input-group-addon skubbs_btn-remove btn btn-danger"><i class="fa fa-remove "></i></a></div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                                <a class="btn btn-info btn-xs skubbs_btn-add" s-id="identifications">Add Identification</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <?php
                                    echo form_label('Account Type', 'account_type');
                                    echo form_dropdown('account_type', array('Individual' => 'Individual', 'HMO/Company' => 'HMO/Company'), ($patient->account_type ? $patient->account_type : 'Individual'), 'id="account_type" class="form-control"'); 
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