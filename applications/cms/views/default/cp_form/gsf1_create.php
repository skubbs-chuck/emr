<?php if ($gsf1['created']): ?>
    <?php if (isset($gsf1['alert']['type'])): ?>
        <div class="alert alert-<?php echo $gsf1['alert']['type'] ?>"><?php echo $gsf1['alert']['message'] ?></div>
    <?php endif ?>
<script>
setTimeout(function() {
    $('#notes>div>ul>li.active>a.skubbs_ajax').click();
}, 3000);
</script>
<?php else: ?><form action="#" method="post" id="data_form_gsf1">
    <ul class="products-list product-list-in-box margin">
        <li class="item">
            <div class="btn-group pull-right">
                <button class="btn btn-primary skubbs_ajax" s-method="post" s-wrap="consultation" s-action="create" s-request="form_gsf1">Submit</button>
                <button class="btn skubbs_ajax" s-wrap="notes" s-request="consultation">Cancel</button>
            </div>
        </li>
        <li class="item">
            <strong>soap_img: </strong>
            <div><?php echo $gsf1['form']['soap_img'] ?></div>
        </li>
        <li class="item">
            <strong>Subjective: </strong>
            <div><?php echo $gsf1['form']['subjective'] ?></div>
        </li>
        <li class="item">
            <strong>Plan: </strong>
            <div><?php echo $gsf1['form']['plan'] ?></div>
        </li>
        <li class="item">
            <div class="btn-group pull-right">
                <button class="btn btn-primary skubbs_ajax" s-method="post" s-wrap="consultation" s-action="create" s-request="form_gsf1">Submit</button>
                <button class="btn skubbs_ajax" s-wrap="notes" s-request="consultation">Cancel</button>
            </div>
        </li>
    </ul>
</form>
<?php endif; ?>