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
        },
		init: function() {
            if ($('#patient>span[id^="var-"]').length) {
                $('#patient>span[id^="var-"]').each(function() {
                    opt_key = $(this).attr('id').replace(/^var-/, '').replace('-', '_');
                    moo.patient[opt_key] = $(this).text();
                });
            };

            moo.patient_config();
        },
        patient_config: function() {
            var p = moo.patient;
            p.id_patient = parseInt(p.id_patient) || 0;
            p.id_form = parseInt(p.id_form) || 0;
            p.method = (p.method == 'post') ? 'post' : 'get';
            p.data = 'form#data_' + p.request;
            p.loading = 'div#' + p.wrap + '>div.skubbs_loading';
            p.result = 'div#' + p.wrap + '>div.skubbs_result';
            p.target_url = base_url + ['ajax', p.page, p.request, p.action, p.method, p.id_patient, p.id_form, Date.now()].join('/');
        }, 
        patient_attr: function(el, ret) {
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
            
            $.extend(moo.patient, opts)
            return (typeof ret != 'undefined') ? opts : moo.patient;
        }, 
        ajax: function() {
            moo.patient_attr($(this));
            moo.patient_config();

            $(moo.patient.loading).show();
            $.ajax({
                url: moo.patient.target_url,
                method: moo.patient.method,
                data: $(moo.patient.data).serialize(), 
                dataType: 'json', 
                success: function(response) {
                    $(moo.patient.loading).hide();
                    $(moo.patient.result).html(response.html);

                    if (moo.patient.onload != '') {
                        o_wrap = moo.patient.request;
                        o_request = moo.patient.onload;
                        moo.init(); // reset patient config
                        moo.patient.wrap = o_wrap;
                        moo.patient.request = o_request;
                        moo.patient_config();
                        moo.ajax();
                    }

                    return false;
                }, 
                complete: function(xhr, textStatus) {
                    $(moo.patient.loading).hide();
                    if (xhr.status != 200) 
                        $(moo.patient.result).html('<div class="text-center alert alert-danger"><h4>ERROR ' + xhr.status + '</h4>' + xhr.statusText + '</div>');
                    
                    return false;
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
			o.hide = ['a.skubbs_btn-edit', '.skubbs_output'];
			o.show = ['a.skubbs_btn-cancel', 'a.skubbs_btn-save', '.skubbs_input'];
			$(this).skubbs('showHideList', o);
		}, 
		btn_cancel: function(o) {
			o.hide = ['a.skubbs_btn-cancel', 'a.skubbs_btn-save', '.skubbs_input'];
			o.show = ['a.skubbs_btn-edit', '.skubbs_output'];
			$(this).skubbs('showHideList', o);
		}, 
		btn_save: function(o) {
		}, 
		btn_create: function(o) {
			$(this).closest('.open').removeClass('open');
		}, 
		btn_add: function(o) {
			
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
            $.error('Method ' +  oom + ' does not exist on jQuery.skubbs');
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