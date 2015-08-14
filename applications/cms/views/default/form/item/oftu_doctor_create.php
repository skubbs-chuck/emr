<label>Doctor:</label>
<select name="doctor" class="form-control">
    <option value="0">OTHER</option>
    <?php foreach ($v['doctor'] as $doctor): ?>
    <option value="<?php echo $doctor->id_user ?>">
        <?php echo ucwords($doctor->first_name) ?> <?php echo ucwords($doctor->last_name) ?>
    </option>
    <?php endforeach ?>
</select>
<input type="text" name="doctor_other" class="form-control" placeholder="Doctor Name">