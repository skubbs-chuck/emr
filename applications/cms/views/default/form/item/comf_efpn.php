<?php
$pn_arr = array(
    1 => 'In good mental and physical health and is free from any physical defects.', 
    2 => 'Cleared to return to work, performing his/her usual duties and hours of work', 
    3 => 'Cleared to return to work, but limitation or modification should be considered:', 
    4 => 'Unable to work this time due to:', 
);
$pn3_arr = array(
    'pn_no_lifting' => 'No Heavy Lifting', 
    'pn_no_bending' => 'No Strenuous Bending/Twisting', 
    'pn_no_prolonged' => 'No Prolonged Walking/Standing/Sitting', 
    'pn_equip_limit' => 'Limitation in Operating Equipments', 
    'pn_other' => 'Other', 
);
?>
<label>Upon re-examination and follow-up, the patient is now:</label>
<div class="skubbs_output">
<?php echo $pn_arr[$result->pn]; ?>
<?php 
switch ($result->pn) {
    case 2:
        echo ' on <strong>' . date('F j, Y', strtotime($result->pn_on_date1)) . '</strong>'; 
    break;
    case 3:
        echo ' on <strong>' . date('F j, Y', strtotime($result->pn_on_date2)) . '</strong><br>'; 
        echo "<ul>";
        foreach ($pn3_arr as $key => $value) {
            if ($result->$key) 
                echo '<li>' . $value . (($key == 'pn_other') ? ': ' . $result->pn_other_val : '') .  '</li>';
        }
        echo "<ul>";
    break;
}
?>
</div>
<div class="radio skubbs_input">
    <div><label><input type="radio" name="pn" class="patient_now" value="1"> <?php echo $pn_arr[1] ?></label></div>
    <div><label><input type="radio" name="pn" class="patient_now" value="2"> <?php echo $pn_arr[2] ?></label></div>
    <div id="patient_now_2">
        on: <input type="text" name="pn_on_date1" value="<?php echo date('Y-m-d', strtotime($result->pn_on_date1)); ?>" class="form-control skubbs_datepicker" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">
    </div>
    <div><label><input type="radio" name="pn" class="patient_now" value="3"> <?php echo $pn_arr[3] ?></label></div>
    <div id="patient_now_3">
        on: <input type="text" name="pn_on_date2" value="<?php echo date('Y-m-d', strtotime($result->pn_on_date2)); ?>" class="form-control skubbs_datepicker" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">
        <div><label><input type="checkbox" name="pn_no_lifting" value="1" <?php echo ($result->pn_no_lifting > 0) ? 'checked="checked"' : '' ?>> <?php echo $pn3_arr['pn_no_lifting'] ?></label></div>
        <div><label><input type="checkbox" name="pn_no_bending" value="1" <?php echo ($result->pn_no_bending > 0) ? 'checked="checked"' : '' ?>> <?php echo $pn3_arr['pn_no_bending'] ?></label></div>
        <div><label><input type="checkbox" name="pn_no_prolonged" value="1" <?php echo ($result->pn_no_prolonged > 0) ? 'checked="checked"' : '' ?>> <?php echo $pn3_arr['pn_no_prolonged'] ?></label></div>
        <div><label><input type="checkbox" name="pn_equip_limit" value="1" <?php echo ($result->pn_equip_limit > 0) ? 'checked="checked"' : '' ?>> <?php echo $pn3_arr['pn_equip_limit'] ?></label></div>
        <div><label><input type="checkbox" name="pn_other" value="1" <?php echo ($result->pn_other > 0) ? 'checked="checked"' : '' ?>> <?php echo $pn3_arr['pn_other'] ?></label> <input type="text" name="pn_other_val" value="<?php echo ($result->pn_other > 0) ? $result->pn_other_val : '' ?>"></div>
    </div>
    <div><label><input type="radio" name="pn" class="patient_now" value="4"> <?php echo $pn_arr[4] ?></label></div>
    <div id="patient_now_4">
        <input type="text" name="pn_unable2work" class="form-control" value="<?php echo $result->pn_unable2work ?>">
    </div>
</div>
<script>
var pn = <?php echo $result->pn ?>;
if (pn > 0) {
    $('input[name="pn"][value="' + pn + '"]').attr('checked', 'checked');
    $('#patient_now_' + pn).show();
};
</script>