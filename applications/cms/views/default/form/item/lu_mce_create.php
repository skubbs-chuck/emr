<div class="box-body label-primary">Macroscopic/Chemical Examination Test Components <small>(Unit | Reference Range)</small></div>
<div class="form-group">
    <div class="input-group">
        <div class="input-group-addon" style="min-width: 160px; text-align:left"><strong>Color</strong></div>
        <input type="text" name="color" class="form-control">
    </div>
    <div class="input-group">
        <div class="input-group-addon" style="min-width: 160px; text-align:left"><strong>Transparency</strong></div>
        <input type="text" name="transparency" class="form-control">
    </div>
    <div class="input-group">
        <div class="input-group-addon" style="min-width: 160px; text-align:left"><strong>Glucose</strong></div>
        <?php echo form_dropdown('glucose', $v['ps'], '', 'class="form-control"'); ?>
    </div>
    <div class="input-group">
        <div class="input-group-addon" style="min-width: 160px; text-align:left"><strong>Bile</strong></div>
        <?php echo form_dropdown('bile', $v['ps'], '', 'class="form-control"'); ?>
    </div>
    <div class="input-group">
        <div class="input-group-addon" style="min-width: 160px; text-align:left"><strong>Ketone</strong></div>
        <?php echo form_dropdown('ketone', $v['ps'], '', 'class="form-control"'); ?>
    </div>
    <div class="input-group">
        <div class="input-group-addon" style="min-width: 160px; text-align:left"><strong>Specific Gravity</strong></div>
        <input type="text" name="gravity" class="form-control">
    </div>
    <div class="input-group">
        <div class="input-group-addon" style="min-width: 160px; text-align:left"><strong>pH (reaction)</strong></div>
        <input type="text" name="phr" class="form-control">
    </div>
    <div class="input-group">
        <div class="input-group-addon" style="min-width: 160px; text-align:left"><strong>Protein</strong></div>
        <?php echo form_dropdown('protein', $v['ps'], '', 'class="form-control"'); ?>
    </div>
    <div class="input-group">
        <div class="input-group-addon" style="min-width: 160px; text-align:left"><strong>Urobilinogen</strong> <span class="pull-right"><small>( E.U./dL )</small></span></div>
        <input type="text" name="urobilinogen" class="form-control">
    </div>
    <div class="input-group">
        <div class="input-group-addon" style="min-width: 160px; text-align:left"><strong>Nitrites</strong></div>
        <?php echo form_dropdown('nitrites', $v['ps'], '', 'class="form-control"'); ?>
    </div>
    <div class="input-group">
        <div class="input-group-addon" style="min-width: 160px; text-align:left"><strong>Blood</strong></div>
        <?php echo form_dropdown('blood', $v['ps'], '', 'class="form-control"'); ?>
    </div>
    <div class="input-group">
        <div class="input-group-addon" style="min-width: 160px; text-align:left"><strong>Leukocytes</strong></div>
        <?php echo form_dropdown('leukocytes', $v['ps'], '', 'class="form-control"'); ?>
    </div>
</div>