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
            <strong>soap_img: </strong>
            <div class="skubbs_output"><?php echo html_escape($tyl['data']->soap_img) ?></div>
            <div class="skubbs_input"><?php echo $tyl['form']['soap_img'] ?></div>
        </li>
        <li class="item">
            <strong>Subjective: </strong>
            <div class="skubbs_output"><?php echo html_escape($tyl['data']->subjective) ?></div>
            <div class="skubbs_input"><?php echo $tyl['form']['subjective'] ?></div>
        </li>
        <li class="item">
            <strong>Plan: </strong>
            <div class="skubbs_output"><?php echo html_escape($tyl['data']->plan) ?></div>
            <div class="skubbs_input"><?php echo $tyl['form']['plan'] ?></div>
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