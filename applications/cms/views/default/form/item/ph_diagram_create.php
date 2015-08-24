<style>.thumbnail{float:left;position:relative;overflow:hidden;width:170px;margin:10px}.caption{position:absolute;top:0;right:0;background:rgba(66,139,202,.75);width:100%;height:100%;padding:2%;display:none;text-align:center;color:#fff!important;z-index:2}</style>
<style>
#cPaint_menu li {
    background-color: #fff;
    float: left;
    list-style: none;
    text-align: center;
    margin-right: 5px;
    width: 30px;
    line-height: 25px;
    border: 1px solid #9a9a9a;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;

}
#cPaint_menu li:hover {
    border: 1px solid #f00;
}
#cPaint_menu li a {
    text-decoration: none;
    color: #000;
    display: block;
}
#cPaint_menu li a:hover {
    background-color: #fff;
}
</style>
<div class="box-header label-primary">Complete Blood Count</div>
<div class="box-body" id="diagram_wrapper">
    <div><a href="#" class="btn btn-primary btn-xs" id="fileupload">Upload</a></div>
    <?php foreach ($diagrams as $diagram): ?>
    <div class="thumbnail" id="diagram_<?php echo $diagram['index'] ?>">
        <div class="caption">
            <div style="height: 60px"></div>
            <a href="#" data-target="#modal_paint" data-index="<?php echo $diagram['index'] ?>" class="label label-default cPaint_modal" rel="tooltip" title="Edit">&nbsp;&nbsp;&nbsp;EDIT&nbsp;&nbsp;&nbsp;</a>
            &nbsp;&nbsp;<a href="#" class="label label-danger diagram_remove" data-index="<?php echo $diagram['index'] ?>" rel="tooltip" title="Remove">REMOVE</a>
        </div>
        <img src="<?php echo $this->model_image->base64Resize($diagram['bg'], 170, 170) ?>" alt="" width="170" height="170">
        <input type="hidden" name="bg[<?php echo $diagram['index'] ?>]" value="<?php echo $diagram['bg'] ?>">
        <input type="hidden" name="canvas[<?php echo $diagram['index'] ?>]" value="">
    </div>
    <?php endforeach ?>
    
</div>
<div class="modal fade modal-info" id="cPaint_modal">
    <div class="modal-dialog">
        <div class="modal-content" id="cPaint_wrapper">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Skubbs Paint</h4>
            </div>
            <div class="modal-body" id="cPaint_canvas_wrapper"></div>
            <div class="modal-body" id="cPaint_menu_wrapper">
                <div id="cPaint_menu_holder">
                    <ul id="cPaint_menu">
                        <li><a href="#">a</a></li>
                        <li><a href="#">a</a></li>
                        <li><a href="#">a</a></li>
                        <li><a href="#">a</a></li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline cPaint_save">Save</button>
                <button type="button" class="btn btn-outline" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-info" id="fileupload_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="#" id="fileupload_form">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Skubbs Image Uploader</h4>
            </div>
            <div class="modal-body">
                
                    <input type="file" id="fileupload_file" name="test_file" class="form-control">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline fileupload_submit">Upload</button>
                <button type="button" class="btn btn-outline" data-dismiss="modal">Cancel</button>
            </div>
            </form>
        </div>
    </div>
</div>


<script>
var diagrams = <?php echo json_encode($diagrams) ?>;
$(document).on("mouseover", ".thumbnail", function(e) {
    $(this).find('.caption').slideDown(250);
    return false;
});

$(document).on("mouseleave", ".thumbnail", function(e) {
    $(this).find('.caption').slideUp(250);
    return false;
});
var _cPaint = {
    selector: {},
    id: {
        modal_wrapper: 'cPaint_wrapper', 
        canvas_wrapper: 'cPaint_canvas_wrapper', 
        canvas_holder: 'cPaint_canvas_holder',
        menu_wrapper: 'cPaint_menu_wrapper',  
        canvas: 'cPaint_canvas', 
        menu: 'cPaint_menu', 
    },
};

$(document).on('click', 'a.diagram_remove', function() {
    var index = $(this).data('index');
    delete diagrams[index];
    $(this).closest('#diagram_' + index).remove();
    console.log(diagrams[index]);
    return false;
});

