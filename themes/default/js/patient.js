var patient = {
    page       : 'patient', 
    request    : 'medical_history', 
    action     : 'index', 
    method     : 'get', 
    wrap       : 'forms', 
    onload     : '', 
    id_patient : 0, 
    id_form    : 0, 
};

function skubbs_onload(e) {
    ol = {};
    $.each(patient, function(k, v){
        if (typeof ol[k] == 'undefined')
            ol[k] = v;
    });
    ol.action = 'index';
    ol.wrap = e.request;
    ol.request = e.onload;

    return ol;
}

function skubbs_vars(p) {
    $('#patient>span[id^="var-"]').each(function() {
        k = $(this).attr('id').replace(/^var-/, '');
        k = k.replace('-', '_');
        p[k] = $(this).text();
    });
}

function skubbs_attr(e, p) {
    skubbs_ajax = {};
    skubbs_vars(skubbs_ajax);
    e.each(function(){
        $.each(this.attributes, function(i, attr){
            if (attr.name.startsWith('s-')) {
                k = attr.name.replace(/^s-/, '');
                k = k.replace('-', '_');
                skubbs_ajax[k] = attr.value;
            };
        });
    });

    $.each(p, function(k, v){
        if (typeof skubbs_ajax[k] == 'undefined')
            skubbs_ajax[k] = v;
    });

    return skubbs_ajax;
}

function ajax_config(e) {
    e.id_patient = parseInt(e.id_patient) || 0;
    e.id_form = parseInt(e.id_form) || 0;
    e.method = (e.method == 'post') ? 'post' : 'get';
    e.data = 'div#' + e.wrap + '>form#data_' + e.request;
    e.loading = 'div#' + e.wrap + '>div.skubbs_loading';
    e.result = 'div#' + e.wrap + '>div.skubbs_result';
    e.target_url = base_url + ['ajax', e.page, e.request, e.action, e.method, e.id_patient, e.id_form, Date.now()].join('/');
    return e;
}

function ajax_patient(e) {
    ajax_config(e);
    $(e.loading).show();
    $.ajax({
        url: e.target_url,
        method: e.method,
        data: e.data, 
        dataType: 'json', 
        success: function(response) {
            $(e.loading).hide();
            $(e.result).html(response.html);

            if (e.onload != '') 
                ajax_patient(skubbs_onload(e));

            if ($('div[id^="wrap-' + e.request + '-"]').length > 0) {
                $('div[id^="wrap-' + e.request + '-"]').each(function() {
                    skubbs_ajax = {};
                    skubbs_ajax = skubbs_onload(e);
                    s = this.id.split('-');
                    skubbs_ajax.wrap = this.id;
                    skubbs_ajax.request = s[2];
                    skubbs_ajax.id_form = s[3];
                    ajax_config(skubbs_ajax);
                    ajax_patient(skubbs_ajax);
                });
            };

            return false;
        }, 
        complete: function(xhr, textStatus) {
            $(e.loading).hide();
            if (xhr.status != 200) 
                $(e.result).html('<div class="text-center alert alert-danger"><h4>ERROR ' + xhr.status + '</h4>' + xhr.statusText + '</div>');
            
            return false;
        }
    });

    return false;
}

$('div[id^="consultation_data_"]').each(function(index) {
    form_id = $(this).attr('form-id');
    form = $(this).attr('form-tbl');
    id_result = this.id;
    ajaxPatient(form, id_result, 'patient_loading', form_id);
});

$(document).ready(function() {
    skubbs_vars(patient);
    ajax_patient(patient);
});

$(document).on('focus', '.skubbs-datepicker', function() {
    $(this).datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true, 
        toggleActive: true
    });
});

$(document).on('focus', '.skubbs-timepicker', function() {
    $(this).timepicker({
        minuteStep: 5,
        showInputs: false
    });
});

$(document).on('click', '.skubbs_ajax', function() {
    $(this).closest('div.open').removeClass('open');
    ajax_patient(skubbs_attr($(this), patient));
    return false;
});

$(document).on('click', '.skubbs_btn', function() {
    skubbs_attr($(this), patient);
    console.log(skubbs_ajax);
    return false;
});

