<div id="diagnostic_study" class="box no-border">
    <div class="box-body">
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                Create <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu scrollable-menu" data-toggle="dropdown" role="menu">
                <?php foreach ($diagnostic_study['form_list'] as $form): ?>
                    <li><a href="#" class="skubbs_ajax" s-wrap="diagnostic_study" s-request="<?php echo $form->table_name ?>" s-action="create"><?php echo $form->name ?></a></li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
    <div class="box no-border flat skubbs_result">
        <div class="panel-group" id="accordion">
        <?php if ($diagnostic_study['forms']): ?>
        <?php foreach ($diagnostic_study['forms'] as $form): $id = 'id_' . $form->tbl; ?>
            <?php $wrap = $form->tbl . '-' . $form->$id ?>
            <div id="wrap-diagnostic_study-<?php echo $wrap ?>" class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#accordion" href="#diagnostic_study-<?php echo $wrap ?>">
                        <h4 class="panel-title">
                            <?php echo $form->tbl_name ?>
                            <span class="pull-right"><small><?php echo date('M-d-Y', strtotime($form->creation_date)) ?></small></span>
                        </h4>
                    </a>
                </div>
                <div id="diagnostic_study-<?php echo $wrap ?>" class="panel-collapse collapse skubbs_result"></div>
                <div class="overlay skubbs_loading"><i class="fa fa-refresh fa-spin"></i></div>
            </div>
        <?php endforeach ?>
        <?php else: ?>
            <div class="panel panel-default">
                <div class="alert alert-warning text-center">No results found.</div>
            </div>
        <?php endif ?>
        </div>
    </div>
    <div class="overlay skubbs_loading"><i class="fa fa-refresh fa-spin"></i></div>
</div>