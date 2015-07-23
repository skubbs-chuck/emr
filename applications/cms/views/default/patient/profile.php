<?php include_once $inc_header; ?>
<div id="id_patient" style="display:none"><?php echo $patient->id_patient ?></div>
<div class="content-wrapper">
    <section class="content">
        <div class="well">
            <div class="row">
                <div class="patient-image col-md-12">
                    <div class="pull-right text-right"><a href="<?php echo base_url() ?>patient/edit/<?php echo $patient->id_patient ?>">EDIT</a></div>
                    <img src="https://cms.medcurial.com/images/profile_default.png" style="display:inline-block; vertical-align:top;margin-right:5px">
                    <div style="display:inline-block">
                        <strong><?php echo $patient->last_name . ', ' . $patient->first_name . ' ' . $patient->middle_name ?></strong><br>
                        <?php echo $patient->gender ?> / <?php echo $patient->birth_date ?><br>
                        Member Since: <?php echo $member_since ?><br>
                    </div>
                </div>
            </div>
        </div>
        <div class="box box-primary no-margin">
            <div class="box-header"><h3 class="box-title">Patient Informations</h3></div>
            <div class="box-body no-padding no-margin">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#" id="patient-ajax-medical-history" data-toggle="tab">Medical History</a></li>
                    <li><a href="#" id="patient-ajax-notes" data-toggle="tab">Notes</a></li>
                    <li><a href="#" id="patient-ajax-medications" data-toggle="tab">Medications</a></li>
                </ul>
            </div>
        </div>
        <div class="box no-border no-margin">
            <div id="patient_informations"></div>
            <div class="overlay" id="patient_loading"><i class="fa fa-refresh fa-spin"></i></div>
        </div>
    </section>
</div>
<?php include_once $inc_footer; ?>