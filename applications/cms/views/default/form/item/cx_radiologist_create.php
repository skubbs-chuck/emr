<label>Radiologist:</label>
<select name="radiologist" class="form-control">
    <option value="0">OTHER</option>
    <?php foreach ($v['radiologist'] as $radiologist): ?>
    <option value="<?php echo $radiologist->id_user ?>">
        <?php echo ucwords($radiologist->first_name) ?> <?php echo ucwords($radiologist->last_name) ?>
    </option>
    <?php endforeach ?>
</select>
<input type="text" name="radiologist_other" class="form-control" placeholder="Radiologist Name">