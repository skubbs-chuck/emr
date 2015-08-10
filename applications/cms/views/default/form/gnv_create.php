<?php if ($gnv['created']): ?>
    <?php if (isset($gnv['alert']['type'])): ?>
        <div class="alert alert-<?php echo $gnv['alert']['type'] ?>"><?php echo $gnv['alert']['message'] ?></div>
    <?php endif ?>
<script>
setTimeout(function() {
    $('#notes>div>ul>li.active>a.skubbs_ajax').click();
}, 3000);
</script>
<?php else: ?><form action="#" method="post" id="data_form_gnv">
    <ul class="products-list product-list-in-box margin">
        <li class="item">
            <div class="btn-group pull-right">
                <button class="btn btn-primary skubbs_ajax" s-method="post" s-wrap="nurse_visit" s-action="create" s-request="form_gnv">Submit</button>
                <button class="btn skubbs_ajax" s-wrap="notes" s-request="nurse_visit">Cancel</button>
            </div>
        </li>
        <li class="item">
            <strong>Nursing Assessment: </strong>
            <div><?php echo $gnv['form']['nursing_assessment'] ?></div>
        </li>
        <li class="item">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead><tr><th class="label-primary">Assessment</th></tr></thead>
                    <tbody id="assessment_ndp"></tbody>
                    <tfoot>
                        <tr style="display: table-row;">
                            <td colspan="2"><a href="#" class="btn btn-info btn-xs skubbs_btn-add" s-id="ndp">Add Diagnosis</a></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </li>
        <li class="item">
            <strong>Implementation: </strong>
            <div><?php echo $gnv['form']['implementation'] ?></div>
        </li>
        <li class="item">
            <strong>Evaluation: </strong>
            <div><?php echo $gnv['form']['evaluation'] ?></div>
        </li>
        <li class="item">
            <div class="btn-group pull-right">
                <button class="btn btn-primary skubbs_ajax" s-method="post" s-wrap="nurse_visit" s-action="create" s-request="form_gnv">Submit</button>
                <button class="btn skubbs_ajax" s-wrap="notes" s-request="nurse_visit">Cancel</button>
            </div>
        </li>
    </ul>
</form>
<?php endif; ?>