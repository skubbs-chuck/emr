<?php include_once $inc_header; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Add New Clinic</h1> 
    </section>
    <section class="content">
    	<div class="row">
    		<div class="col-md-12">
    		<?php echo $this->session->flashdata('alert_message') ?>
    		</div>
    	</div>
    	<div class="box">
    		<div class="box-header">
    			<h3 class="box-title">Add New Clinic</h3>
                <span class="pull-right">
                	<a href="<?php echo base_url() . 'clinic/management' ?>" class="btn btn-info btn-xs">BACK</a>
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
                            <td><?php echo form_input(array('name' => 'name', 'value' => $this->input->post('name'), 'placeholder' => 'Clinic Name', 'class' => 'form-control', 'required' => 'required')) ?></td>
                        </tr>
                        <tr>
                            <td>
								<div class="form-group">
									<?php
									echo form_label('Hour Start', 'hour_start');
									echo form_dropdown('hour_start', $hours, ($this->input->post('hour_start') ? $this->input->post('hour_start') : 'a9'), 'id="hour_start" class="form-control"'); 
									?>
								</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
								<div class="form-group">
									<?php
									echo form_label('Hour End', 'hour_end');
									echo form_dropdown('hour_end', $hours, ($this->input->post('hour_end') ? $this->input->post('hour_end') : 'p6'), 'id="hour_end" class="form-control"'); 
									?>
								</div>
                            </td>
                        </tr>
	                    <tr>
                            <td><?php echo form_input(array('name' => 'street', 'value' => $this->input->post('street'), 'placeholder' => 'Street', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'city', 'value' => $this->input->post('city'), 'placeholder' => 'City', 'class' => 'form-control')) ?></td>	
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'province', 'value' => $this->input->post('province'), 'placeholder' => 'Province', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td>
                            	<div class="form-group">
									<?php
									echo form_label('Country', 'country');
									echo form_dropdown('country', $countries, ($this->input->post('country') ? $this->input->post('country') : 'PH'), 'id="country" class="form-control"'); 
									?>
								</div>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'zip_code', 'value' => $this->input->post('zip_code'), 'placeholder' => 'Zip Code', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'contact_number', 'value' => $this->input->post('contact_number'), 'placeholder' => 'Contact Number', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'website', 'value' => $this->input->post('website'), 'placeholder' => 'Website', 'class' => 'form-control')) ?></td>
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