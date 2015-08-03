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
			    <div class="form-group">
			        <div class="input-group">
			            <div class="input-group-addon" style="min-width: 190px; text-align:left"><strong>Date Assessed</strong></div>
		                <?php echo form_input(array('name' => 'visit_date', 'value' => ($this->input->post('visit_date') ? $this->input->post('visit_date') : date("Y-m-d")), 'id' => 'visit_date', 'class' => 'form-control skubbs_datepicker', 'data-inputmask' => "'alias': 'dd/mm/yyyy'", 'data-mask' => '')) ?>
			        </div>
			        <div class="input-group bootstrap-timepicker">
			            <div class="input-group-addon" style="min-width: 190px; text-align:left"><strong>Start Time</strong></div>
		                <?php echo form_input(array('name' => 'start_time', 'value' => ($this->input->post('start_time') ? $this->input->post('start_time') : date('h:i A')), 'id' => 'visit_date', 'class' => 'form-control skubbs_timepicker')) ?>
			        </div>
			        <div class="input-group">
			            <div class="input-group-addon" style="min-width: 190px; text-align:left"><strong>Patient's Title</strong></div>
		                <?php echo form_input(array('name' => 'visit_date', 'value' => $this->input->post('visit_date'), 'id' => 'visit_date', 'class' => 'form-control')) ?>
			        </div>
			        <div class="input-group">
			            <div class="input-group-addon" style="min-width: 190px; text-align:left"><strong>Purpose</strong></div>
		                <?php echo form_dropdown('id_clinic', $atn['clinics'], $atn['data']->id_clinic, 'id="id-clinic" class="mh-input form-control"'); ?>
			        </div>
			        <div class="input-group">
			            <div class="input-group-addon" style="min-width: 190px; text-align:left"><strong>Health Status</strong></div>
		                <?php echo form_dropdown('id_clinic', $atn['clinics'], $atn['data']->id_clinic, 'id="id-clinic" class="mh-input form-control"'); ?>
			        </div>
			        <div class="input-group">
			            <div class="input-group-addon" style="min-width: 190px; text-align:left"><strong>Physical or Mental Defects</strong></div>
		                <?php echo form_dropdown('id_clinic', $atn['clinics'], $atn['data']->id_clinic, 'id="id-clinic" class="mh-input form-control"'); ?>
			        </div>
				</div>
	    	</li>
	    	<li class="item">
	    		<div class="box-body label-primary">Defects or Conditions</div>
	    		add entry here
	    	</li>
	    	<li class="item">
	    		<label for="id_clinic">Fitness Status:</label>
	    		<?php echo form_dropdown('id_clinic', $atn['clinics'], $atn['data']->id_clinic, 'id="id-clinic" class="mh-input form-control"'); ?>
	    	</li>
	    	<li class="item">
	    		<label for="id_clinic">Restrictions:</label>
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