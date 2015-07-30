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
	    		<div class="box-body label-primary">Complete Blood Count Test Components <small>(Unit | Reference Interval)</small></div>
			    <div class="form-group">
			        <div class="input-group">
			            <div class="input-group-addon" style="min-width: 250px; text-align:left"><strong>Hemoglobin</strong> <span class="pull-right"><small>( g/dl | 11.6 - 15.5 )</small></span></div>
		                <?php echo form_input(array('name' => 'visit_date', 'value' => $this->input->post('visit_date'), 'id' => 'visit_date', 'class' => 'form-control')) ?>
			        </div>
			        <div class="input-group">
			            <div class="input-group-addon" style="min-width: 250px; text-align:left"><strong>Hematocrit</strong> <span class="pull-right"><small>( % | 36.0 - 47.0 )</small></span></div>
		                <?php echo form_input(array('name' => 'visit_date', 'value' => $this->input->post('visit_date'), 'id' => 'visit_date', 'class' => 'form-control')) ?>
			        </div>
			        <div class="input-group">
			            <div class="input-group-addon" style="min-width: 250px; text-align:left"><strong>RBC Count</strong> <span class="pull-right"><small>( mil/mm3 | 4.20 - 5.40 )</small></span></div>
		                <?php echo form_input(array('name' => 'visit_date', 'value' => $this->input->post('visit_date'), 'id' => 'visit_date', 'class' => 'form-control')) ?>
			        </div>
			        <div class="input-group">
			            <div class="input-group-addon" style="min-width: 250px; text-align:left"><strong>WBC Count</strong> <span class="pull-right"><small>( mm3 | 4800 - 10800 )</small></span></div>
		                <?php echo form_input(array('name' => 'visit_date', 'value' => $this->input->post('visit_date'), 'id' => 'visit_date', 'class' => 'form-control')) ?>
			        </div>
				</div>
	    	</li>
	    	<li class="item">
	    		<div class="box-body label-primary">Differential Count Test Components <small>(Unit | Reference Interval)</small></div>
			    <div class="form-group">
			        <div class="input-group">
			            <div class="input-group-addon" style="min-width: 250px; text-align:left"><strong>Neutrophils</strong> <span class="pull-right"><small>( % | 40 - 74 )</small></span></div>
		                <?php echo form_input(array('name' => 'visit_date', 'value' => $this->input->post('visit_date'), 'id' => 'visit_date', 'class' => 'form-control')) ?>
			        </div>
			        <div class="input-group">
			            <div class="input-group-addon" style="min-width: 250px; text-align:left"><strong>Lymphocytes</strong> <span class="pull-right"><small>( % | 19 - 48 )</small></span></div>
		                <?php echo form_input(array('name' => 'visit_date', 'value' => $this->input->post('visit_date'), 'id' => 'visit_date', 'class' => 'form-control')) ?>
			        </div>
			        <div class="input-group">
			            <div class="input-group-addon" style="min-width: 250px; text-align:left"><strong>Eosinophils</strong> <span class="pull-right"><small>( % | 0 - 7 )</small></span></div>
		                <?php echo form_input(array('name' => 'visit_date', 'value' => $this->input->post('visit_date'), 'id' => 'visit_date', 'class' => 'form-control')) ?>
			        </div>
			        <div class="input-group">
			            <div class="input-group-addon" style="min-width: 250px; text-align:left"><strong>Monocytes</strong> <span class="pull-right"><small>( % | 3 - 9 )</small></span></div>
		                <?php echo form_input(array('name' => 'visit_date', 'value' => $this->input->post('visit_date'), 'id' => 'visit_date', 'class' => 'form-control')) ?>
			        </div>
			        <div class="input-group">
			            <div class="input-group-addon" style="min-width: 250px; text-align:left"><strong>Platelet Count</strong> <span class="pull-right"><small>( /mm3 | 150000 - 400000 )</small></span></div>
		                <?php echo form_input(array('name' => 'visit_date', 'value' => $this->input->post('visit_date'), 'id' => 'visit_date', 'class' => 'form-control')) ?>
			        </div>
			        <div class="input-group">
			            <div class="input-group-addon" style="min-width: 250px; text-align:left"><strong>MCV</strong> <span class="pull-right"><small>( fl | 82 - 98 )</small></span></div>
		                <?php echo form_input(array('name' => 'visit_date', 'value' => $this->input->post('visit_date'), 'id' => 'visit_date', 'class' => 'form-control')) ?>
			        </div>
			        <div class="input-group">
			            <div class="input-group-addon" style="min-width: 250px; text-align:left"><strong>MCH</strong> <span class="pull-right"><small>( pg | 28 - 33 )</small></span></div>
		                <?php echo form_input(array('name' => 'visit_date', 'value' => $this->input->post('visit_date'), 'id' => 'visit_date', 'class' => 'form-control')) ?>
			        </div>
			        <div class="input-group">
			            <div class="input-group-addon" style="min-width: 250px; text-align:left"><strong>MCHC</strong> <span class="pull-right"><small>( % | 32 - 38 )</small></span></div>
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