<style>.thumbnail{float:left;position:relative;overflow:hidden;width:170px;margin:10px}.caption{position:absolute;top:0;right:0;background:rgba(66,139,202,.75);width:100%;height:100%;padding:2%;display:none;text-align:center;color:#fff!important;z-index:2}</style>
<div class="box-header label-primary">Complete Blood Count</div>
<div class="box-body">
    <?php $index = 0; foreach ($diagrams as $diagram): ?>
    <div class="thumbnail" id="diagram_<?php echo $index ?>">
        <div class="caption">
            <div style="height: 60px"></div>
            <a href="#" data-target="#modal_diagram" data-index="<?php echo $index ?>" class="label label-default cPaint_modal" rel="tooltip" title="Edit">&nbsp;&nbsp;&nbsp;EDIT&nbsp;&nbsp;&nbsp;</a>
            &nbsp;&nbsp;<a href="#" class="label label-danger" rel="tooltip" title="Remove">REMOVE</a>
        </div>
        <img src="<?php echo $diagram['base64'][0] ?>" alt="" width="170" height="170">
    </div>
    <?php $index++;  endforeach; ?>
</div>
<div class="modal fade modal-info" id="modal_diagram"><div class="modal-dialog"><div class="modal-content">
    <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button><h4 class="modal-title">Skubbs Paint</h4></div>
    <div class="modal-body" id="cPaint_wrapper"></div>
    <div class="modal-footer"><button type="button" class="btn btn-outline cPaint_save" data-wrapper="cPaint_wrapper">Save</button><button type="button" class="btn btn-outline" data-dismiss="modal">Cancel</button></div>
</div></div></div>
<script>
var diagrams = <?php echo json_encode($diagrams) ?>;
function cPaintSaveImg(img) {
    console.log(img);
    console.log('Image has been saved');
}
function cPaint(c_opts) {
    var cSelector = (typeof c_opts != 'undefined' && typeof c_opts === 'string') ? c_opts : 'cPaint_wrapper';
    var cPaint = {
        wrapper  : '#' + cSelector,
        canvas   : [cSelector + '_canvas', 'cPaint_canvas'],
        menu     : [cSelector + '_menu', 'cPaint_menu'],
        joiner   : '>#',
        selector : {},
        data     : c_opts,
    };

    cPaint.selector.wrapper_canvas = [cPaint.wrapper, cPaint.canvas[0]].join(cPaint.joiner);
    cPaint.selector.wrapper_menu = [cPaint.wrapper, cPaint.menu[0]].join(cPaint.joiner);
    cPaint.selector.canvas = [cPaint.wrapper, cPaint.canvas.join(cPaint.joiner)].join(cPaint.joiner);
    cPaint.selector.menu = [cPaint.wrapper, cPaint.menu.join(cPaint.joiner)].join(cPaint.joiner);
    if (typeof c_opts != 'undefined' && typeof c_opts === 'string') { return cPaint; };

    $(cPaint.wrapper).html(
        '<div id="' + cPaint.canvas[0] + '"><div id="' + cPaint.canvas[1] + '"></div></div>' + 
        '<div id="' + cPaint.menu[0] + '"><div id="' + cPaint.menu[1] + '"></div></div>'
    ).css({ '-webkit-box-align':'center', '-webkit-box-pack':'center', 'display':'-webkit-box', });
    $(cPaint.selector.wrapper_canvas).css({ 'position' : 'relative', 'width' : '570px', 'height' : '450px' });
    $(cPaint.selector.canvas).css({ 'width' : '568px', 'height' : '370px', 'border' : '1px dashed #fff' });
    
    // c_opts.base64[1]
    
    // $(cPaint.selector.canvas).css('background-image', 'url(' + c_opts.base64[1] + ')');
    $(cPaint.selector.canvas).wPaint({ image: null, bg: c_opts.base64[1], saveImg: cPaintSaveImg, });

    return false;
}

$('.cPaint_modal').click(function() {
    var target = $(this).data('target');
    var index = $(this).data('index');
    var opts = diagrams[index];
        opts.index = index;
        opts.target_modal = target;

    $(target).modal({backdrop: 'static', keyboard: false});
    $(target).find('.cPaint_save').data('index', index);
    cPaint(opts);
    return false;
});

$('.cPaint_save').click(function() {
    var index = $(this).data('index');
    var cDiagram = cPaint($(this).data('wrapper'));
    console.log($(cDiagram.selector.canvas).wPaint('image'));
    console.log($(cDiagram.selector.canvas).wPaint('bg'));
    // var base64_img = $(cDiagram.selector.canvas).wPaint('image');
    // diagrams[index].base64[0] = base64_img;
    // diagrams[index].base64[1] = base64_img;
    // console.log(diagrams[index]);
    // this_diagram.base64[1] = imgData;
    // $('#diagram_' + index + '>img').attr('src', base64_img);
    // console.log(this_diagram.index);
    // $('#modal_diagram').modal('hide');
    return false;
});

$("[rel='tooltip']").tooltip();    
$('.thumbnail').hover(
    function() { $(this).find('.caption').slideDown(250);  },
    function() { $(this).find('.caption').slideUp(250); }
); 
</script>