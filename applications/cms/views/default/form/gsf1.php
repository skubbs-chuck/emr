<div class="box-body no-margin" id="gsf1-results">
	<form action="#" method="post" id="gsf1-form">
	    <ul class="products-list product-list-in-box margin">
	    	<li class="item" id="gsf1-message">
	    		<?php if (isset($gsf1['var']['message'])): ?>
	    			<div class="alert alert-<?php echo $gsf1['var']['message_type'] ?>"><?php echo $gsf1['var']['message'] ?></div>
	    		<?php endif ?>
	    	</li>
	    	<li class="item">
				<div class="btn-group pull-right"><button class="btn btn-primary gsf1-edit">Edit</button></div>
				<div class="btn-group pull-right">
					<button class="btn btn-primary gsf1-save">Save</button>
					<button class="btn gsf1-cancel">Cancel</button>
				</div>
	    	</li>
		    <li class="item">
		        <strong>soap_img: </strong>
		        <span class="gsf1-output" id="soap_img-val"><?php echo $gsf1['data']->soap_img ?></span>
				<?php echo form_input(array(
					'name' => 'soap_img', 
					'id' => 'soap_img', 
					'class' => 'gsf1-input form-control', 
					'value' => $gsf1['data']->soap_img
				)); ?>
		    </li>
		    <li class="item">
		    	<strong>Subjective: </strong>
		    	<div>
		    		<span class="gsf1-output" id="subjective-val"><?php echo $gsf1['data']->subjective ?></span>
		    		<textarea name="subjective" id="subjective" class="form-control gsf1-input" rows="3"><?php echo $gsf1['data']->subjective ?></textarea>
		    	</div>
		    </li>
		    <li class="item">
		    	<strong>Plan: </strong>
		    	<div>
		    		<span class="gsf1-output" id="plan-val"><?php echo $gsf1['data']->plan ?></span>
		    		<textarea name="plan" id="plan" class="form-control gsf1-input" rows="3"><?php echo $gsf1['data']->plan ?></textarea>
		    	</div>
		    </li>
		    <li class="item">
				<div class="btn-group pull-right"><button class="btn btn-primary gsf1-edit">Edit</button></div>
				<div class="btn-group pull-right">
					<button class="btn btn-primary gsf1-save">Save</button>
					<button class="btn gsf1-cancel">Cancel</button>
				</div>
	    	</li>
		</ul>
	</form>
</div>
<script type="text/javascript">
$(function() {
	$(document).ready(function() {
		$('#gsf1-results .gsf1-input').hide();
		$('#gsf1-results .gsf1-save').hide();
		$('#gsf1-results .gsf1-cancel').hide();
	});
	$(document).on('click', '#gsf1-results .gsf1-edit', function() {
		$('#gsf1-message').text('');
		$('#gsf1-results .gsf1-save').show();
		$('#gsf1-results .gsf1-cancel').show();
		$('#gsf1-results .gsf1-input').show();
		$('#gsf1-results .gsf1-output').hide();
		$('#gsf1-results .gsf1-edit').hide();

		return false;
	});
	$(document).on('click', '#gsf1-results .gsf1-cancel', function() {
		$('#gsf1-results .gsf1-save').hide();
		$('#gsf1-results .gsf1-cancel').hide();
		$('#gsf1-results .gsf1-input').hide();
		$('#gsf1-results .gsf1-output').show();
		$('#gsf1-results .gsf1-edit').show();
		return false;
	});
	$(document).on('click', '#gsf1-results .gsf1-save', function() {
		$('#gsf1-results .gsf1-save').hide();
		$('#gsf1-results .gsf1-cancel').hide();
		$('#gsf1-results .gsf1-input').hide();
		$('#gsf1-results .gsf1-output').show();
		$('#gsf1-results .gsf1-edit').show();
		return false;
	});
});
</script>
