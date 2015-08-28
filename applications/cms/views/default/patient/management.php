<?php
// echo '<pre>' . print_r(get_defined_vars()) . '</pre>';
// exit;
?><?php include_once $inc_header; ?>
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
                            <!-- <th>Last Visit</th> -->
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($patient_list) && $patient_list): ?>
                            <?php foreach ($patient_list as $patient): ?>
                            <tr>
                                <td>
                                    <a href="<?php echo base_url() . 'patient/profile/' . $patient->id_patient ?>"><?php echo $patient->last_name . ', ' . $patient->first_name . ' ' . $patient->middle_name ?></a>
                                    <div class="pull-right">
                                        <a href="#" class="modal_set_appointment" data-id="<?php echo $patient->id_patient ?>" data-patient="<?php echo $patient->last_name . ', ' . $patient->first_name . ' ' . $patient->middle_name ?>"><small>Set Appointment</small></a>
                                    </div>
                                </td>
                                <!-- <td>UNDER DEV</td> -->
                                <!-- <td>Actions Here</td> -->
                            </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td class="text-center">No records found.</td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Patient Name</th>
                            <!-- <th>Last Visit</th> -->
                            <!-- <th>Action</th> -->
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

<div class="modal fade modal-info" id="modal_set_appointment">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="#" id="set_appointment">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Set Appointment to <span class="patient-name"></span></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_patient">
                <label>Type:</label>
                <select name="appointment_type" class="form-control"><option value="Consultation">Consultation</option></select>
                <label>Clinic:</label>
                <select name="id_clinic" class="form-control" id="id_clinics">
                    <?php foreach ($db_clinics as $clinic): ?>
                        <option value="<?php echo $clinic->id_clinic ?>"><?php echo $clinic->name ?></option>
                    <?php endforeach ?>
                </select>
                <label>Doctor:</label>
                <select name="id_user" class="form-control" id="opt_doctors"></select>
                <label>Date:</label>
                    <div class="form-group skubbs_input" style="display: block;">
                        <div class="input-group">
                            <input type="text" name="appointment_date" value="<?php echo date('Y-m-d') ?>" class="form-control skubbs_datepicker" data-inputmask="'alias': 'dd/mm/yyyy'">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                <div class="bootstrap-timepicker">
                    <label>Time:</label>
                    <div class="form-group skubbs_input" style="display: block;">
                        <div class="input-group">
                            <input type="text" name="appointment_time" value="<?php echo date('h:i A') ?>" class="form-control skubbs_timepicker skubbs_on_modal">
                            <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                        </div>
                    </div>
                </div>
                <label>Reason for Visit:</label> 
                <textarea name="reason" rows="3" class="form-control"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    var db_clinics = <?php echo json_encode($db_clinics) ?>;
    function ajaxGetDoctorsByClinicId(cl_id) {
        $('#opt_doctors').prop('disabled', 'disabled');
        $.ajax({
            url: base_url + 'ajax/dbci/' + cl_id, 
            dataType: 'json',
            success: function(res) {
                $('#opt_doctors').html('');
                if (res.length <= 0) {
                    $('#opt_doctors').append('<option value="0">No Doctors Available for specified clinic</option>');
                } else {
                    $.each(res, function(i,doc) {
                        $('#opt_doctors').append('<option value="' + doc.id_user + '">' + doc.last_name + ', ' + doc.first_name + ' ' + doc.middle_name + '</option>');
                    });
                };

                $('#opt_doctors').prop('disabled', false);
            }
        });
        return false;
    }

    $(document).on('click', '.modal_set_appointment', function() {
        var name_patient = $(this).data('patient');
        var id_patient = $(this).data('id');
        $('#set_appointment input[name="id_patient"]').val(id_patient);
        $('#modal_set_appointment').find('.modal-header>h4>span.patient-name').html('<i>' + name_patient + '</i>');
        
        if ($('#opt_doctors>option').length <= 0) {
            ajaxGetDoctorsByClinicId(db_clinics[0].id_clinic);
        };

        $('#modal_set_appointment').modal();
    });

    $(document).on('change', '#id_clinics', function() {
        ajaxGetDoctorsByClinicId($(this).val());
    });

    $(document).on('submit', 'form#set_appointment', function() {
        var data = $(this).serialize();

        $.ajax({
            url: base_url + 'ajax/add_appointment',
            data: data, 
            dataType: 'json',
            method: 'post', 
            success: function(r) {
                // console.log(r.result);
                if (r.status.code == 200) {
                    alert(r.status.message);
                    $('#modal_set_appointment').modal('toggle');
                } else {
                    alert(r.status.message);
                };
            }
        });

        // console.log(data);
        return false;
    });
</script>
<?php include_once $inc_footer; ?>