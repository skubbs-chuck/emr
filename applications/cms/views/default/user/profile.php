<?php include_once $inc_header; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1><?php echo $uinfo->first_name . ' ' . $uinfo->last_name ?>'s Profile</h1> 
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Personal Information</h3>
                <span class="pull-right">
                	<a href="<?php echo base_url() . 'user/edit/' . $username_or_id ?>" class="btn btn-primary btn-xs">EDIT</a>
                	<a href="<?php echo base_url() . 'user/management/' ?>" class="btn btn-info btn-xs">BACK</a>
                </span>
            </div>
            <div class="box-body no-padding">
                <table class="table table-hover table-striped">
                    <tbody>
                        <tr>
                            <td>Name:</td>
                            <td><?php echo $uinfo->first_name . ' ' . $uinfo->last_name ?></td>
                        </tr>
                        <tr>
                            <td>Username:</td>
                            <td><?php echo $uinfo->username ?></td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td><?php echo $uinfo->email ?></td>
                        </tr>
                        <tr>
                            <td>Contact Number:</td>
                            <td><?php echo $uinfo->contact_number ?></td>
                        </tr>
                        <tr>
                            <td>Address:</td>
                            <td><?php echo $uinfo->address ?></td>
                        </tr>
                        <tr>
                            <td>Doctor Specialization:</td>
                            <td><?php echo $uinfo->specialty ?></td>
                        </tr>
                        <tr>
                            <td>License No.:</td>
                            <td>N/A</td>
                        </tr>
                        <tr>
                            <td>PTR No.:</td>
                            <td>N/A</td>
                        </tr>
                        <tr>
                            <td>S2 License No.:</td>
                            <td>N/A</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<?php include_once $inc_footer; ?>
