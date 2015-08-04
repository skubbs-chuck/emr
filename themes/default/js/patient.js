ajax = {};
patient = {
    page       : 'patient', 
    request    : 'medical_history', 
    action     : 'index', 
    method     : 'get', 
    wrap       : 'forms', 
    loading    : 'div#forms>div.skubbs_loading', 
    result     : 'div#forms>div.skubbs_result', 
    data       : 'form#data_medical_history', 
    target_url : base_url + 'ajax/patient/medical_history/index/get/0/0', 
    onload     : '', 
    id_patient : 0, 
    id_form    : 0, 
};
rm_btn = '<a href="#" class="input-group-addon skubbs_btn-remove btn btn-danger"><i class="fa fa-remove "></i></a>';

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
    ajax = {};
    skubbs_vars(ajax);

    if (typeof e == 'object') {
        e.each(function(){
            $.each(this.attributes, function(i, attr){
                if (attr.name.startsWith('s-')) {
                    k = attr.name.replace(/^s-/, '');
                    k = k.replace('-', '_');
                    ajax[k] = attr.value;
                };
            });
        });
    };

    if (typeof p == 'object') {
        $.each(p, function(k, v){
            if (typeof ajax[k] == 'undefined')
                ajax[k] = v;
        });
    };
    

    return ajax;
}


function skubbs_add_number(types, name) { // for contact and identification number
    number = '<div class="row skubbs_input"><div class="col-lg-3"><select class="form-control" name="' + name + '_type[]">';
    for (var i = 0; i < types.length; i++) 
        number += '<option value="' + types[i] + '">' + types[i] + '</option>';
    number += '</select></div>';
    number += '<div class="col-lg-9"><div class="input-group" style="margin-bottom: 5px">';
    number += '<input type="text" class="form-control" name="' + name + '_number[]">' + rm_btn + '</div></div></div>';
    return number;
}

function skubbs_add_input(ajax) {
    phas = '<tr class="skubbs_input">' +
            '<td><input type="text" name="phas_date_year[]" class="form-control"></td>' +
            '<td>' +
                '<div class="input-group" style="margin-bottom: 5px">' +
                    '<input type="text" class="form-control" name="phas_detail[]">' + rm_btn +
                '</div>' +
            '</td>' +
        '</tr>';
    family = '<tr class="skubbs_input">' +
            '<td><input type="text" name="family_relative[]" class="form-control"></td>' +
            '<td>' +
                '<div class="input-group" style="margin-bottom: 5px">' +
                    '<input type="text" class="form-control" name="family_desease[]">' + rm_btn +
                '</div>' +
            '</td>' +
        '</tr>';
    switch(ajax.id) {
        case 'phas':
            $('#' + ajax.request).find('tbody#phas').append(phas);
            $('#' + ajax.request).find('tbody#phas>.skubbs_input').show();
        break;
        case 'family':
            $('#' + ajax.request).find('tbody#family').append(family);
            $('#' + ajax.request).find('tbody#family>.skubbs_input').show();
        break;
        case 'contacts':
            contacts = skubbs_add_number(['Mobile', 'Home Phone', 'Home Fax', 'Work', 'Work Fax', 'Other'], 'contacts');
            $('div#contacts').append(contacts);
            $('div#contacts>div.skubbs_input').show();
        break;
        case 'identifications':
            identifications = skubbs_add_number(['Driver License', 'SSS', 'Senior Citizen', 'Passport', 'Company ID', 'HealthCare Pin', 'Employee No.'], 'identifications');
            $('div#identifications').append(identifications);
            $('div#identifications>div.skubbs_input').show();
        break;
    }
}

function ajax_config(e) {
    e.id_patient = parseInt(e.id_patient) || 0;
    e.id_form = parseInt(e.id_form) || 0;
    e.method = (e.method == 'post') ? 'post' : 'get';
    e.data = 'form#data_' + e.request;
    e.loading = 'div#' + e.wrap + '>div.skubbs_loading';
    e.result = 'div#' + e.wrap + '>div.skubbs_result';
    e.target_url = base_url + ['ajax', e.page, e.request, e.action, e.method, e.id_patient, e.id_form, Date.now()].join('/');
    return e;
}

function ajax_patient(e) {
    ajax_config(e);
    $(e.loading).show();
    // console.log(e.result);
    $.ajax({
        url: e.target_url,
        method: e.method,
        data: $(e.data).serialize(), 
        dataType: 'json', 
        success: function(response) {
            $(e.loading).hide();
            $(e.result).html(response.html);

            if (e.onload != '') 
                ajax_patient(skubbs_onload(e));

            if ($('div[id^="wrap-' + e.request + '-"]').length > 0) {
                $('div[id^="wrap-' + e.request + '-"]').each(function() {
                    ajax = {};
                    ajax = skubbs_onload(e);
                    s = this.id.split('-');
                    ajax.wrap = this.id;
                    ajax.request = s[2];
                    ajax.id_form = s[3];
                    ajax_config(ajax);
                    ajax_patient(ajax);
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

$(document).on('focus', '.skubbs_datepicker', function() {
    $(this).datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true, 
        toggleActive: true
    });
});

$(document).on('focus', '.skubbs_timepicker', function() {
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

$(document).on('click', 'a[class*="skubbs_btn-"]', function() {
    act = '';
    wrap = $(this).closest('.skubbs_result').parent().attr('id');
    classes = $(this).attr('class').split(' ');
    $.each(classes, function(i, k){
        if (k.startsWith('skubbs_btn-')) 
            act = k.replace(/^skubbs_btn-/, '');
    });

    switch(act) {
        case 'edit':
            $('#' + wrap).find('a.skubbs_btn-' + act).hide();
            $('#' + wrap).find('a.skubbs_btn-cancel').show();
            $('#' + wrap).find('a.skubbs_btn-save').show();

            $('#' + wrap).find('.skubbs_output').hide();
            $('#' + wrap).find('.skubbs_input').show();
        break;
        case 'cancel':
            $('#' + wrap).find('a.skubbs_btn-edit').show();
            $('#' + wrap).find('a.skubbs_btn-' + act).hide();
            $('#' + wrap).find('a.skubbs_btn-save').hide();

            $('#' + wrap).find('.skubbs_output').show();
            $('#' + wrap).find('.skubbs_input').hide();
        break;
        case 'save':
            skubbs_attr($(this), patient);
            ajax.request = wrap;
            ajax.method = 'post';
            ajax_config(ajax);
            ajax_patient(ajax);
        break;
        case 'add':
            skubbs_attr($(this), patient);
            ajax.request = wrap;
            skubbs_add_input(ajax);
        break;
        case 'remove':
            $(this).closest('.skubbs_input').remove();
        break;
    }
    
    return false;
});

$(document).ready(function() {
    skubbs_vars(patient);
    ajax_patient(patient);
});