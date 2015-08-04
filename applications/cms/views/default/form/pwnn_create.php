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
                <label for="id_clinic">Clinic:</label>
                <?php echo form_dropdown('id_clinic', $atn['clinics'], $atn['data']->id_clinic, 'id="id-clinic" class="mh-input form-control"'); ?>
            </li>
            <li class="item">
                <div class="bootstrap-timepicker">
                    <div class="form-group">
                        <label>Time picker:</label>
                        <div class="input-group">
                            <?php echo form_input(array('name' => 'visit_date', 'value' => ($this->input->post('visit_date') ? $this->input->post('visit_date') : date("Y-m-d")), 'id' => 'visit_date', 'class' => 'form-control skubbs_datepicker', 'data-inputmask' => "'alias': 'dd/mm/yyyy'", 'data-mask' => '')) ?>
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="item">
                <div class="bootstrap-timepicker">
                    <div class="form-group">
                        <label>Time picker:</label>
                        <div class="input-group">
                            <?php echo form_input(array('name' => 'start_time', 'value' => ($this->input->post('start_time') ? $this->input->post('start_time') : date('h:i A')), 'id' => 'visit_date', 'class' => 'form-control skubbs_timepicker')) ?>
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="item">
                <strong>Focus: </strong>
                <div>
                    <textarea name="order_note" id="order_note" class="form-control atn-input" rows="3"><?php echo $atn['data']->order_note ?></textarea>
                </div>
            </li>
            <li class="item">
                <strong>Data: </strong>
                <div>
                    <textarea name="order_note" id="order_note" class="form-control atn-input" rows="3"><?php echo $atn['data']->order_note ?></textarea>
                </div>
            </li>
            <li class="item">
                <strong>Action: </strong>
                <div>
                    <textarea name="order_note" id="order_note" class="form-control atn-input" rows="3"><?php echo $atn['data']->order_note ?></textarea>
                </div>
            </li>
            <li class="item">
                <strong>Recommendation: </strong>
                <div>
                    <textarea name="order_note" id="order_note" class="form-control atn-input" rows="3"><?php echo $atn['data']->order_note ?></textarea>
                </div>
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