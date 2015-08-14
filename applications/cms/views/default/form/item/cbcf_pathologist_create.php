<label>Pathologist:</label>
<select name="pathologist" class="form-control">
    <option value="0">OTHER</option>
    <?php foreach ($v['pathologist'] as $pathologist): ?>
    <option value="<?php echo $pathologist->id_user ?>">
        <?php echo ucwords($pathologist->first_name) ?> <?php echo ucwords($pathologist->last_name) ?>
    </option>
    <?php endforeach ?>
</select>
<input type="text" name="pathologist_other" class="form-control" placeholder="Pathologist Name">