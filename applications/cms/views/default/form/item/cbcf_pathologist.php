<label>Pathologist:</label>
<div class="skubbs_output">
    <?php foreach ($v['pathologist'] as $pathologist): ?>
        <?php echo ($pathologist->id_user == $result->pathologist) ? ucwords($pathologist->first_name) . ' ' . ucwords($pathologist->last_name) : '' ?>
    <?php endforeach ?>
    <?php echo ($result->pathologist == 0) ? $result->pathologist_other : '' ?>
</div>
<span class="skubbs_input">
    <select name="pathologist" class="form-control">
        <option value="0">OTHER</option>
        <?php foreach ($v['pathologist'] as $pathologist): ?>
        <option value="<?php echo $pathologist->id_user ?>" <?php echo ($pathologist->id_user == $result->pathologist) ? 'selected="selected"': '' ?>>
            <?php echo ucwords($pathologist->first_name) ?> <?php echo ucwords($pathologist->last_name) ?>
        </option>
        <?php endforeach ?>
    </select>
    <input type="text" name="pathologist_other" class="form-control" placeholder="Pathologist Name" style="<?php echo ($result->pathologist != 0) ? 'display:none': '' ?>" value="<?php echo $result->pathologist_other ?>">
</span>