<div class="box-body label-primary">Complete Blood Count Test Components <small>(Unit | Reference Interval)</small></div>
<div class="form-group">
    <div class="input-group">
        <div class="input-group-addon" style="min-width: 250px; text-align:left"><strong>Hemoglobin</strong> <span class="pull-right"><small>( g/dl | 11.6 - 15.5 )</small></span></div>
        <input type="text" class="form-control skubbs_output" value="<?php echo $result->hemoglobin ?>" disabled="disabled">
        <span class="skubbs_input"><input type="text" name="hemoglobin" class="form-control" value="<?php echo $result->hemoglobin ?>"></span>
    </div>
    <div class="input-group">
        <div class="input-group-addon" style="min-width: 250px; text-align:left"><strong>Hematocrit</strong> <span class="pull-right"><small>( % | 36.0 - 47.0 )</small></span></div>
        <input type="text" class="form-control skubbs_output" value="<?php echo $result->hematocrit ?>" disabled="disabled">
        <span class="skubbs_input"><input type="text" name="hematocrit" class="form-control" value="<?php echo $result->hematocrit ?>"></span>
    </div>
    <div class="input-group">
        <div class="input-group-addon" style="min-width: 250px; text-align:left"><strong>RBC Count</strong> <span class="pull-right"><small>( mil/mm3 | 4.20 - 5.40 )</small></span></div>
        <input type="text" class="form-control skubbs_output" value="<?php echo $result->rbc ?>" disabled="disabled">
        <span class="skubbs_input"><input type="text" name="rbc" class="form-control" value="<?php echo $result->rbc ?>"></span>
    </div>
    <div class="input-group">
        <div class="input-group-addon" style="min-width: 250px; text-align:left"><strong>WBC Count</strong> <span class="pull-right"><small>( mm3 | 4800 - 10800 )</small></span></div>
        <input type="text" class="form-control skubbs_output" value="<?php echo $result->wbc ?>" disabled="disabled">
        <span class="skubbs_input"><input type="text" name="wbc" class="form-control" value="<?php echo $result->wbc ?>"></span>
    </div>
</div>