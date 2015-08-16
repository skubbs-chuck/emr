<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="label-primary">Defects or Conditions</th>
            </tr>
        </thead>
        <tbody id="mc1_doc">
            <?php foreach ($item['data'] as $data): ?>
            <tr class="skubbs_output">
                <td><?php echo $data ?></td>
            </tr>
            <tr class="skubbs_input">
                <td>
                    <div class="input-group" style="margin-bottom: 5px">
                    <input type="text" name="mc1_doc[]" class="form-control" value="<?php echo $data ?>"><a class="input-group-addon skubbs_btn-remove btn btn-danger"><i class="fa fa-remove "></i></a></div>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr class="skubbs_input">
                <td colspan="2"><a href="#" class="btn btn-info btn-xs skubbs_btn-add" s-id="doc">Add Entry</a></td>
            </tr>
        </tfoot>
    </table>
</div>