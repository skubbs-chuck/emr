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
                <div class="box-body label-primary">Macroscopic/Chemical Examination Test Components <small>(Unit)</small></div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon" style="min-width: 170px; text-align:left"><strong>Color</strong></div>
                        <?php echo form_input(array('name' => 'visit_date', 'value' => $this->input->post('visit_date'), 'id' => 'visit_date', 'class' => 'form-control')) ?>
                    </div>
                    <div class="input-group">
                        <div class="input-group-addon" style="min-width: 170px; text-align:left"><strong>Transparency</strong></div>
                        <?php echo form_input(array('name' => 'visit_date', 'value' => $this->input->post('visit_date'), 'id' => 'visit_date', 'class' => 'form-control')) ?>
                    </div>
                    <div class="input-group">
                        <div class="input-group-addon" style="min-width: 170px; text-align:left"><strong>Glucose</strong></div>
                        <?php echo form_dropdown('id_clinic', $atn['clinics'], $atn['data']->id_clinic, 'id="id-clinic" class="mh-input form-control"'); ?>
                    </div>
                    <div class="input-group">
                        <div class="input-group-addon" style="min-width: 170px; text-align:left"><strong>Bile</strong></div>
                        <?php echo form_dropdown('id_clinic', $atn['clinics'], $atn['data']->id_clinic, 'id="id-clinic" class="mh-input form-control"'); ?>
                    </div>
                    <div class="input-group">
                        <div class="input-group-addon" style="min-width: 170px; text-align:left"><strong>Ketone</strong></div>
                        <?php echo form_dropdown('id_clinic', $atn['clinics'], $atn['data']->id_clinic, 'id="id-clinic" class="mh-input form-control"'); ?>
                    </div>
                    <div class="input-group">
                        <div class="input-group-addon" style="min-width: 170px; text-align:left"><strong>Specific Gravity</strong></div>
                        <?php echo form_input(array('name' => 'visit_date', 'value' => $this->input->post('visit_date'), 'id' => 'visit_date', 'class' => 'form-control')) ?>
                    </div>
                    <div class="input-group">
                        <div class="input-group-addon" style="min-width: 170px; text-align:left"><strong>pH (reaction)</strong></div>
                        <?php echo form_input(array('name' => 'visit_date', 'value' => $this->input->post('visit_date'), 'id' => 'visit_date', 'class' => 'form-control')) ?>
                    </div>
                    <div class="input-group">
                        <div class="input-group-addon" style="min-width: 170px; text-align:left"><strong>Protein</strong></div>
                        <?php echo form_dropdown('id_clinic', $atn['clinics'], $atn['data']->id_clinic, 'id="id-clinic" class="mh-input form-control"'); ?>
                    </div>
                    <div class="input-group">
                        <div class="input-group-addon" style="min-width: 170px; text-align:left"><strong>Urobilinogen</strong> <span class="pull-right"><small>( E.U./dL )</small></span></div>
                        <?php echo form_input(array('name' => 'visit_date', 'value' => $this->input->post('visit_date'), 'id' => 'visit_date', 'class' => 'form-control')) ?>
                    </div>
                    <div class="input-group">
                        <div class="input-group-addon" style="min-width: 170px; text-align:left"><strong>Nitrites</strong></div>
                        <?php echo form_dropdown('id_clinic', $atn['clinics'], $atn['data']->id_clinic, 'id="id-clinic" class="mh-input form-control"'); ?>
                    </div>
                    <div class="input-group">
                        <div class="input-group-addon" style="min-width: 170px; text-align:left"><strong>Blood</strong></div>
                        <?php echo form_dropdown('id_clinic', $atn['clinics'], $atn['data']->id_clinic, 'id="id-clinic" class="mh-input form-control"'); ?>
                    </div>
                    <div class="input-group">
                        <div class="input-group-addon" style="min-width: 170px; text-align:left"><strong>Leukocytes</strong></div>
                        <?php echo form_dropdown('id_clinic', $atn['clinics'], $atn['data']->id_clinic, 'id="id-clinic" class="mh-input form-control"'); ?>
                    </div>
                </div>
            </li>
            <li class="item">
                <div class="box-body label-primary">Urine Sediment Analysis by Flow Cytometry Test Components <small>(Unit | Reference Range)</small></div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon" style="min-width: 250px; text-align:left"><strong>Red Blood Cells</strong> <span class="pull-right"><small>( /hpf | 0-2 )</small></span></div>
                        <?php echo form_input(array('name' => 'visit_date', 'value' => $this->input->post('visit_date'), 'id' => 'visit_date', 'class' => 'form-control')) ?>
                    </div>
                    <div class="input-group">
                        <div class="input-group-addon" style="min-width: 250px; text-align:left"><strong>White Blood Cells</strong> <span class="pull-right"><small>( /hpf | 0-2 )</small></span></div>
                        <?php echo form_input(array('name' => 'visit_date', 'value' => $this->input->post('visit_date'), 'id' => 'visit_date', 'class' => 'form-control')) ?>
                    </div>
                    <div class="input-group">
                        <div class="input-group-addon" style="min-width: 250px; text-align:left"><strong>Epithelial Cells</strong> <span class="pull-right"><small>( /hpf | 0-2 )</small></span></div>
                        <?php echo form_input(array('name' => 'visit_date', 'value' => $this->input->post('visit_date'), 'id' => 'visit_date', 'class' => 'form-control')) ?>
                    </div>
                    <div class="input-group">
                        <div class="input-group-addon" style="min-width: 250px; text-align:left"><strong>Casts</strong> <span class="pull-right"><small>( /hpf | 0-3 )</small></span></div>
                        <?php echo form_input(array('name' => 'visit_date', 'value' => $this->input->post('visit_date'), 'id' => 'visit_date', 'class' => 'form-control')) ?>
                    </div>
                    <div class="input-group">
                        <div class="input-group-addon" style="min-width: 250px; text-align:left"><strong>Bacteria</strong> <span class="pull-right"><small>( /hpf | 0-20 )</small></span></div>
                        <?php echo form_input(array('name' => 'visit_date', 'value' => $this->input->post('visit_date'), 'id' => 'visit_date', 'class' => 'form-control')) ?>
                    </div>
                </div>
            </li>
            <li class="item">
                <label for="id_clinic">Pathologist:</label>
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