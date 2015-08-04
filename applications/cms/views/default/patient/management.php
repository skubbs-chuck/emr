<?php include_once $inc_header; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Patients</h1> 
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <?php echo $this->session->flashdata('alert_message') ?>
            </div>
        </div>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Patients <small><a href="<?php echo base_url() . 'patient/add' ?>">Add New Patient</a></small></h3>
                <div class="box-tools">
                    <?php echo isset($patient_list_links) ? $patient_list_links : '' ?>
                </div>
            </div>
            <div class="box-body no-padding">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Patient</th>
                            <th>Last Visit</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($patient_list) && $patient_list): ?>
                            <?php foreach ($patient_list as $patient): ?>
                            <tr>
                                <td><a href="<?php echo base_url() . 'patient/profile/' . $patient->id_patient ?>"><?php echo $patient->last_name . ', ' . $patient->first_name . ' ' . $patient->middle_name ?></a></td>
                                <td>UNDER DEV</td>
                                <td>Actions Here</td>
                            </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">No records found.</td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Patient Name</th>
                            <th>Last Visit</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                  </table>
            </div>
            <div class="box-footer with-border">
                <!-- <h3 class="box-title">Patients</h3> -->
                <div class="box-tools">
                    <?php echo isset($patient_list_links) ? $patient_list_links : '' ?>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include_once $inc_footer; ?>