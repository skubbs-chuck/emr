<label>Upon re-examination and follow-up, the patient is now:</label>
<div class="radio">
    <label>
        <input type="radio" name="patient_now" class="patient_now" value="1"> In good mental and physical health and is free from any physical defects.
    </label>
    <label>
        <input type="radio" name="patient_now" class="patient_now" value="2"> Cleared to return to work, performing his/her usual duties and hours of work
    </label>
    <div id="patient_now_2">
        on:
        <input type="text" name="pn_on_date1" value="2015-08-14" class="form-control skubbs_datepicker" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">
    </div>
    <label>
        <input type="radio" name="patient_now" class="patient_now" value="3"> Cleared to return to work, but limitation or modification should be considered:
    </label>
    <div id="patient_now_3">
        <input type="text" name="pn_on_date2" value="2015-08-14" class="form-control skubbs_datepicker" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">
        <div>
            <label>
                <input type="checkbox" name="pn_no_lifting" value="accept"> No Heavy Lifting
            </label>
        </div>
        <div>
            <label>
                <input type="checkbox" name="pn_no_bending" value="accept"> No Strenuous Bending/Twisting
            </label>
        </div>
        <div>
            <label>
                <input type="checkbox" name="pn_no_prolonged" value="accept"> No Prolonged Walking/Standing/Sitting
            </label>
        </div>
        <div>
            <label>
                <input type="checkbox" name="pn_equip_limit" value="accept"> Limitation in Operating Equipments
            </label>
        </div>
        <div>
            <label>
                <input type="checkbox" name="pn_other" value=""> Other
            </label>
            <input type="text" name="pn_other_val">
        </div>
    </div>
    <label>
        <input type="radio" name="patient_now" class="patient_now" value="4"> Unable to work this time due to:
    </label>
    <div id="patient_now_4">
        <input type="text" name="pn_unable" class="form-control">
    </div>
</div>