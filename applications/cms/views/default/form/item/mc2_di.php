<div><label>Date Inclusive</label></div>
<div class="skubbs_output">
    <?php if ($result->inclusive == 1): ?>
        On <strong><?php echo $result->inclusive_on ?></strong>
    <?php elseif ($result->inclusive == 2): ?>
        From <strong><?php echo $result->inclusive_range_from ?></strong> to <strong><?php echo $result->inclusive_range_to ?></strong>
    <?php else: ?>
        <div class="skubbs_output">Not Set</div>
    <?php endif ?>
</div>
<div class="skubbs_input">
    <div class="input-group">
        <label class="input-group-addon label-primary"><input name="inclusive" type="radio" value="1" class="skubbs-mc2-di" <?php echo ($result->inclusive == 1) ? 'checked="checked"' : '' ?>> On</label>
        <label class="input-group-addon label-info"><input name="inclusive" type="radio" value="2" class="skubbs-mc2-di" <?php echo ($result->inclusive == 2) ? 'checked="checked"' : '' ?>> Range</label>
    </div>
    <div>
        <input name="inclusive_on" type="text" class="form-control skubbs_datepicker" data-inputmask="'alias': 'dd/mm/yyyy'" style="<?php echo ($result->inclusive == 1) ? '' : 'display:none' ?>" placeholder="On Date" value="<?php echo $result->inclusive_on ?>">
        <input name="inclusive_range_from" type="text" class="form-control skubbs_datepicker" data-inputmask="'alias': 'dd/mm/yyyy'"style="<?php echo ($result->inclusive == 2) ? '' : 'display:none' ?>" placeholder="Range Start" value="<?php echo $result->inclusive_range_from ?>">
        <input name="inclusive_range_to" type="text" class="form-control skubbs_datepicker" data-inputmask="'alias': 'dd/mm/yyyy'" style="<?php echo ($result->inclusive == 2) ? '' : 'display:none' ?>" placeholder="Range End" value="<?php echo $result->inclusive_range_to ?>">
    </div>
</div>