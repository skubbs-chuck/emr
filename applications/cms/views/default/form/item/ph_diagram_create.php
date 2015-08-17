<div class="box-header label-primary">Complete Blood Count</div>
<style>
.thumbnail {
    float: left;
    position:relative;
    overflow:hidden;
    width: 170px;
    margin: 10px;
}
.caption {
    position:absolute;
    top:0;
    right:0;
    background:rgba(66, 139, 202, 0.75);
    width:100%;
    height:100%;
    padding:2%;
    display: none;
    text-align:center;
    color:#fff !important;
    z-index:2;
}
</style>
<div class="box-body">
<script>
    var diagrams = <?php echo json_encode($diagrams) ?>;
</script>
    <?php $counter = 0; ?>
    <?php foreach ($diagrams as $diagram): ?>
    <div class="thumbnail">
        <div class="caption">
            <div style="height: 60px"></div>
            <a href="#" data-toggle="modal" data-target="#modal_diagram" data-img-counter="<?php echo $counter ?>" class="label label-default modal-luncher" rel="tooltip" title="Edit">&nbsp;&nbsp;&nbsp;EDIT&nbsp;&nbsp;&nbsp;</a>
            &nbsp;&nbsp;
            <a href="#" class="label label-danger" rel="tooltip" title="Remove">REMOVE</a>
        </div>
        <img src="<?php echo $diagram['base64'][0] ?>" alt="" width="170" height="170">
    </div>
    <?php $counter++; ?>
    <?php endforeach ?>
</div>
<script>
$("[rel='tooltip']").tooltip();    
$('.thumbnail').hover(
    function() { $(this).find('.caption').slideDown(250);  },
    function() { $(this).find('.caption').slideUp(250); }
); 
$('.modal-luncher').click(function() {
    var counter_id = $(this).data('img-counter');
    var diagram = diagrams[counter_id];
    $('#modal_diagram_img').attr('src', diagram.base64[1]);
});
</script>

<div class="modal fade modal-info" id="modal_diagram">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Skubbs Paint</h4>
            </div>
            <div class="modal-body">
                <p>Paint Menu Here</p>
                <p><img src="" alt="" id="modal_diagram_img"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline">Save</button>
                <button type="button" class="btn btn-outline" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>