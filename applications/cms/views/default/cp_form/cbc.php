<form action="#" method="post" id="data_form_cbc">
    <ul class="products-list product-list-in-box margin">
        <li class="item">
            <?php if (isset($cbc['var']['message'])): ?>
                <div class="alert alert-<?php echo $cbc['var']['message_type'] ?>"><?php echo $cbc['var']['message'] ?></div>
            <?php endif ?>
        </li>
        <li class="item">
            <div class="btn-group pull-right skubbs-e">
                <a href="#" class="btn btn-info skubbs_btn-edit">Edit</a>
            </div>
            <div class="btn-group pull-right skubbs-sc" style="display:none">
                <a href="#" class="btn btn-primary skubbs_btn-save" s-method="post" s-wrap="wrap-diagnostic_study-<?php echo $cbc['form_name'] ?>-<?php echo $id_form ?>" s-id-form="<?php echo $id_form ?>" s-id-patient="<?php echo $id_patient ?>" s-request="<?php echo $cbc['form_name'] ?>">Save</a>
                <a href="#" class="btn btn-default skubbs_btn-cancel">Cancel</a>
            </div>
        </li>
        <li class="item">
            <label for="id_clinic">Clinic:</label>
            <span class="skubbs_output"><?php echo $cbc['data']->clinic_name ?></span>
            <span class="skubbs_input"><?php echo $cbc['form']['id_clinic'] ?></span>
        </li>
        <li class="item">
            <label>Visit Date:</label>
            <span class="skubbs_output"><?php echo date('F j, Y', strtotime($cbc['data']->visit_date)) ?></span>
            <div class="form-group skubbs_input">
                <div class="input-group">
                    <?php echo $cbc['form']['visit_date'] ?>
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </li>
        <li class="item bootstrap-timepicker">
        <label>Start Time:</label>
            <span class="skubbs_output"><?php echo date('h:i A', strtotime($cbc['data']->start_time)) ?></span>
            <div class="form-group skubbs_input">
                <div class="input-group">
                    <?php echo $cbc['form']['start_time'] ?>
                    <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                </div>
            </div>
        </li>
        <li class="item">
            <div class="box-body label-primary">Complete Blood Count</div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon" style="min-width: 130px"><strong>Hemoglobin</strong></div>
                    <div class="skubbs_output"><input type="text" value="<?php echo $cbc['data']->hemoglobin ?>" disabled="diabled" class="form-control"></div>
                    <div class="skubbs_input"><?php echo $cbc['form']['hemoglobin'] ?></div>
                </div>
                <div class="input-group">
                    <div class="input-group-addon" style="min-width: 130px"><strong>Hematocrit</strong></div>
                    <div class="skubbs_output"><input type="text" value="<?php echo $cbc['data']->hematocrit ?>" disabled="diabled" class="form-control"></div>
                    <div class="skubbs_input"><?php echo $cbc['form']['hematocrit'] ?></div>
                </div>
                <div class="input-group">
                    <div class="input-group-addon" style="min-width: 130px"><strong>RBC Count</strong></div>
                    <div class="skubbs_output"><input type="text" value="<?php echo $cbc['data']->rbc ?>" disabled="diabled" class="form-control"></div>
                    <div class="skubbs_input"><?php echo $cbc['form']['rbc'] ?></div>
                </div>
                <div class="input-group">
                    <div class="input-group-addon" style="min-width: 130px"><strong>WBC Count</strong></div>
                    <div class="skubbs_output"><input type="text" value="<?php echo $cbc['data']->wbc ?>" disabled="diabled" class="form-control"></div>
                    <div class="skubbs_input"><?php echo $cbc['form']['wbc'] ?></div>
                </div>
                <div class="input-group">
                    <div class="input-group-addon" style="min-width: 130px"><strong>Platelet Count</strong></div>
                    <div class="skubbs_output"><input type="text" value="<?php echo $cbc['data']->platelet ?>" disabled="diabled" class="form-control"></div>
                    <div class="skubbs_input"><?php echo $cbc['form']['platelet'] ?></div>
                </div>
                <div class="input-group">
                    <div class="input-group-addon" style="min-width: 130px"><strong>MCV</strong></div>
                    <div class="skubbs_output"><input type="text" value="<?php echo $cbc['data']->mcv ?>" disabled="diabled" class="form-control"></div>
                    <div class="skubbs_input"><?php echo $cbc['form']['mcv'] ?></div>
                </div>
                <div class="input-group">
                    <div class="input-group-addon" style="min-width: 130px"><strong>MCH</strong></div>
                    <div class="skubbs_output"><input type="text" value="<?php echo $cbc['data']->mch ?>" disabled="diabled" class="form-control"></div>
                    <div class="skubbs_input"><?php echo $cbc['form']['mch'] ?></div>
                </div>
                <div class="input-group">
                    <div class="input-group-addon" style="min-width: 130px"><strong>MCHC</strong></div>
                    <div class="skubbs_output"><input type="text" value="<?php echo $cbc['data']->mchc ?>" disabled="diabled" class="form-control"></div>
                    <div class="skubbs_input"><?php echo $cbc['form']['mchc'] ?></div>
                </div>
                <div class="input-group">
                    <div class="input-group-addon" style="min-width: 130px"><strong>RDW</strong></div>
                    <div class="skubbs_output"><input type="text" value="<?php echo $cbc['data']->rdw ?>" disabled="diabled" class="form-control"></div>
                    <div class="skubbs_input"><?php echo $cbc['form']['rdw'] ?></div>
                </div>
            </div>
        </li>
        <li class="item">
            <div class="box-body label-primary">Differential Count</div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon" style="min-width: 130px"><strong>Eosinophils</strong></div>
                    <div class="skubbs_output"><input type="text" value="<?php echo $cbc['data']->eosinophils ?>" disabled="diabled" class="form-control"></div>
                    <div class="skubbs_input"><?php echo $cbc['form']['eosinophils'] ?></div>
                </div>
                <div class="input-group">
                    <div class="input-group-addon" style="min-width: 130px"><strong>Basophils</strong></div>
                    <div class="skubbs_output"><input type="text" value="<?php echo $cbc['data']->basophils ?>" disabled="diabled" class="form-control"></div>
                    <div class="skubbs_input"><?php echo $cbc['form']['basophils'] ?></div>
                </div>
                <div class="input-group">
                    <div class="input-group-addon" style="min-width: 130px"><strong>Neutrophils</strong></div>
                    <div class="skubbs_output"><input type="text" value="<?php echo $cbc['data']->neutrophils ?>" disabled="diabled" class="form-control"></div>
                    <div class="skubbs_input"><?php echo $cbc['form']['neutrophils'] ?></div>
                </div>
                <div class="input-group">
                    <div class="input-group-addon" style="min-width: 130px"><strong>Lymphocytes</strong></div>
                    <div class="skubbs_output"><input type="text" value="<?php echo $cbc['data']->lymphocytes ?>" disabled="diabled" class="form-control"></div>
                    <div class="skubbs_input"><?php echo $cbc['form']['lymphocytes'] ?></div>
                </div>
                <div class="input-group">
                    <div class="input-group-addon" style="min-width: 130px"><strong>Monocytes</strong></div>
                    <div class="skubbs_output"><input type="text" value="<?php echo $cbc['data']->monocytes ?>" disabled="diabled" class="form-control"></div>
                    <div class="skubbs_input"><?php echo $cbc['form']['monocytes'] ?></div>
                </div>
            </div>
        </li>
        <li class="item">
            <div class="btn-group pull-right skubbs-e">
                <a href="#" class="btn btn-info skubbs_btn-edit">Edit</a>
            </div>
            <div class="btn-group pull-right skubbs-sc" style="display:none">
                <a href="#" class="btn btn-primary skubbs_btn-save" s-method="post" s-wrap="wrap-diagnostic_study-<?php echo $cbc['form_name'] ?>-<?php echo $id_form ?>" s-id-form="<?php echo $id_form ?>" s-id-patient="<?php echo $id_patient ?>" s-request="<?php echo $cbc['form_name'] ?>">Save</a>
                <a href="#" class="btn btn-default skubbs_btn-cancel">Cancel</a>
            </div>
        </li>
    </ul>
</form>