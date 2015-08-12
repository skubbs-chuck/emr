<form action="#" method="post" id="data_<?php echo $ar['request'] ?>">
    <ul class="products-list product-list-in-box margin">
        <?php if ($this_form['alert']['type']): ?>
        <li class="item">
            <div class="alert alert-<?php echo $this_form['alert']['type'] ?>"><?php echo $this_form['alert']['message'] ?></div>
        </li>
        <?php endif ?>
        <li class="item">
            <div class="btn-group pull-right skubbs-e">
                <a href="#" class="btn btn-info skubbs_btn-edit">Edit</a>
            </div>
            <div class="btn-group pull-right skubbs-sc" style="display:none">
                <a href="#" class="btn btn-primary skubbs_btn-save" s-method="post" s-wrap="wrap-<?php echo $ar['request'] ?>-<?php echo $this_form['name'] ?>-<?php echo $ar['id_form'] ?>" s-id-form="<?php echo $ar['id_form'] ?>" s-id-patient="<?php echo $ar['id_patient'] ?>" s-request="<?php echo $this_form['name'] ?>">Save</a>
                <a href="#" class="btn btn-default skubbs_btn-cancel">Cancel</a>
            </div>
        </li>
        <?php foreach ($this_form['items'] as $item): ?>
        <li class="item <?php echo $item['class'] ?>">
            <label><?php echo $item['label'] ?></label>
            <span class="skubbs_output"><?php echo $item['output'] ?></span>
            <?php if ($item['group']): ?>
            <div class="form-group skubbs_input">
                <div class="input-group">
                    <?php echo $item['input'] ?>
                    <?php if ($item['fa']): ?> 
                    <div class="input-group-addon"><i class="fa <?php echo $item['fa'] ?>"></i></div>
                    <?php endif ?>
                </div>
            </div>
            <?php else: ?>
            <span class="skubbs_input"><?php echo $item['input'] ?></span>
            <?php endif ?>
        </li>
        <?php endforeach ?>
        <li class="item">
            <div class="btn-group pull-right skubbs-e">
                <a href="#" class="btn btn-info skubbs_btn-edit">Edit</a>
            </div>
            <div class="btn-group pull-right skubbs-sc" style="display:none">
                <a href="#" class="btn btn-primary skubbs_btn-save" s-method="post" s-wrap="wrap-<?php echo $ar['request'] ?>-<?php echo $this_form['name'] ?>-<?php echo $id_form ?>" s-id-form="<?php echo $id_form ?>" s-id-patient="<?php echo $id_patient ?>" s-request="<?php echo $this_form['name'] ?>">Save</a>
                <a href="#" class="btn btn-default skubbs_btn-cancel">Cancel</a>
            </div>
        </li>
    </ul>
</form>