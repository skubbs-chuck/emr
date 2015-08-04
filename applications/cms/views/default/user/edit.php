<?php include_once $inc_header; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1><?php echo $uinfo->first_name . ' ' . $uinfo->last_name ?>'s Profile</h1> 
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
            <?php echo $this->session->flashdata('alert_message') ?>
            </div>
        </div>
        <div class="box">
        <?php echo form_open(false, false, array('id_user' => $uinfo->id_user)); ?>
            <div class="box-header with-border">
                <h3 class="box-title">Personal Information</h3>
                <span class="pull-right">
                    <a href="<?php echo base_url() . 'user/profile/' . $username_or_id ?>" class="btn btn-info btn-xs">BACK</a>
                </span>
            </div>
            <div class="box-body no-padding">
                <table class="table table-hover table-striped">
                    <tbody>
                        <tr>
                            <td>First Name:</td>
                            <td><?php echo form_input(array('name' => 'first_name', 'value' => $uinfo->first_name, 'placeholder' => 'First Name', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td>Last Name:</td>
                            <td><?php echo form_input(array('name' => 'last_name', 'value' => $uinfo->last_name, 'placeholder' => 'Last Name', 'class' => 'form-control')) ?></td>    
                        </tr>
                        <tr>
                            <td>Username:</td>
                            <td><?php echo form_input(array('name' => 'username', 'value' => $uinfo->username, 'placeholder' => 'Username', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td><?php echo form_input(array('name' => 'email', 'value' => $uinfo->email, 'placeholder' => 'Email Address', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td>Contact Number:</td>
                            <td><?php echo form_input(array('name' => 'contact_number', 'value' => $uinfo->contact_number, 'placeholder' => 'Contact Number', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td>Address:</td>
                            <td><?php echo form_input(array('name' => 'address', 'value' => $uinfo->address, 'placeholder' => 'Address', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td>Doctor Specialization:</td>
                            <td><?php echo form_input(array('name' => 'specialty', 'value' => $uinfo->specialty, 'placeholder' => 'Specialization', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td>License No.:</td>
                            <td><?php echo form_input(array('name' => 'license_number', 'placeholder' => 'License No.', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td>PTR No.:</td>
                            <td><?php echo form_input(array('name' => 'ptr_number', 'placeholder' => 'PTR No.', 'class' => 'form-control')) ?></td>
                        </tr>
                        <tr>
                            <td>S2 License No.:</td>
                            <td><?php echo form_input(array('name' => 's2_license_number', 'placeholder' => 'S2 License No.e', 'class' => 'form-control')) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-block">SUBMIT</button>
                <a href="<?php echo base_url() . 'user/profile/' . $username_or_id ?>" class="btn btn-default btn-block">CANCEL</a>
            </div>
        <?php echo form_close(); ?>
        </div>
    </section>
</div>
<?php include_once $inc_footer; ?>
