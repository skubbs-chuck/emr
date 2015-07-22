<?php include_once $inc_header; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Editting Clinic Informations</h1> 
    </section>
    <section class="content">
    	<div class="row">
    		<div class="col-md-12">
    		<?php echo $this->session->flashdata('alert_message') ?>
    		</div>
    	</div>
    	<div class="box">
    		<div class="box-header">
    			<h3 class="box-title">Editting Clinic Informations</h3>
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
                            <td><?php echo form_input(array('name' => 'name', 'value' => $clinic->name, 'placeholder' => 'Clinic Name', 'class' => 'form-control', 'required' => 'required')) ?></td>
                        </tr>
                        <tr>
                            <td>
								<div class="form-group">
									<?php
									echo form_label('Hour Start', 'hour_start');
									echo form_dropdown('hour_start', $hours, $clinic->hour_start, 'id="hour_start" class="form-control"'); 
									?>
								</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
								<div class="form-group">
									<?php
									echo form_label('Hour End', 'hour_end');
									echo form_dropdown('hour_end', $hours, $clinic->hour_end, 'id="hour_end" class="form-control"'); 
									?>
								</div>
                            </td>
                        </tr>
	                    <tr>
                            <td><?php echo form_input(array('name' => 'street', 'value' => $clinic->street, 'placeholder' => 'Street', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'city', 'value' => $clinic->city, 'placeholder' => 'City', 'class' => 'form-control')) ?></td>	
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'province', 'value' => $clinic->province, 'placeholder' => 'Province', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td>
                            	<div class="form-group">
									<?php
									echo form_label('Country', 'country');
									echo form_dropdown('country', $countries, $clinic->country, 'id="country" class="form-control"'); 
									?>
								</div>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'zip_code', 'value' => $clinic->zip_code, 'placeholder' => 'Zip Code', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'contact_number', 'value' => $clinic->contact_number, 'placeholder' => 'Contact Number', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'website', 'value' => $clinic->website, 'placeholder' => 'Website', 'class' => 'form-control')) ?></td>
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