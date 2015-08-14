<div><label>Date Inclusive</label></div>
    <div>
        <label class="input-group-addon label-primary"><input name="inclusive" type="radio" value="1" class="skubbs-mc2-di "> On</label>
        <label class="input-group-addon label-info"><input name="inclusive" type="radio" value="2" class="skubbs-mc2-di"> Range</label>
    </div>
    <div>
        <input name="inclusive_on" value="<?php echo date('Y-m-d') ?>" type="text" class="form-control skubbs_datepicker" data-inputmask="'alias': 'dd/mm/yyyy'" style="display:none" placeholder="On Date">
        <input name="inclusive_range_from" value="<?php echo date('Y-m-d') ?>" type="text" class="form-control skubbs_datepicker" data-inputmask="'alias': 'dd/mm/yyyy'"style="display:none" placeholder="Range Start">
        <input name="inclusive_range_to" value="<?php echo date('Y-m-d') ?>" type="text" class="form-control skubbs_datepicker" data-inputmask="'alias': 'dd/mm/yyyy'" style="display:none" placeholder="Range End">
    </div>