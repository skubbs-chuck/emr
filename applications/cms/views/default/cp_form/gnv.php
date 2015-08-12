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
            <strong>Nursing Assessment: </strong>
            <div class="skubbs_output"><?php echo html_escape($gnv['data']->nursing_assessment) ?></div>
            <div class="skubbs_input"><?php echo $gnv['form']['nursing_assessment'] ?></div>
        </li>
        <li class="item">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead><tr><th class="label-primary">Assessment</th></tr></thead>
                    <tbody id="assessment_ndp">
                        <?php $ndps = json_decode($gnv['data']->ndp); ?>
                        <?php foreach ($ndps as $ndp): ?>
                        <tr class="skubbs_output">
                            <td>
                                <label>Nursing Diagnosis</label>
                                <div><?php echo $ndp[0] ?></div>
                                <label>Plan</label>
                                <div><?php echo $ndp[1] ?></div>
                            </td>
                        </tr>
                        <tr class="skubbs_input" style="display: none;">
                            <td>
                                <label>Nursing Diagnosis</label>
                                <input type="text" name="ndp_diagnosis[]" class="form-control" value="<?php echo $ndp[0] ?>">
                                <label>Plan</label>
                                <div class="input-group" style="margin-bottom: 5px">
                                    <textarea name="ndp_plan[]" class="form-control" rows="3"><?php echo $ndp[1] ?></textarea><a class="input-group-addon skubbs_btn-remove btn btn-danger"><i class="fa fa-remove "></i></a></div>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                        <tr style="display: table-row;">
                            <td colspan="2"><a href="#" class="skubbs_input btn btn-info btn-xs skubbs_btn-add" s-id="ndp">Add Diagnosis</a></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </li>
        <li class="item">
            <strong>Implementation: </strong>
            <div class="skubbs_output"><?php echo html_escape($gnv['data']->implementation) ?></div>
            <div class="skubbs_input"><?php echo $gnv['form']['implementation'] ?></div>
        </li>
        <li class="item">
            <strong>Evaluation: </strong>
            <div class="skubbs_output"><?php echo html_escape($gnv['data']->evaluation) ?></div>
            <div class="skubbs_input"><?php echo $gnv['form']['evaluation'] ?></div>
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