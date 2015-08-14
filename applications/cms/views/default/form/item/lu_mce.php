<div class="box-body label-primary">Macroscopic/Chemical Examination Test Components <small>(Unit | Reference Range)</small></div>
<div class="form-group">
    <div class="input-group">
        <div class="input-group-addon" style="min-width: 160px; text-align:left"><strong>Color</strong></div>
        <span class="skubbs_output"><input type="text" class="form-control" value="<?php echo $result->color ?>" disabled="disabled"></span>
        <span class="skubbs_input"><input type="text" name="color" class="form-control" value="<?php echo $result->color ?>"></span>
    </div>
    <div class="input-group">
        <div class="input-group-addon" style="min-width: 160px; text-align:left"><strong>Transparency</strong></div>
        <span class="skubbs_output"><input type="text" class="form-control" value="<?php echo $result->transparency ?>" disabled="disabled"></span>
        <span class="skubbs_input"><input type="text" name="transparency" class="form-control" value="<?php echo $result->transparency ?>"></span>
    </div>
    <div class="input-group">
        <div class="input-group-addon" style="min-width: 160px; text-align:left"><strong>Glucose</strong></div>
        <span class="skubbs_output"><input type="text" disabled="disabled" value="<?php echo (!empty($result->glucose)) ? $v['ps'][$result->glucose] : '' ?>" class="form-control"></span>
        <span class="skubbs_input"><?php echo form_dropdown('glucose', $v['ps'], $result->glucose, 'class="form-control"'); ?></span>
    </div>
    <div class="input-group">
        <div class="input-group-addon" style="min-width: 160px; text-align:left"><strong>Bile</strong></div>
        <span class="skubbs_output"><input type="text" disabled="disabled" value="<?php echo (!empty($result->bile)) ? $v['ps'][$result->bile] : '' ?>" class="form-control"></span>
        <span class="skubbs_input"><?php echo form_dropdown('bile', $v['ps'], $result->bile, 'class="form-control"'); ?></span>
    </div>
    <div class="input-group">
        <div class="input-group-addon" style="min-width: 160px; text-align:left"><strong>Ketone</strong></div>
        <span class="skubbs_output"><input type="text" disabled="disabled" value="<?php echo (!empty($result->ketone)) ? $v['ps'][$result->ketone] : '' ?>" class="form-control"></span>
        <span class="skubbs_input"><?php echo form_dropdown('ketone', $v['ps'], $result->ketone, 'class="form-control"'); ?></span>
    </div>
    <div class="input-group">
        <div class="input-group-addon" style="min-width: 160px; text-align:left"><strong>Specific Gravity</strong></div>
        <span class="skubbs_output"><input type="text" class="form-control" value="<?php echo $result->gravity ?>" disabled="disabled"></span>
        <span class="skubbs_input"><input type="text" name="gravity" class="form-control" value="<?php echo $result->gravity ?>"></span>
    </div>
    <div class="input-group">
        <div class="input-group-addon" style="min-width: 160px; text-align:left"><strong>pH (reaction)</strong></div>
        <span class="skubbs_output"><input type="text" class="form-control" value="<?php echo $result->phr ?>" disabled="disabled"></span>
        <span class="skubbs_input"><input type="text" name="phr" class="form-control" value="<?php echo $result->phr ?>"></span>
    </div>
    <div class="input-group">
        <div class="input-group-addon" style="min-width: 160px; text-align:left"><strong>Protein</strong></div>
        <span class="skubbs_output"><input type="text" disabled="disabled" value="<?php echo (!empty($result->protein)) ? $v['ps'][$result->protein] : '' ?>" class="form-control"></span>
        <span class="skubbs_input"><?php echo form_dropdown('protein', $v['ps'], $result->protein, 'class="form-control"'); ?></span>
    </div>
    <div class="input-group">
        <div class="input-group-addon" style="min-width: 160px; text-align:left"><strong>Urobilinogen</strong> <span class="pull-right"><small>( E.U./dL )</small></span></div>
        <span class="skubbs_output"><input type="text" class="form-control" value="<?php echo $result->urobilinogen ?>" disabled="disabled"></span>
        <span class="skubbs_input"><input type="text" name="urobilinogen" class="form-control" value="<?php echo $result->urobilinogen ?>"></span>
    </div>
    <div class="input-group">
        <div class="input-group-addon" style="min-width: 160px; text-align:left"><strong>Nitrites</strong></div>
        <span class="skubbs_output"><input type="text" disabled="disabled" value="<?php echo (!empty($result->nitrites)) ? $v['ps'][$result->nitrites] : '' ?>" class="form-control"></span>
        <span class="skubbs_input"><?php echo form_dropdown('nitrites', $v['ps'], $result->nitrites, 'class="form-control"'); ?></span>
    </div>
    <div class="input-group">
        <div class="input-group-addon" style="min-width: 160px; text-align:left"><strong>Blood</strong></div>
        <span class="skubbs_output"><input type="text" disabled="disabled" value="<?php echo (!empty($result->blood)) ? $v['ps'][$result->blood] : '' ?>" class="form-control"></span>
        <span class="skubbs_input"><?php echo form_dropdown('blood', $v['ps'], $result->blood, 'class="form-control"'); ?></span>
    </div>
    <div class="input-group">
        <div class="input-group-addon" style="min-width: 160px; text-align:left"><strong>Leukocytes</strong></div>
        <span class="skubbs_output"><input type="text" disabled="disabled" value="<?php echo (!empty($result->leukocytes)) ? $v['ps'][$result->leukocytes] : '' ?>" class="form-control"></span>
        <span class="skubbs_input"><?php echo form_dropdown('leukocytes', $v['ps'], $result->leukocytes, 'class="form-control"'); ?></span>
    </div>
</div>