// function pvar(v) {
//     $.each(arguments, function(i, k){
//         patient[k] = $('span#var_' + k).text();
//     });
// }
// var type_contacts = ['Mobile', 'Home Phone', 'Home Fax', 'Work', 'Work Fax', 'Other'];
// var type_identifications = ['Driver License', 'SSS', 'Senior Citizen', 'Passport', 'Company ID', 'HealthCare Pin', 'Employee No.'];

// function ajax(x) {
//     form   = (typeof x.attr('id') != 'undefined') ? x.attr('id').replace(/^skubbs_ajax_/, '') : 'error';
//     page   = (typeof x.attr('skubbs-page') != 'undefined') ? x.attr('skubbs-page') : 'patient';
//     tab    = (typeof x.attr('skubbs-tab') != 'undefined') ? x.attr('skubbs-tab') : 'error';
//     categ  = (typeof x.attr('skubbs-categ') != 'undefined') ? x.attr('skubbs-categ') : 'error';
//     act    = (typeof x.attr('skubbs-act') != 'undefined') ? x.attr('skubbs-act') : 'index';
//     method = (typeof x.attr('skubbs-method') != 'undefined' && x.attr('skubbs-method') == 'post') ? x.attr('skubbs-method') : 'get';
//     hide_class = (typeof x.attr('skubbs-hide-class') != 'undefined') ? x.attr('skubbs-hide-class').split(' ') : false;
//     patient_id_patient = parseInt($('input#patient_var-id_patient').val());
//     patient_id_patient = (!isNaN(patient_id_patient)) ? patient_id_patient : 0;
//     id_patient = parseInt($('input#' + form + '_var-id_patient').val());
//     id_patient = (!isNaN(id_patient)) ? id_patient : patient_id_patient;
//     id_form = parseInt($('input#' + form + '_var-id_form').val());
//     id_form = (!isNaN(id_form)) ? id_form : 0;

//     // controller_class-ajax/controller_method-page/model_class-form/model_method-act/<func_get_args()>
//     target_url = base_url + 'ajax/' + [page, form, act, id_patient, id_form, Date.now()].join('/');
    
//     div_id = (typeof x.attr('skubbs-div-id') != 'undefined') ? x.attr('skubbs-div-id') : page + '-' + form;
//     $(['#btn', act, div_id].join('-')).removeClass('open');
    
//     div_result  = 'div#' + div_id + '-result';
//     div_loading = 'div#' + div_id + '-loading';
//     form_data   = $('form#' + form).serialize();

//     $(div_loading).show();
//     $.ajax({
//         url: target_url, 
//         method: method, 
//         data: form_data, 
//         dataType: 'json', 
//         success: function(r) {
//             $(div_loading).hide();
//             $(div_result).html(r.html);
//             if (typeof x.attr('skubbs-onload') != 'undefined') 
//                 ajax($('#' + x.attr('skubbs-onload')));
            
//             $.each(hide_class, function(k, v) { $('#' + form + '-result').find('.' + v).hide(); });

//             return false;
//         }, 
//         complete: function(xhr, textStatus) {
//             $(div_loading).hide();
//             if (xhr.status != 200) 
//                 $(div_result).html('<div class="text-center alert alert-danger"><h4>ERROR ' + xhr.status + '</h4>' + xhr.statusText + '</div>');
            
//             return false;
//         }
//     });

//     return false;
// }

// $(document).on('click', 'a[class*="skubbs_btn-"]', function() { 
//     this_btn = $(this);
//     classes  = this_btn.attr('class').split(' ');
//     $.each(classes, function(k, v) {
//         if (/^skubbs_btn-/.test(v)) {
//             var contacts = ['Mobile', 'Home Phone', 'Home Fax', 'Work', 'Work Fax', 'Other'];
//             var identifications = ['Driver License', 'SSS', 'Senior Citizen', 'Passport', 'Company ID', 'HealthCare Pin', 'Employee No.'];

//             ref  = v.split('-');
//             act  = ref[1];
//             form = this_btn.closest('div[id$="-result"]').attr('id').replace(/-result$/, '');
//             id   = (typeof this_btn.attr('skubbs-id') != 'undefined') ? this_btn.attr('skubbs-id') : 'error';
//             names = (typeof this_btn.attr('skubbs-name') != 'undefined') ? this_btn.attr('skubbs-name').split('|') : 'error';
            
