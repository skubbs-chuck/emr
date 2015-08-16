<?php include_once $inc_header; ?>
<div class="content-wrapper">
<section id="patient" class="content">
    <!-- <a href="#" class="skubbs_btn-save" s-action="create" s-wrap="nurse_visit" s-request="form_gnv" s-method="post" s-id-patient="1" s-id-form="2" s-loading="1">test me</a> -->
    <span id="var-id_patient"><?php echo $patient->id_patient ?></span>
    <span id="var-id_form">0</span>
    <div class="well">
        <div class="row">
            <div class="patient-image col-md-12">
                <div class="pull-right text-right"><a href="<?php echo base_url() ?>patient/edit/<?php echo $patient->id_patient ?>">EDIT</a></div>
                <img src="<?php echo $tpl_url; ?>img/user2-160x160.jpg" width="78px" class="img-circle" style="border:2px solid #fff; display:inline-block; vertical-align:top;margin-right:5px">
                <div style="display:inline-block">
                    <strong><?php echo $patient->last_name . ', ' . $patient->first_name . ' ' . $patient->middle_name ?></strong><br>
                    <?php echo $patient->gender ?> / <?php echo $patient->birth_date ?><br>
                    Member Since: <?php echo $member_since ?><br>
                </div>
            </div>
        </div>
    </div>
    <div id="forms" class="box box-primary no-margin">
        <div class="box-header"><h3 class="box-title">Patient Informations</h3></div>
        <div class="box-body no-padding no-margin">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#" class="skubbs_ajax" s-wrap="forms" s-request="medical_history" data-toggle="tab">Medical History</a></li>
                <!-- <li><a href="#" class="skubbs_ajax" s-wrap="forms" s-request="notes" s-onload="notes_consultation" data-toggle="tab">Notes</a></li> -->
                <li><a href="#" class="skubbs_ajax" s-wrap="forms" s-request="notes" s-onload="notes_nurse_visit" data-toggle="tab">Notes</a></li>
                <li><a href="#" class="skubbs_ajax" s-wrap="forms" s-request="medications" data-toggle="tab">Medications</a></li>
            </ul>
        </div>
        <div class="skubbs_result"></div>
        <div class="overlay skubbs_loading"><i class="fa fa-refresh fa-spin"></i></div>
    </div>
</section>
</div>
<?php include_once $inc_footer; ?>