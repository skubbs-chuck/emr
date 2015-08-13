<strong>Family History: </strong>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead><tr><th class="label-primary col-md-5">Relative</th><th class="label-primary col-md-7">Desease Details</th></tr></thead>
        <tbody id="pf_family">
        <?php foreach ($result->family as $family): ?>
            <tr class="skubbs_output" style="display: table-row;"><td><?php echo $family[0] ?></td><td><?php echo $family[1] ?></td></tr>
            <tr class="skubbs_input" style="display: none;">
                <td><input type="text" name="family_relative[]" value="<?php echo $family[0] ?>" class="form-control"></td>
                <td>
                    <div class="input-group" style="margin-bottom: 5px">
                        <input type="text" class="form-control" name="family_desease[]" value="<?php echo $family[1] ?>">
                        <a href="#" class="input-group-addon skubbs_btn-remove btn btn-danger"><i class="fa fa-remove "></i></a>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr class="skubbs_input" style="display: none;">
            <td colspan="2">
            <a href="#" class="btn btn-info btn-xs skubbs_btn-add" s-names="relative,desease" s-id="family">Add Entry</a>
            </td>
            </tr>
        </tfoot>
    </table>
</div>