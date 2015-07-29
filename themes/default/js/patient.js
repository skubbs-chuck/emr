// patient->add start
$(document).on('click', '#patient-add-contact', function() {
    var ctypes = ['Mobile', 'Home Phone', 'Home Fax', 'Work', 'Work Fax', 'Other'];
    var contact_type_options = '';
    for (var i = 0; i < ctypes.length; i++) 
        contact_type_options += '<option value="' + ctypes[i] + '">' + ctypes[i] + '</option>';
    
    var contact_type = '<div class="col-lg-3"><select class="form-control" name="contacts_type[]">' + contact_type_options + '</select></div>';
    var contact_number = '<div class="col-lg-9"><div class="input-group" style="margin-bottom: 5px"><input type="text" class="form-control" name="contacts_number[]"><span class="input-group-addon remove-contact btn btn-danger"><i class="fa fa-remove "></i></span></div></div>';
    $('#contacts').append('<div class="row">' + contact_type + contact_number + '</div>');
});
$(document).on('click', '#patient-add-identification', function() {
    var itypes = ['Driver License', 'SSS', 'Senior Citizen', 'Passport', 'Company ID', 'HealthCare Pin', 'Employee No.'];
    var identification_type_options = '';
    for (var i = 0; i < itypes.length; i++) 
        identification_type_options += '<option value="' + itypes[i] + '">' + itypes[i] + '</option>';
    
    var identification_type = '<div class="col-lg-3"><select class="form-control" name="identifications_type[]">' + identification_type_options + '</select></div>';
    var identification_number = '<div class="col-lg-9"><div class="input-group" style="margin-bottom: 5px"><input type="text" class="form-control" name="identifications_number[]"><span class="input-group-addon remove-identification btn btn-danger"><i class="fa fa-remove "></i></span></div></div>';
    $('#identifications').append('<div class="row">' + identification_type + identification_number + '</div>');
});
$(document).on('click', '.remove-contact', function() { $(this).parent().parent().parent().remove(); });
$(document).on('click', '.remove-identification', function() { $(this).parent().parent().parent().remove(); });
$('#patient-add-birth_date').datepicker({
    format: "yyyy-mm-dd",
    autoclose: true,
    todayHighlight: true, 
    toggleActive: true
});
// patient->add end




function ajaxPatient(form, id_result, id_loading, id_form, what2do) {
    id_result = (typeof id_result !== 'undefined') ? id_result : 'patient_informations';
    id_loading = (typeof id_loading !== 'undefined') ? id_loading : 'patient_loading';
    what2do = (typeof what2do !== 'undefined') ? what2do : '';
    $('#' + id_loading).show();
    $.ajax({
        url: base_url + 'ajax/patient/' + form + '/' + $('#id_patient').text() + '/' + id_form + '?' + what2do, 
        dataType: 'json', 
        success: function(r) {
            $('#' + id_result).html(r.html);
            $('#' + id_loading).hide();
            if (form == 'notes' && id_result == 'patient_informations') {
                ajaxPatient('consultation', 'patient_notes');
            };
            return false;
        }, 
        complete: function(xhr, textStatus) {
            if (xhr.status != 200) {
                $('#' + id_result).html('<div class="text-center alert alert-danger"><h4>ERROR ' + xhr.status + '</h4>' + xhr.statusText + '</div>');
                $('#' + id_loading).hide();
            };
            
            return false;
        }
    });
}

ajaxPatient('medical_history');
$(document).on('click', 'a[id^="patient-ajax-"]', function() {
    form = $(this).attr('id').replace(/^patient-ajax-/, '');
    form = form.replace(/-/, '_');
    ajaxPatient(form);
    return false;
});

$(document).on('click', 'a[id^="patient-notes-ajax-"]', function() {
    form = $(this).attr('id').replace(/^patient-notes-ajax-/, '');
    form = form.replace(/-/, '_');
    ajaxPatient(form, 'patient_notes');
    return false;
});
