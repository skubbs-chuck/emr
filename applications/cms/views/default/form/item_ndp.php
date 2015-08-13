<div class="table-responsive">
    <table class="table table-bordered">
        <thead><tr><th class="label-primary">Assessment</th></tr></thead>
        <tbody id="assessment_ndp">
        <?php foreach ($item['data'] as $io): ?>
            <tr class="skubbs_output">
                <td>
                    <label>Nursing Diagnosis</label><div><?php echo $io[0] ?></div>
                    <label>Plan</label><div><?php echo $io[1] ?></div>
                </td>
            </tr>
            <tr class="skubbs_input" style="display: none;">
                <td>
                    <label>Nursing Diagnosis</label>
                    <input type="text" name="ndp_diagnosis[]" class="form-control" value="<?php echo $io[0] ?>">
                    <label>Plan</label>
                    <div class="input-group" style="margin-bottom: 5px">
                        <textarea name="ndp_plan[]" class="form-control" rows="3"><?php echo $io[1] ?></textarea>
                        <a class="input-group-addon skubbs_btn-remove btn btn-danger"><i class="fa fa-remove "></i></a>
                    </div>
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