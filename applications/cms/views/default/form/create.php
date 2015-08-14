<?php if ($this_form['alert']['type']): ?>
    <div class="alert alert-<?php echo $this_form['alert']['type'] ?>"><?php echo $this_form['alert']['message'] ?></div>
    <script>
    setTimeout(function() {
        $('#notes>div>ul>li.active>a.skubbs_ajax').click();
    }, 3000);
    </script>
<?php else: ?><form action="#" method="post" id="data_<?php echo $ar['request'] ?>">
    <ul class="products-list product-list-in-box margin">
        <li class="item">
            <div class="btn-group pull-right">
                <button class="btn btn-primary skubbs_ajax" s-method="post" s-wrap="<?php echo $ar['wrap'] ?>" s-action="create" s-request="<?php echo $ar['request'] ?>">Submit</button>
                <button class="btn skubbs_ajax" s-wrap="notes" s-request="<?php echo $ar['wrap'] ?>">Cancel</button>
            </div>
        </li>
        <?php foreach ($this_form['items'] as $item): ?>
        <li class="item <?php echo $item['class'] ?>">
            <?php if ($item['group']): ?>
            <div><label><?php echo $item['label'] ?></label></div>
            <div class="form-group">
                <div class="input-group">
                    <?php echo $item['input'] ?>
                    <?php if ($item['fa']): ?> 
                    <div class="input-group-addon"><i class="fa <?php echo $item['fa'] ?>"></i></div>
                    <?php endif ?>
                </div>
            </div>
            <?php elseif ($item['incl']): ?>
                <?php include_once __DIR__ . DS . 'item/' . $item['incl'] . '_create.php'; ?>
            <?php else: ?>
            <div><label><?php echo $item['label'] ?></label></div>
            <?php echo $item['input'] ?>
            <?php endif ?>
        </li>
        <?php endforeach ?>
        <li class="item">
            <div class="btn-group pull-right">
                <button class="btn btn-primary skubbs_ajax" s-method="post" s-wrap="<?php echo $ar['wrap'] ?>" s-action="create" s-request="<?php echo $ar['request'] ?>">Submit</button>
                <button class="btn skubbs_ajax" s-wrap="notes" s-request="<?php echo $ar['wrap'] ?>">Cancel</button>
            </div>
        </li>
    </ul>
</form>
<?php endif; ?>