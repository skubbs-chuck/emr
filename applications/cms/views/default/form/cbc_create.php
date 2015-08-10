<?php if ($cbc['created']): ?>
    <?php if (isset($cbc['alert']['type'])): ?>
        <div class="alert alert-<?php echo $cbc['alert']['type'] ?>"><?php echo $cbc['alert']['message'] ?></div>
    <?php endif ?>
<script>
setTimeout(function() {
    $('#notes>div>ul>li.active>a.skubbs_ajax').click();
}, 3000);
</script>
<?php else: ?><form action="#" method="post" id="data_form_cbc">
    <ul class="products-list product-list-in-box margin">
        <li class="item">
            <div class="btn-group pull-right">
                <button class="btn btn-primary skubbs_ajax" s-method="post" s-wrap="diagnostic_study" s-action="create" s-request="form_cbc">Submit</button>
                <button class="btn skubbs_ajax" s-wrap="notes" s-request="diagnostic_study">Cancel</button>
            </div>
        </li>
        <li class="item">
            <label for="id_clinic">Clinic:</label>
            <?php echo $cbc['form']['id_clinic'] ?>
        </li>
        <li class="item">
            <div class="form-group">
                <label>Visit Date:</label>
                <div class="input-group">
                    <?php echo $cbc['form']['visit_date'] ?>
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </li>
        <li class="item bootstrap-timepicker">
            <div class="form-group">
                <label>Start Time:</label>
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
                    <?php echo $cbc['form']['hemoglobin'] ?>
                </div>
                <div class="input-group">
                    <div class="input-group-addon" style="min-width: 130px"><strong>Hematocrit</strong></div>
                    <?php echo $cbc['form']['hematocrit'] ?>
                </div>
                <div class="input-group">
                    <div class="input-group-addon" style="min-width: 130px"><strong>RBC Count</strong></div>
                    <?php echo $cbc['form']['rbc'] ?>
                </div>
                <div class="input-group">
                    <div class="input-group-addon" style="min-width: 130px"><strong>WBC Count</strong></div>
                    <?php echo $cbc['form']['wbc'] ?>
                </div>
                <div class="input-group">
                    <div class="input-group-addon" style="min-width: 130px"><strong>Platelet Count</strong></div>
                    <?php echo $cbc['form']['platelet'] ?>
                </div>
                <div class="input-group">
                    <div class="input-group-addon" style="min-width: 130px"><strong>MCV</strong></div>
                    <?php echo $cbc['form']['mcv'] ?>
                </div>
                <div class="input-group">
                    <div class="input-group-addon" style="min-width: 130px"><strong>MCH</strong></div>
                    <?php echo $cbc['form']['mch'] ?>
                </div>
                <div class="input-group">
                    <div class="input-group-addon" style="min-width: 130px"><strong>MCHC</strong></div>
                    <?php echo $cbc['form']['mchc'] ?>
                </div>
                <div class="input-group">
                    <div class="input-group-addon" style="min-width: 130px"><strong>RDW</strong></div>
                    <?php echo $cbc['form']['rdw'] ?>
                </div>
            </div>
        </li>
        <li class="item">
            <div class="box-body label-primary">Differential Count</div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon" style="min-width: 130px"><strong>Eosinophils</strong></div>
                    <?php echo $cbc['form']['eosinophils'] ?>
                </div>
                <div class="input-group">
                    <div class="input-group-addon" style="min-width: 130px"><strong>Basophils</strong></div>
                    <?php echo $cbc['form']['basophils'] ?>
                </div>
                <div class="input-group">
                    <div class="input-group-addon" style="min-width: 130px"><strong>Neutrophils</strong></div>
                    <?php echo $cbc['form']['neutrophils'] ?>
                </div>
                <div class="input-group">
                    <div class="input-group-addon" style="min-width: 130px"><strong>Lymphocytes</strong></div>
                    <?php echo $cbc['form']['lymphocytes'] ?>
                </div>
                <div class="input-group">
                    <div class="input-group-addon" style="min-width: 130px"><strong>Monocytes</strong></div>
                    <?php echo $cbc['form']['monocytes'] ?>
                </div>
            </div>
        </li>
        <li class="item">
            <div class="btn-group pull-right">
                <button class="btn btn-primary skubbs_ajax" s-method="post" s-wrap="diagnostic_study" s-action="create" s-request="form_cbc">Submit</button>
                <button class="btn skubbs_ajax" s-wrap="notes" s-request="diagnostic_study">Cancel</button>
            </div>
        </li>
    </ul>
</form>
<?php endif; ?>