<?php if ($tyl['created']): ?>
    <?php if (isset($tyl['alert']['type'])): ?>
        <div class="alert alert-<?php echo $tyl['alert']['type'] ?>"><?php echo $tyl['alert']['message'] ?></div>
    <?php endif ?>
<script>
setTimeout(function() {
    $('#notes>div>ul>li.active>a.skubbs_ajax').click();
}, 3000);
</script>
<?php else: ?><form action="#" method="post" id="data_form_tyl">
    <ul class="products-list product-list-in-box margin">
        <li class="item">
            <div class="btn-group pull-right">
                <button class="btn btn-primary skubbs_ajax" s-method="post" s-wrap="other" s-action="create" s-request="form_tyl">Submit</button>
                <button class="btn skubbs_ajax" s-wrap="notes" s-request="other">Cancel</button>
            </div>
        </li>
        <li class="item">
            <div class="form-group">
                <label>Visit Date:</label>
                <div class="input-group">
                    <?php echo $tyl['form']['visit_date'] ?>
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </li>
        <li class="item bootstrap-timepicker">
            <div class="form-group">
                <label>Start Time:</label>
                <div class="input-group">
                    <?php echo $tyl['form']['start_time'] ?>
                    <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                </div>
            </div>
        </li>
        <li class="item">
            <strong>To: </strong>
            <div><?php echo $tyl['form']['to'] ?></div>
        </li>
        <li class="item">
            <strong>Specialty: </strong>
            <div><?php echo $tyl['form']['specialty'] ?></div>
        </li>
        <li class="item">
            <strong>Clinic Name: </strong>
            <div><?php echo $tyl['form']['clinic_name'] ?></div>
        </li>
        <li class="item">
            <strong>Clinic Address: </strong>
            <div><?php echo $tyl['form']['clinic_address'] ?></div>
        </li>
        <li class="item">
            <strong>Clinic Contact No.: </strong>
            <div><?php echo $tyl['form']['clinic_contact'] ?></div>
        </li>
        <li class="item">
            <strong>Diagnosis: </strong>
            <div><?php echo $tyl['form']['diagnosis'] ?></div>
        </li>
        <li class="item">
            <strong>Recommendation: </strong>
            <div><?php echo $tyl['form']['recommendation'] ?></div>
        </li>
        <li class="item">
            <div class="btn-group pull-right">
                <button class="btn btn-primary skubbs_ajax" s-method="post" s-wrap="other" s-action="create" s-request="form_tyl">Submit</button>
                <button class="btn skubbs_ajax" s-wrap="notes" s-request="other">Cancel</button>
            </div>
        </li>
    </ul>
</form>
<?php endif; ?>