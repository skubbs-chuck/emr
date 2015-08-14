<strong>Past Hospitalizations and Surgeries: </strong>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead><tr><th class="label-primary">Date/Year</th><th class="label-primary">Details</th></tr></thead>
        <tbody id="pf_phas">
        <?php foreach ($result->phas as $phas): ?>
            <tr class="skubbs_output" style="display: table-row;">
                <td><?php echo $phas[0] ?></td>
                <td><?php echo $phas[1] ?></td>
            </tr>
            <tr class="skubbs_input" style="display: none;">
                <td><input type="text" name="phas_date_year[]" value="<?php echo $phas[0] ?>" class="form-control"></td>
                <td>
                    <div class="input-group" style="margin-bottom: 5px">
                        <input type="text" class="form-control" name="phas_detail[]" value="<?php echo $phas[1] ?>">
                        <a href="#" class="input-group-addon skubbs_btn-remove btn btn-danger"><i class="fa fa-remove "></i></a>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr class="skubbs_input" style="display: none;">
                <td colspan="2">
                    <a href="#" class="btn btn-info btn-xs skubbs_btn-add" s-names="date_year,detail" s-id="phas">Add Entry</a>
                </td>
            </tr>
        </tfoot>
    </table>
</div>