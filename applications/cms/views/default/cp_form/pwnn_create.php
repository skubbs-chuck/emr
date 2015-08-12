<?php if ($pwnn['created']): ?>
    <?php if (isset($pwnn['alert']['type'])): ?>
        <div class="alert alert-<?php echo $pwnn['alert']['type'] ?>"><?php echo $pwnn['alert']['message'] ?></div>
    <?php endif ?>
<script>
setTimeout(function() {
    $('#notes>div>ul>li.active>a.skubbs_ajax').click();
}, 3000);
</script>
<?php else: ?><form action="#" method="post" id="data_form_pwnn">
    <ul class="products-list product-list-in-box margin">
        <li class="item">
            <div class="btn-group pull-right">
                <button class="btn btn-primary skubbs_ajax" s-method="post" s-wrap="nurse_visit" s-action="create" s-request="form_pwnn">Submit</button>
                <button class="btn skubbs_ajax" s-wrap="notes" s-request="nurse_visit">Cancel</button>
            </div>
        </li>
        <li class="item">
            <label for="id_clinic">Clinic:</label>
            <?php echo $pwnn['form']['id_clinic'] ?>
        </li>
        <li class="item">
            <div class="form-group">
                <label>Visit Date:</label>
                <div class="input-group">
                    <?php echo $pwnn['form']['visit_date'] ?>
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </li>
        <li class="item bootstrap-timepicker">
            <div class="form-group">
                <label>Start Time:</label>
                <div class="input-group">
                    <?php echo $pwnn['form']['start_time'] ?>
                    <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                </div>
            </div>
        </li>
         <li class="item">
            <strong>Focus: </strong>
            <div><?php echo $pwnn['form']['focus'] ?></div>
        </li>
        <li class="item">
            <strong>Data: </strong>
            <div><?php echo $pwnn['form']['data'] ?></div>
        </li>
        <li class="item">
            <strong>Action: </strong>
            <div><?php echo $pwnn['form']['action'] ?></div>
        </li>
        <li class="item">
            <strong>Recommendation: </strong>
            <div><?php echo $pwnn['form']['recommendation'] ?></div>
        </li>
        <li class="item">
            <div class="btn-group pull-right">
                <button class="btn btn-primary skubbs_ajax" s-method="post" s-wrap="nurse_visit" s-action="create" s-request="form_pwnn">Submit</button>
                <button class="btn skubbs_ajax" s-wrap="notes" s-request="nurse_visit">Cancel</button>
            </div>
        </li>
    </ul>
</form>
<?php endif; ?>