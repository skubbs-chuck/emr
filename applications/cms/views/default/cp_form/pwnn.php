<form action="#" method="post" id="data_form_pwnn">
    <ul class="products-list product-list-in-box margin">
        <li class="item">
            <?php if (isset($pwnn['var']['message'])): ?>
                <div class="alert alert-<?php echo $pwnn['var']['message_type'] ?>"><?php echo $pwnn['var']['message'] ?></div>
            <?php endif ?>
        </li>
        <li class="item">
            <div class="btn-group pull-right skubbs-e">
                <a href="#" class="btn btn-info skubbs_btn-edit">Edit</a>
            </div>
            <div class="btn-group pull-right skubbs-sc" style="display:none">
                <a href="#" class="btn btn-primary skubbs_btn-save" s-method="post" s-wrap="wrap-nurse_visit-<?php echo $pwnn['form_name'] ?>-<?php echo $id_form ?>" s-id-form="<?php echo $id_form ?>" s-id-patient="<?php echo $id_patient ?>" s-request="<?php echo $pwnn['form_name'] ?>">Save</a>
                <a href="#" class="btn btn-default skubbs_btn-cancel">Cancel</a>
            </div>
        </li>
        <li class="item">
            <label for="id_clinic">Clinic:</label>
            <span class="skubbs_output"><?php echo $pwnn['data']->clinic_name ?></span>
            <span class="skubbs_input"><?php echo $pwnn['form']['id_clinic'] ?></span>
        </li>
        <li class="item">
            <label>Visit Date:</label>
            <span class="skubbs_output"><?php echo date('F j, Y', strtotime($pwnn['data']->visit_date)) ?></span>
            <div class="form-group skubbs_input">
                <div class="input-group">
                    <?php echo $pwnn['form']['visit_date'] ?>
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </li>
        <li class="item bootstrap-timepicker">
        <label>Start Time:</label>
            <span class="skubbs_output"><?php echo date('h:i A', strtotime($pwnn['data']->start_time)) ?></span>
            <div class="form-group skubbs_input">
                <div class="input-group">
                    <?php echo $pwnn['form']['start_time'] ?>
                    <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                </div>
            </div>
        </li>
        <li class="item">
            <strong>Focus: </strong>
            <div class="skubbs_output"><?php echo html_escape($pwnn['data']->focus) ?></div>
            <div class="skubbs_input"><?php echo $pwnn['form']['focus'] ?></div>
        </li>
        <li class="item">
            <strong>Data: </strong>
            <div class="skubbs_output"><?php echo html_escape($pwnn['data']->data) ?></div>
            <div class="skubbs_input"><?php echo $pwnn['form']['data'] ?></div>
        </li>
        <li class="item">
            <strong>Action: </strong>
            <div class="skubbs_output"><?php echo html_escape($pwnn['data']->action) ?></div>
            <div class="skubbs_input"><?php echo $pwnn['form']['action'] ?></div>
        </li>
        <li class="item">
            <strong>Recommendation: </strong>
            <div class="skubbs_output"><?php echo html_escape($pwnn['data']->recommendation) ?></div>
            <div class="skubbs_input"><?php echo $pwnn['form']['recommendation'] ?></div>
        </li>
        <li class="item">
            <div class="btn-group pull-right skubbs-e">
                <a href="#" class="btn btn-info skubbs_btn-edit">Edit</a>
            </div>
            <div class="btn-group pull-right skubbs-sc" style="display:none">
                <a href="#" class="btn btn-primary skubbs_btn-save" s-method="post" s-wrap="wrap-nurse_visit-<?php echo $pwnn['form_name'] ?>-<?php echo $id_form ?>" s-id-form="<?php echo $id_form ?>" s-id-patient="<?php echo $id_patient ?>" s-request="<?php echo $pwnn['form_name'] ?>">Save</a>
                <a href="#" class="btn btn-default skubbs_btn-cancel">Cancel</a>
            </div>
        </li>
    </ul>
</form>