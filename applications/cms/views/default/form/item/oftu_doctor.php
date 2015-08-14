<label>Doctor:</label>
<div class="skubbs_output">
    <?php foreach ($v['doctor'] as $doctor): ?>
        <?php echo ($doctor->id_user == $result->doctor) ? ucwords($doctor->first_name) . ' ' . ucwords($doctor->last_name) : '' ?>
    <?php endforeach ?>
    <?php echo ($result->doctor == 0) ? $result->doctor_other : '' ?>
</div>
<span class="skubbs_input">
    <select name="doctor" class="form-control">
        <option value="0">OTHER</option>
        <?php foreach ($v['doctor'] as $doctor): ?>
        <option value="<?php echo $doctor->id_user ?>" <?php echo ($doctor->id_user == $result->doctor) ? 'selected="selected"': '' ?>>
            <?php echo ucwords($doctor->first_name) ?> <?php echo ucwords($doctor->last_name) ?>
        </option>
        <?php endforeach ?>
    </select>
    <input type="text" name="doctor_other" class="form-control" placeholder="Doctor Name" style="<?php echo ($result->doctor != 0) ? 'display:none': '' ?>" value="<?php echo $result->doctor_other ?>">
</span>