//             types = (typeof this_btn.attr('skubbs-type') != 'undefined' && this_btn.attr('skubbs-type') != 'contacts') ? identifications : contacts;

//             switch(act) {
//                 case 'edit':
//                     $('#' + form + '-result .skubbs_input').show();
//                     $('#' + form + '-result .skubbs_output').hide();
//                     $('a[class*="skubbs_btn-edit"]').hide();
//                     $('a[class*="skubbs_btn-save"]').show();
//                     $('a[class*="skubbs_btn-cancel"]').show();
//                 break;
//                 case 'cancel':
//                     $('#' + form + '-result .skubbs_input').hide();
//                     $('#' + form + '-result .skubbs_output').show();
//                     $('a[class*="skubbs_btn-edit"]').show();
//                     $('a[class*="skubbs_btn-save"]').hide();
//                     $('a[class*="skubbs_btn-cancel"]').hide();
//                 break;
//                 case 'save':
//                     $('#' + form + '-result .skubbs_input').hide();
//                     $('#' + form + '-result .skubbs_output').show();
//                     $('a[class*="skubbs_btn-edit"]').show();
//                     $('a[class*="skubbs_btn-save"]').hide();
//                     $('a[class*="skubbs_btn-cancel"]').hide();
//                 break;
//                 case 'add':
//                     $('#' + id).append('<tr class="skubbs_input' + '">' + 
//                         '<td><input type="text" name="' + id + '_' + names[0] + '[]"class="form-control"></td>' +
//                         '<td>' + 
//                             '<div class="input-group" style="margin-bottom: 5px">' + 
//                                 '<input type="text" class="form-control" name="' + id + '_' + names[1] + '[]">' + 
//                                 '<a href="#" class="input-group-addon skubbs_btn-remove-' + form + ' btn btn-danger"><i class="fa fa-remove "></i></a>' + 
//                             '</div>' + 
//                         '</td>' + 
//                     '</tr>');
//                 break;
//                 case 'add_number':
//                     var type_options = '';
//                     for (var i = 0; i < types.length; i++) 
//                         type_options += '<option value="' + types[i] + '">' + types[i] + '</option>';
                    
//                     var type = '<div class="col-lg-3"><select class="form-control" name="' + names[0] + '[]">' + type_options + '</select></div>';
//                     var contact = '<div class="col-lg-9"><div class="input-group" style="margin-bottom: 5px"><input type="text" class="form-control" name="' + names[1] + '[]"><span class="input-group-addon skubbs_btn-remove btn btn-danger"><i class="fa fa-remove "></i></span></div></div>';
//                     $('#' + id).append('<div class="row">' + type + contact + '</div>');
//                 break;
//                 case 'remove':
//                     this_btn.closest('#' + form + '-result .skubbs_input').remove();
//                 break;
//             }
//         }
//     });

//     return false;
// });


// $(document).ready(function() { 
//     ajax($('#skubbs_ajax_medical_history')); 
// });

// $(document).on('click', 'a[id^="skubbs_ajax_"]', function() { ajax($(this)); return false; });



// // $(document).on('click', 'a#')
// $(document).on('click', '#patient-add_number-contact', function() {
//     var ctypes = ['Mobile', 'Home Phone', 'Home Fax', 'Work', 'Work Fax', 'Other'];
//     var contact_type_options = '';
//     for (var i = 0; i < ctypes.length; i++) 
//         contact_type_options += '<option value="' + ctypes[i] + '">' + ctypes[i] + '</option>';
    
//     var contact_type = '<div class="col-lg-3"><select class="form-control" name="contacts_type[]">' + contact_type_options + '</select></div>';
//     var contact_number = '<div class="col-lg-9"><div class="input-group" style="margin-bottom: 5px"><input type="text" class="form-control" name="contacts_number[]"><span class="input-group-addon remove-contact btn btn-danger"><i class="fa fa-remove "></i></span></div></div>';
//     $('#contacts').append('<div class="row">' + contact_type + contact_number + '</div>');
// });

