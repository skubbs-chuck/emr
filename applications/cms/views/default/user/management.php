<?php include_once $inc_header; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>User Management</h1> 
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
            <?php echo $this->session->flashdata('alert_message') ?>
            
            </div>
        </div>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">User Management <small><a href="<?php echo base_url() . 'user/add' ?>">Add New User</a></small></h3>
                <div class="box-tools">
                    <?php echo $user_list_links ?>
                </div>
            </div>
            <div class="box-body no-padding">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php if ($user_list): ?>
                            <?php foreach ($user_list as $l_user): ?>
                                <tr>
                                    <td><?php echo $l_user->username ?></td>
                                    <td><?php echo $l_user->first_name . ' ' . $l_user->last_name ?>
                                        
                                    </td>
                                    <td>
                                        <?php if ($l_user->enabled): ?>
                                            Active
                                        <?php else: ?>
                                            Disabled
                                        <?php endif ?>
                                        <div class="btn-group pull-right">
                                            
                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="<?php echo base_url() . 'user/profile/' . $l_user->username ?>">View Profile</a></li>
                                                <li><a href="<?php echo base_url() . 'user/edit/' . $l_user->username ?>">Edit User</a></li>
                                                <?php if ($l_user->enabled): ?>
                                                    <li><a href="<?php echo base_url() . 'user/disable/' . $l_user->username ?>">Disable User</a></li>
                                                <?php else: ?>
                                                    <li><a href="<?php echo base_url() . 'user/enable/' . $l_user->username ?>">Enable User</a></li>
                                                <?php endif ?>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center">No records found.</td>
                            </tr>
                        <?php endif ?>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                  </table>
            </div>
            <div class="box-footer with-border">
                <!-- <h3 class="box-title">User Management</h3> -->
                <div class="box-tools">
                    <?php echo $user_list_links ?>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include_once $inc_footer; ?>