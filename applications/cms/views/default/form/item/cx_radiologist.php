<label>Radiologist:</label>
<div class="skubbs_output">
    <?php foreach ($v['radiologist'] as $radiologist): ?>
        <?php echo ($radiologist->id_user == $result->radiologist) ? ucwords($radiologist->first_name) . ' ' . ucwords($radiologist->last_name) : '' ?>
    <?php endforeach ?>
    <?php echo ($result->radiologist == 0) ? $result->radiologist_other : '' ?>
</div>
<span class="skubbs_input">
    <select name="radiologist" class="form-control">
        <option value="0">OTHER</option>
        <?php foreach ($v['radiologist'] as $radiologist): ?>
        <option value="<?php echo $radiologist->id_user ?>" <?php echo ($radiologist->id_user == $result->radiologist) ? 'selected="selected"': '' ?>>
            <?php echo ucwords($radiologist->first_name) ?> <?php echo ucwords($radiologist->last_name) ?>
        </option>
        <?php endforeach ?>
    </select>
    <input type="text" name="radiologist_other" class="form-control" placeholder="Radiologist Name" style="<?php echo ($result->radiologist != 0) ? 'display:none': '' ?>" value="<?php echo $result->radiologist_other ?>">
</span>