// $(document).on('click', '#patient-add_number-identification', function() {
//     var itypes = ['Driver License', 'SSS', 'Senior Citizen', 'Passport', 'Company ID', 'HealthCare Pin', 'Employee No.'];
//     var identification_type_options = '';
//     for (var i = 0; i < itypes.length; i++) 
//         identification_type_options += '<option value="' + itypes[i] + '">' + itypes[i] + '</option>';
    
//     var identification_type = '<div class="col-lg-3"><select class="form-control" name="identifications_type[]">' + identification_type_options + '</select></div>';
//     var identification_number = '<div class="col-lg-9"><div class="input-group" style="margin-bottom: 5px"><input type="text" class="form-control" name="identifications_number[]"><span class="input-group-addon remove-identification btn btn-danger"><i class="fa fa-remove "></i></span></div></div>';
//     $('#identifications').append('<div class="row">' + identification_type + identification_number + '</div>');
// });

// $(document).on('click', '.remove-contact', function() { $(this).parent().parent().parent().remove(); });
// $(document).on('click', '.remove-identification', function() { $(this).parent().parent().parent().remove(); });

// // patient->add end

// // function ajaxPatient(form, id_result, id_loading, id_form, what2do) {
// //     id_result = (typeof id_result !== 'undefined') ? id_result : 'patient_informations';
// //     id_loading = (typeof id_loading !== 'undefined') ? id_loading : 'patient_loading';
// //     what2do = (typeof what2do !== 'undefined') ? what2do : '';
// //     $('#' + id_loading).show();
// //     $.ajax({
// //         url: base_url + 'ajax/patient/' + form + '/' + $('#id_patient').text() + '/' + id_form + '?' + what2do, 
// //         dataType: 'json', 
// //         success: function(r) {
// //             $('#' + id_result).html(r.html);
// //             $('#' + id_loading).hide();
// //             if (form == 'notes' && id_result == 'patient_informations') {
// //                 ajaxPatient('consultation', 'patient_notes');
// //             };
// //             return false;
// //         }, 
// //         complete: function(xhr, textStatus) {
// //             if (xhr.status != 200) {
// //                 $('#' + id_result).html('<div class="text-center alert alert-danger"><h4>ERROR ' + xhr.status + '</h4>' + xhr.statusText + '</div>');
// //                 $('#' + id_loading).hide();
// //             };
            
// //             return false;
// //         }
// //     });
// // }

// // // medical history start
// // ajaxPatient('medical_history');
// // $(document).on('click', 'a[id^="patient-ajax-"]', function() {
// //     form = $(this).attr('id').replace(/^patient-ajax-/, '');
// //     form = form.replace(/-/, '_');
// //     ajaxPatient(form);
// //     return false;
// // });

// // $(document).on('click', 'a[id^="patient-notes-ajax-"]', function() {
// //     form = $(this).attr('id').replace(/^patient-notes-ajax-/, '');
// //     form = form.replace(/-/, '_');
// //     ajaxPatient(form, 'patient_notes');
// //     return false;
// // });

// // $(document).on('click', 'a[id^="create_new_notes-"]', function() {
// //     inf = this.id.split('-');
// //     id_patient = $('#' + inf[1] + '_var-id_patient').val();
// //     id_form = $('#' + inf[1] + '_var-id_form').val();
// //     form = inf[2];
// //     id_result = 'result_' + inf[1];
// //     id_loading = 'patient_loading';
// //     $.ajax({
// //         url: base_url + 'ajax/patient/' + form + '/' + id_patient + '/' + id_form + '/create?time=' + Date.now(), 
// //         dataType: 'json', 
// //         success: function(r) {
// //             $('#' + id_result).html('');
// //             $('#' + id_result).html(r.html);
// //             $('#' + id_loading).hide();
// //             return false;
// //         }, 
// //         complete: function(xhr, textStatus) {
// //             if (xhr.status != 200) {
// //                 $('#' + id_result).html('<div class="text-center alert alert-danger"><h4>ERROR ' + xhr.status + '</h4>' + xhr.statusText + '</div>');
// //                 $('#' + id_loading).hide();
// //             };
            
// //             return false;
// //         }
// //     });

// //     $(this).parent().parent().parent().removeClass('open');
// //     return false;
// // });

