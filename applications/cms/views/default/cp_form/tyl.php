<form action="#" method="post" id="data_form_tyl">
    <ul class="products-list product-list-in-box margin">
        <li class="item">
            <?php if (isset($tyl['var']['message'])): ?>
                <div class="alert alert-<?php echo $tyl['var']['message_type'] ?>"><?php echo $tyl['var']['message'] ?></div>
            <?php endif ?>
        </li>
        <li class="item">
            <div class="btn-group pull-right skubbs-e">
                <a href="#" class="btn btn-info skubbs_btn-edit">Edit</a>
            </div>
            <div class="btn-group pull-right skubbs-sc" style="display:none">
                <a href="#" class="btn btn-primary skubbs_btn-save" s-method="post" s-wrap="wrap-other-<?php echo $tyl['form_name'] ?>-<?php echo $id_form ?>" s-id-form="<?php echo $id_form ?>" s-id-patient="<?php echo $id_patient ?>" s-request="<?php echo $tyl['form_name'] ?>">Save</a>
                <a href="#" class="btn btn-default skubbs_btn-cancel">Cancel</a>
            </div>
        </li>
        <li class="item">
            <label>Visit Date:</label>
            <span class="skubbs_output"><?php echo date('F j, Y', strtotime($tyl['data']->visit_date)) ?></span>
            <div class="form-group skubbs_input">
                <div class="input-group">
                    <?php echo $tyl['form']['visit_date'] ?>
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </li>
        <li class="item bootstrap-timepicker">
        <label>Start Time:</label>
            <span class="skubbs_output"><?php echo date('h:i A', strtotime($tyl['data']->start_time)) ?></span>
            <div class="form-group skubbs_input">
                <div class="input-group">
                    <?php echo $tyl['form']['start_time'] ?>
                    <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                </div>
            </div>
        </li>
        <li class="item">
            <strong>To: </strong>
            <div class="skubbs_output"><?php echo html_escape($tyl['data']->to) ?></div>
            <div class="skubbs_input"><?php echo $tyl['form']['to'] ?></div>
        </li>
        <li class="item">
            <strong>Specialty: </strong>
            <div class="skubbs_output"><?php echo html_escape($tyl['data']->specialty) ?></div>
            <div class="skubbs_input"><?php echo $tyl['form']['specialty'] ?></div>
        </li>
        <li class="item">
            <strong>Clinic Name: </strong>
            <div class="skubbs_output"><?php echo html_escape($tyl['data']->clinic_name) ?></div>
            <div class="skubbs_input"><?php echo $tyl['form']['clinic_name'] ?></div>
        </li>
        <li class="item">
            <strong>Clinic Address: </strong>
            <div class="skubbs_output"><?php echo html_escape($tyl['data']->clinic_address) ?></div>
            <div class="skubbs_input"><?php echo $tyl['form']['clinic_address'] ?></div>
        </li>
        <li class="item">
            <strong>Clinic Contact No.: </strong>
            <div class="skubbs_output"><?php echo html_escape($tyl['data']->clinic_contact) ?></div>
            <div class="skubbs_input"><?php echo $tyl['form']['clinic_contact'] ?></div>
        </li>
        <li class="item">
            <strong>Diagnosis: </strong>
            <div class="skubbs_output"><?php echo html_escape($tyl['data']->diagnosis) ?></div>
            <div class="skubbs_input"><?php echo $tyl['form']['diagnosis'] ?></div>
        </li>
        <li class="item">
            <strong>Recommendation: </strong>
            <div class="skubbs_output"><?php echo html_escape($tyl['data']->recommendation) ?></div>
            <div class="skubbs_input"><?php echo $tyl['form']['recommendation'] ?></div>
        </li>
        <li class="item">
            <div class="btn-group pull-right skubbs-e">
                <a href="#" class="btn btn-info skubbs_btn-edit">Edit</a>
            </div>
            <div class="btn-group pull-right skubbs-sc" style="display:none">
                <a href="#" class="btn btn-primary skubbs_btn-save" s-method="post" s-wrap="wrap-other-<?php echo $tyl['form_name'] ?>-<?php echo $id_form ?>" s-id-form="<?php echo $id_form ?>" s-id-patient="<?php echo $id_patient ?>" s-request="<?php echo $tyl['form_name'] ?>">Save</a>
                <a href="#" class="btn btn-default skubbs_btn-cancel">Cancel</a>
            </div>
        </li>
    </ul>
</form>