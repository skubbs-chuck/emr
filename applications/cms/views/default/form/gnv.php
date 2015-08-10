<form action="#" method="post" id="data_form_gnv">
    <ul class="products-list product-list-in-box margin">
        <li class="item">
            <?php if (isset($gnv['var']['message'])): ?>
                <div class="alert alert-<?php echo $gnv['var']['message_type'] ?>"><?php echo $gnv['var']['message'] ?></div>
            <?php endif ?>
        </li>
        <li class="item">
            <div class="btn-group pull-right skubbs-e">
                <a href="#" class="btn btn-info skubbs_btn-edit">Edit</a>
            </div>
            <div class="btn-group pull-right skubbs-sc" style="display:none">
                <a href="#" class="btn btn-primary skubbs_btn-save" s-method="post" s-wrap="wrap-nurse_visit-<?php echo $gnv['form_name'] ?>-<?php echo $id_form ?>" s-id-form="<?php echo $id_form ?>" s-id-patient="<?php echo $id_patient ?>" s-request="<?php echo $gnv['form_name'] ?>">Save</a>
                <a href="#" class="btn btn-default skubbs_btn-cancel">Cancel</a>
            </div>
        </li>
        <li class="item">
            <label for="id_clinic">Clinic:</label>
            <span class="skubbs_output"><?php echo $gnv['data']->clinic_name ?></span>
            <span class="skubbs_input"><?php echo $gnv['form']['id_clinic'] ?></span>
        </li>
        <li class="item">
            <label>Visit Date:</label>
            <span class="skubbs_output"><?php echo date('F j, Y', strtotime($gnv['data']->visit_date)) ?></span>
            <div class="form-group skubbs_input">
                <div class="input-group">
                    <?php echo $gnv['form']['visit_date'] ?>
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </li>
        <li class="item bootstrap-timepicker">
        <label>Start Time:</label>
            <span class="skubbs_output"><?php echo date('h:i A', strtotime($gnv['data']->start_time)) ?></span>
            <div class="form-group skubbs_input">
                <div class="input-group">
                    <?php echo $gnv['form']['start_time'] ?>
                    <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                </div>
            </div>
        </li>
        <li class="item">
            <strong>Order/Notes: </strong>
            <div class="skubbs_output"><?php echo html_escape($gnv['data']->order_note) ?></div>
            <div class="skubbs_input"><?php echo $gnv['form']['order_note'] ?></div>
        </li>
        <li class="item">
            <div class="btn-group pull-right skubbs-e">
                <a href="#" class="btn btn-info skubbs_btn-edit">Edit</a>
            </div>
            <div class="btn-group pull-right skubbs-sc" style="display:none">
                <a href="#" class="btn btn-primary skubbs_btn-save" s-method="post" s-wrap="wrap-nurse_visit-<?php echo $gnv['form_name'] ?>-<?php echo $id_form ?>" s-id-form="<?php echo $id_form ?>" s-id-patient="<?php echo $id_patient ?>" s-request="<?php echo $gnv['form_name'] ?>">Save</a>
                <a href="#" class="btn btn-default skubbs_btn-cancel">Cancel</a>
            </div>
        </li>
    </ul>
</form>