var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e) {var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length) {n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)) {u=a=64}else if(isNaN(i)) {a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e) {var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9\+\/\=]/g,"");while(f<e.length) {s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64) {t=t+String.fromCharCode(r)}if(a!=64) {t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e) {e=e.replace(/\r\n/g,"\n");var t="";for(var n=0;n<e.length;n++) {var r=e.charCodeAt(n);if(r<128) {t+=String.fromCharCode(r)}else if(r>127&&r<2048) {t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e) {var t="";var n=0;var r=c1=c2=0;while(n<e.length) {r=e.charCodeAt(n);if(r<128) {t+=String.fromCharCode(r);n++}else if(r>191&&r<224) {c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}};
(function($) {
    var moo = {
        patient: {
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
            is_loaded  : false,
        }, 
        ci_types: {
            contacts: ['Mobile', 'Home Phone', 'Home Fax', 'Work', 'Work Fax', 'Other'], 
            identifications: ['Driver License', 'SSS', 'Senior Citizen', 'Passport', 'Company ID', 'HealthCare Pin', 'Employee No.'],
        },
        init: function() {
            moo.patient_vars();
            moo.patient_config();
        },
        patient_vars: function(el) {
            var opts = (typeof el != 'undefined') ? el : moo.patient;

            if ($('#patient>span[id^="var-"]').length) {
                $('#patient>span[id^="var-"]').each(function() {
                    opt_key = $(this).attr('id').replace(/^var-/, '').replace('-', '_');
                    opts[opt_key] = $(this).text();
                });
            };

            return opts;
        },
        patient_config: function(el) {
            var p = (typeof el != 'undefined') ? el : moo.patient;
            p.id_patient = parseInt(p.id_patient) || 0;
            p.id_form = parseInt(p.id_form) || 0;
            p.method = (p.method == 'post') ? 'post' : 'get';
            p.data = 'form#data_' + p.request;
            p.loading = 'div#' + p.wrap + '>div.skubbs_loading';
            p.result = 'div#' + p.wrap + '>div.skubbs_result';
            p.target_url = base_url + ['ajax', p.page].join('/');
        }, 
        skubbs_attr: function(el) {
            var opts = {};
            if (typeof el == 'object') {
                el.each(function() {
                    if (this.attributes) {
                        $.each(this.attributes, function(i, attr) {
                            if (attr.name.startsWith('s-')) {
                                opt_key = attr.name.replace(/^s-/, '').replace('-', '_');
                                opts[opt_key] = attr.value;
                            };
                        });
                    };
                });
            };

            $.each(moo.patient, function(opt_key, opt_value) {
                if (typeof opts[opt_key] == 'undefined')
                    opts[opt_key] = opt_value;
            });

            return opts;
        }, 
        showHideList: function(o) {
            $.each(o.hide, function(i,k) { $('#' + o.wrap).find(k).hide(); });
            $.each(o.show, function(i,k) { $('#' + o.wrap).find(k).show(); });
        }, 
        btn: function() {
            var o = {
                act: '', 
                wrap: $(this).closest('.skubbs_result').parent().attr('id'),
            };
            $.each($(this).attr('class').split(' '), function(i,k) {
                if (k.startsWith('skubbs_btn-')) 
                    o.act = k.replace(/^skubbs_btn-/, '');
            });
            $(this).skubbs('btn_' + o.act, o);
        },
        btn_edit: function(o) {
            o.hide = ['div.skubbs-e', '.skubbs_output'];
            o.show = ['div.skubbs-sc', '.skubbs_input'];
            $(this).skubbs('showHideList', o);
        }, 
        btn_cancel: function(o) {
            o.hide = ['div.skubbs-sc', '.skubbs_input'];
            o.show = ['div.skubbs-e', '.skubbs_output'];
            
            $(this).skubbs('showHideList', o);
        }, 
        btn_save: function(o) {
            $(this).skubbs('ajax');
        }, 
        btn_create: function(o) {
            $(this).closest('.open').removeClass('open');
        }, 
        app_inp_pf: function(o) {
            if (typeof o.names == 'undefined') {
                console.log('names are not defined.');
                return false;
            };

            o.names = o.names.split(',');
            inp = '<tr class="skubbs_input">' +
                '<td><input type="text" name="' + o.id + '_' + o.names[0] +'[]" class="form-control"></td>' +
                '<td>' +
                    '<div class="input-group" style="margin-bottom: 5px">' +
                        '<input type="text" class="form-control" name="' + o.id + '_' + o.names[1] +'[]">' + 
                        '<a href="#" class="input-group-addon skubbs_btn-remove btn btn-danger"><i class="fa fa-remove "></i></a>' +
                    '</div>' +
                '</td>' +
            '</tr>';
            $('#' + o.request).find('tbody#pf_' + o.id).append(inp);
            $('#' + o.request).find('tbody#pf_' + o.id + '>.skubbs_input').show();
        }, 
        app_inp_ci: function(o) {
            var types = moo.ci_types[o.id];
            inp = '<div class="row skubbs_input"><div class="col-lg-3"><select class="form-control" name="' + o.id + '_type[]">';
            for (var i = 0; i < types.length; i++) 
                inp += '<option value="' + types[i] + '">' + types[i] + '</option>';
            inp += '</select></div>';
            inp += '<div class="col-lg-9"><div class="input-group" style="margin-bottom: 5px">';
            inp += '<input type="text" class="form-control" name="' + o.id + '_number[]">' + 
                    '<a href="#" class="input-group-addon skubbs_btn-remove btn btn-danger"><i class="fa fa-remove "></i></a>' + 
                    '</div></div></div>';
            $('div#ci_' + o.id).append(inp);
            $('div#ci_' + o.id + '>div.skubbs_input').show();
        }, 
        app_inp_ndp: function(o) {
            inp = '<tr class="skubbs_input" style="display: table-row;">' +
                '<td>' +
                    '<label>Nursing Diagnosis</label>' +
                    '<input type="text" name="' + o.id + '_diagnosis[]" class="form-control">' +
                    '<label>Plan</label>' +
                    '<div class="input-group" style="margin-bottom: 5px">' +
                        '<textarea name="' + o.id + '_plan[]" class="form-control" rows="3"></textarea>' +
                        '<a class="input-group-addon skubbs_btn-remove btn btn-danger"><i class="fa fa-remove "></i></a>' +
                    '</div>' +
                '</td>' +
            '</tr>';
            $('#assessment_' + o.id).append(inp);
            $('#assessment_' + o.id + '>div.skubbs_input').show();
        },
        app_inp_doc: function(o) {
            inp = '<tr class="skubbs_input" style="display: table-row;">' +
                '<td>' +
                    '<div class="input-group" style="margin-bottom: 5px">' +
                    '<input type="text" name="mc1_' + o.id + '[]" class="form-control">' +
                    '<a class="input-group-addon skubbs_btn-remove btn btn-danger"><i class="fa fa-remove "></i></a>' +
                    '</div>' +
                '</td>' +
            '</tr>';
            $('#mc1_' + o.id).append(inp);
            $('#mc1_' + o.id + '>div.skubbs_input').show();
        },
        btn_add: function(o) {
            o = $.extend(o, moo.skubbs_attr($(this)));
            switch(o.id) {
                case 'phas':
                case 'family':
                    moo.app_inp_pf(o);
                break;
                case 'contacts':
                case 'identifications':
                    moo.app_inp_ci(o);
                break;
                case 'ndp': // Assessment [Nursing Diagnosis, Plan]
                    moo.app_inp_ndp(o);
                break;
                case 'doc': // Defects or Conditions
                    moo.app_inp_doc(o);
                break;
            }
        }, 
        btn_remove: function(o) {
            $(this).closest('.skubbs_input').remove();
        }, 
        ajax: function(el) {
            ajax = (typeof el != 'undefined') ? el : moo.skubbs_attr($(this));
            moo.patient_config(ajax);
            $(ajax.loading).show();
            var ajax_request = Base64.encode(JSON.stringify(ajax));
            $.ajax({
                url: ajax.target_url + '?ajax_request=' + ajax_request,
                method: ajax.method,
                data: (ajax.method == 'get') ? {} : $(ajax.data).serialize(), 
                dataType: 'json', 
                success: function(response) {
                    if (!$(ajax.result).length) {
                        console.log(ajax.result + ' does not exist');
                    };
                    $(ajax.loading).hide();
                    $(ajax.result).html(response.html);

                    if (ajax.onload != '') {
                        o_wrap = ajax.request;
                        o_request = ajax.onload;
                        moo.init(); // reset patient config
                        ajax.wrap = o_wrap;
                        ajax.request = o_request;
                        ajax.onload = '';
                        moo.patient_config(ajax);
                        moo.ajax(ajax);
                    };
                }, 
                complete: function(xhr, textStatus) {
                    $(ajax.loading).hide();
                    if (xhr.status != 200) 
                        $(ajax.result).html('<div class="text-center alert alert-danger"><h4>ERROR ' + xhr.status + '</h4>' + xhr.statusText + '</div>');
                }
            });
        }, 
    };

    $.fn.skubbs = function(oom) {

        moo.init();
        if (moo[oom]) {
            return moo[oom].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof oom === 'object' || ! oom) {
            // Default to "init"
            return moo.init.apply(this, arguments);
        } else {
            // $.error('Method ' +  oom + ' does not exist on jQuery.skubbs');
            console.log('Method \'' +  oom + '\' does not exist on jQuery.skubbs');
        }
    };

    $.urlParam = function(name) {
        var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(window.location.href);
        return (results != null && results[1] != '') ? results[1] : 0;
    };
})(jQuery);
$(document).on('change', 'select[name="pathologist"]', function() {
    ($(this).val() == 0) ? $('input[name="pathologist_other"]').show() : $('input[name="pathologist_other"]').hide();
});
$(document).on('change', 'select[name="radiologist"]', function() {
    ($(this).val() == 0) ? $('input[name="radiologist_other"]').show() : $('input[name="radiologist_other"]').hide();
});
$(document).on('change', 'select[name="doctor"]', function() {
    ($(this).val() == 0) ? $('input[name="doctor_other"]').show() : $('input[name="doctor_other"]').hide();
});
$(document).on('change', '.skubbs-mc2-di', function() {
    if ($(this).val() == 1) {
        $('input[name="inclusive_on"]').show();
        $('input[name="inclusive_range_from"]').hide();
        $('input[name="inclusive_range_to"]').hide();
    } else if ($(this).val() == 2) {
        $('input[name="inclusive_on"]').hide();
        $('input[name="inclusive_range_from"]').show();
        $('input[name="inclusive_range_to"]').show();
    } else {
        $('input[name="inclusive_on"]').hide();
        $('input[name="inclusive_range_from"]').hide();
        $('input[name="inclusive_range_to"]').hide();
    };
});
$(document).on('click', 'a[class*="skubbs_btn-"]', function() { $(this).skubbs('btn'); return false; });
$(document).on('click', '.skubbs_ajax', function() { $(this).skubbs('ajax'); return false; });
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
$(document).on('change', '.patient_now', function() {
    $('div[id^="patient_now_"]').hide();
    $('#patient_now_' + $(this).val()).show();
});
$(document).ready(function() { 
    $(this).skubbs('ajax'); 
});