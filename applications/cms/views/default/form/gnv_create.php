<form action="#" method="post" id="data_form_gnv">
    <ul class="products-list product-list-in-box margin">
        <li class="item" id="gnv-message">
            <?php if (isset($gnv['var']['message'])): ?>
                <div class="alert alert-<?php echo $gnv['var']['message_type'] ?>"><?php echo $gnv['var']['message'] ?></div>
            <?php endif ?>
        </li>
        <li class="item">
            <div class="btn-group pull-right">
                <button class="btn btn-primary skubbs_ajax" s-method="post" s-wrap="nurse_visit" s-action="create" s-request="form_gnv">Submit</button>
                <button class="btn skubbs_ajax" s-wrap="notes" s-request="nurse_visit">Cancel</button>
            </div>
        </li>
        <li class="item">
            <strong>Nursing Assessment: </strong>
            <div><textarea name="nursing_assessment" class="form-control" rows="3"><?php echo $gnv['data']->nursing_assessment ?></textarea></div>
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
            <div><textarea name="implementation" class="form-control" rows="3"><?php echo $gnv['data']->implementation ?></textarea></div>
        </li>
        <li class="item">
            <strong>Evaluation: </strong>
            <div><textarea name="evaluation" class="form-control" rows="3"><?php echo $gnv['data']->evaluation ?></textarea></div>
        </li>
        <li class="item">
            <div class="btn-group pull-right">
                <button class="btn btn-primary skubbs_ajax" s-method="post" s-wrap="nurse_visit" s-action="create" s-request="form_gnv">Submit</button>
                <button class="btn skubbs_ajax" s-wrap="notes" s-request="nurse_visit">Cancel</button>
            </div>
        </li>
    </ul>
</form>