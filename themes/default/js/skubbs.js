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
            p.target_url = base_url + ['ajax', p.page, p.request, p.action, p.method, p.id_patient, p.id_form, Date.now()].join('/');
        }, 
        skubbs_attr: function(el) {
            var opts = {};
            if (typeof el == 'object') {
                el.each(function(){
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

            $.each(moo.patient, function(opt_key, opt_value){
                if (typeof opts[opt_key] == 'undefined')
                    opts[opt_key] = opt_value;
            });

            return opts;
        }, 
        ajax: function(el) {
            ajax = (typeof el != 'undefined') ? el : moo.skubbs_attr($(this));
            moo.patient_config(ajax);
            console.log(ajax);

            // if ($(this).attr('s-loaded')) { return false; };
            $(ajax.loading).show();
            $.ajax({
                url: ajax.target_url,
                method: ajax.method,
                data: $(ajax.data).serialize(), 
                dataType: 'json', 
                success: function(response) {
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
            }
        }, 
        btn_remove: function(o) {
            $(this).closest('.skubbs_input').remove();
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
    }
})(jQuery);

$(document).on('click', 'a[class*="skubbs_btn-"]', function() { $(this).skubbs('btn'); return false; });
$(document).on('click', '.skubbs_ajax', function() { $(this).skubbs('ajax'); return false; });
$(document).ready(function() { $(this).skubbs('ajax'); });
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