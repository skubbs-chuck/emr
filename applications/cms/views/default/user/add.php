<?php include_once $inc_header; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Add New User</h1> 
    </section>
    <section class="content">
    	<div class="row">
    		<div class="col-md-12">
    		<?php echo $this->session->flashdata('alert_message') ?>
    		</div>
    	</div>
    	<div class="box">
    		<div class="box-header">
    			<h3 class="box-title">Add New User</h3>
                <span class="pull-right">
                	<a href="<?php echo base_url() . 'user/management' ?>" class="btn btn-info btn-xs">BACK</a>
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
                            <td><?php echo form_input(array('name' => 'username', 'value' => $this->input->post('username'), 'placeholder' => 'Username', 'class' => 'form-control', 'required' => 'required')) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_password(array('name' => 'password', 'placeholder' => 'Password', 'class' => 'form-control', 'required' => 'required')) ?></td>
                        </tr>
	                    <tr>
                            <td><?php echo form_input(array('name' => 'first_name', 'value' => $this->input->post('first_name'), 'placeholder' => 'First Name', 'class' => 'form-control', 'required' => 'required')) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'last_name', 'value' => $this->input->post('last_name'), 'placeholder' => 'Last Name', 'class' => 'form-control', 'required' => 'required')) ?></td>	
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'email', 'value' => $this->input->post('email'), 'placeholder' => 'Email Address', 'class' => 'form-control', 'required' => 'required')) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'contact_number', 'value' => $this->input->post('contact_number'), 'placeholder' => 'Contact Number', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'address', 'value' => $this->input->post('address'), 'placeholder' => 'Address', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td><?php echo form_input(array('name' => 'specialty', 'value' => $this->input->post('specialty'), 'placeholder' => 'Specialization', 'class' => 'form-control', 'required' => 'required')) ?></td>
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