function cPaint(c_opts) {
    // canvas
    _cPaint.selector.modal_wrapper = '#' + _cPaint.id.modal_wrapper;
    _cPaint.selector.canvas_wrapper = _cPaint.selector.modal_wrapper + '>#' + _cPaint.id.canvas_wrapper;
    _cPaint.selector.canvas_holder = _cPaint.selector.canvas_wrapper + '>#' + _cPaint.id.canvas_holder;
    _cPaint.selector.canvas = _cPaint.selector.canvas_holder + '>#' + _cPaint.id.canvas;

    var wrapper_style = { '-webkit-box-align' : 'center', '-webkit-box-pack' : 'center', 'display' : '-webkit-box', };
    var holder_style = { 'position' : 'relative', 'width' : '570px', 'height' : '370px', 'background-image' : 'url("' + c_opts.bg + '")', };
    var canvas_style = { 'width' : '570px', 'height' : '370px' };
    var canvas_wrapper = '#cPaint_wrapper>#cPaint_canvas_wrapper';

    $(_cPaint.selector.canvas_wrapper).html('<div id="' + _cPaint.id.canvas_holder + '"><div id="' + _cPaint.id.canvas + '"></div></div>')
    $(_cPaint.selector.canvas_wrapper).css(wrapper_style);
    $(_cPaint.selector.canvas_holder).css(holder_style);
    $(_cPaint.selector.canvas).css(canvas_style).wPaint({ image: ((c_opts.canvas) ? c_opts.canvas : null) });

    // Menu
    _cPaint.selector.menu_wrapper = _cPaint.selector.modal_wrapper + '>#' + _cPaint.id.menu_wrapper;
    _cPaint.selector.menu_holder = _cPaint.selector.menu_wrapper + '>#' + _cPaint.id.menu_holder;
    _cPaint.selector.menu = _cPaint.selector.menu_holder + '>#' + _cPaint.id.menu;
    $(_cPaint.selector.menu_wrapper).css(wrapper_style);
}
$(document).on('click', '.cPaint_modal', function() {
    var index = $(this).data('index');
    if (!diagrams[index]) {
        console.log('diagram[' + index + '] doesnt exist');
        return false;
    };

    cPaint(diagrams[index]);
    $('#cPaint_modal').modal({backdrop: 'static', keyboard: false});
    $('#cPaint_modal').find('.cPaint_save').data('index', index);
    return false;
});
$('.cPaint_save').click(function() {
    var index = $(this).data('index');
    var data2save = diagrams[index];
    data2save.canvas = $(_cPaint.selector.canvas).wPaint('image');
    $('#diagram_' + index + '>input[name="canvas[' + index + ']"]').val(data2save.canvas);
    $.ajax({
        url: base_url + 'ajax/merge_img_resize',
        method: 'post',
        data: {bg: data2save.bg, canvas: data2save.canvas, width: 170, height: 170}, 
        dataType: 'json', 
        success: function(response) {
            $('#diagram_wrapper>#diagram_' + index + '>img').attr('src', response.thumb);
            diagrams[index] = data2save;
            $('#cPaint_modal').modal('toggle');
        }, 
        complete: function(xhr, textStatus) {
            $(ajax.loading).hide();
            if (xhr.status != 200) 
                console.log('error???');
        }
    });
    return false;
});

$('#fileupload').click(function() {
    $('#fileupload_file').val('');
    $('#fileupload_modal').modal();
    return false;
});
function uploadFiles() {
    var fileupload_file = $('#fileupload_file')[0].files[0];
    if (typeof fileupload_file == 'undefined') 
        return false;

    if (!window.FileReader) 
        return console.log('browser doesnt support FileReader.');
    
    reader = new FileReader();
    reader.readAsDataURL(fileupload_file);

    if (!window.FormData) 
        return console.log('browser doesnt support FormData.');

    formdata = new FormData();
    formdata.append("image", fileupload_file);


    $.ajax({
        url: '<?php echo base_url() ?>ajax/upload_img',
        type: "POST",
        cache: false,
        data: formdata,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function (res) {
            var d_index = diagrams.length;
            diagrams[d_index] = {bg: res.bg, thumb: res.thumb, index: d_index};
            $('#diagram_wrapper').append(
            '<div class="thumbnail" id="diagram_' + d_index + '">'+
                '<div class="caption">'+
                    '<div style="height: 60px"></div>'+
                    '<a href="#" data-target="#modal_paint" data-index="' + d_index + '" class="label label-default cPaint_modal" rel="tooltip" title="Edit">&nbsp;&nbsp;&nbsp;EDIT&nbsp;&nbsp;&nbsp;</a>'+
                    '&nbsp;&nbsp;<a href="#" class="label label-danger diagram_remove" data-index="' + d_index + '" rel="tooltip" title="Remove">REMOVE</a>'+
                '</div>'+
                '<img src="' + res.thumb + '" alt="" width="170" height="170">'+
                '<input type="hidden" name="bg[' + d_index + ']" value="' + res.bg + '">'+
                '<input type="hidden" name="canvas[' + d_index + ']" value="">'+
            '</div>');
            $('#fileupload_modal').modal('toggle');
        }
    });

    return false;
}
$('.fileupload_submit').on('click', function() {
    uploadFiles();
    return false;
});
</script>