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
	    		<?php print_r($atn['clinics']) ?>
	    	</li>
		    <li class="item">
		    	<strong>Order/Notes: </strong>
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