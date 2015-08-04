<div class="box-body no-margin" id="atn-results">
    <form action="#" method="post" id="atn-form">
        <ul class="products-list product-list-in-box margin">
            <li class="item" id="atn-message">
                <?php if (isset($atn['var']['message'])): ?>
                    <div class="alert alert-<?php echo $atn['var']['message_type'] ?>"><?php echo $atn['var']['message'] ?></div>
                <?php endif ?>
            </li>
            <li class="item">
                <div class="btn-group pull-right">
                    <button class="btn btn-primary atn-save">Save</button>
                    <button class="btn atn-cancel">Cancel</button>
                </div>
            </li>
            <li class="item">
                <div class="bootstrap-timepicker">
                    <div class="form-group">
                        <label>Specimen No:</label>
                           <?php echo form_input(array('name' => 'visit_date', 'value' => $this->input->post('visit_date'), 'id' => 'visit_date', 'class' => 'form-control')) ?>
                    </div>
                </div>
            </li>
            <li class="item">
                <strong>Examination: </strong>
                <div>
                    <textarea name="order_note" id="order_note" class="form-control atn-input" rows="3"><?php echo $atn['data']->order_note ?></textarea>
                </div>
            </li>
            <li class="item">
                <strong>History: </strong>
                <div>
                    <textarea name="order_note" id="order_note" class="form-control atn-input" rows="3"><?php echo $atn['data']->order_note ?></textarea>
                </div>
            </li>
            <li class="item">
                <strong>Comparison: </strong>
                <div>
                    <textarea name="order_note" id="order_note" class="form-control atn-input" rows="3"><?php echo $atn['data']->order_note ?></textarea>
                </div>
            </li>
            <li class="item">
                <strong>Technique: </strong>
                <div>
                    <textarea name="order_note" id="order_note" class="form-control atn-input" rows="3"><?php echo $atn['data']->order_note ?></textarea>
                </div>
            </li>
            <li class="item">
                <strong>Findings: </strong>
                <div>
                    <textarea name="order_note" id="order_note" class="form-control atn-input" rows="3"><?php echo $atn['data']->order_note ?></textarea>
                </div>
            </li>
            <li class="item">
                <strong>Impression: </strong>
                <div>
                    <textarea name="order_note" id="order_note" class="form-control atn-input" rows="3"><?php echo $atn['data']->order_note ?></textarea>
                </div>
            </li>
            <li class="item">
                <label for="id_clinic">Radiologist:</label>
                <?php echo form_dropdown('id_clinic', $atn['clinics'], $atn['data']->id_clinic, 'id="id-clinic" class="mh-input form-control"'); ?>
            </li>
            <li class="item">
                <div class="btn-group pull-right">
                    <button class="btn btn-primary atn-save">Save</button>
                    <button class="btn atn-cancel">Cancel</button>
                </div>
            </li>
        </ul>
    </form>
</div>