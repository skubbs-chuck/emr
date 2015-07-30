<div class="box-body no-margin" id="gnv-results">
	<form action="#" method="post" id="gnv-form">
	    <ul class="products-list product-list-in-box margin">
	    	<li class="item" id="gnv-message">
	    		<?php if (isset($gnv['var']['message'])): ?>
	    			<div class="alert alert-<?php echo $gnv['var']['message_type'] ?>"><?php echo $gnv['var']['message'] ?></div>
	    		<?php endif ?>
	    	</li>
	    	<li class="item">
				<div class="btn-group pull-right">
					<button class="btn btn-primary gnv-save">Save</button>
					<button class="btn gnv-cancel">Cancel</button>
				</div>
	    	</li>
		    <li class="item">
		    	<strong>Nursing Assessment: </strong>
		    	<div>
		    		<textarea name="order_note" id="order_note" class="form-control gnv-input" rows="3"><?php echo $gnv['data']->order_note ?></textarea>
		    	</div>
		    </li>
		    <li class="item">
			    <strong>Assessment: </strong>
			    <div class="table-responsive">
			        <table class="table table-bordered">
			            <thead>
			                <tr>
			                    <th class="label-primary col-md-4">Date/Year</th>
			                    <th class="label-primary col-md-8">Details</th>
			                </tr>
			            </thead>
			            <tbody id="phas">
			                <tr class="mh-input" style="display: table-row;">
			                    <td>
			                        <input type="text" name="phas_date_year[]" value="2some details<img src=&quot;" class="form-control">
			                    </td>
			                    <td>
			                        <div class="input-group" style="margin-bottom: 5px">
			                            <input type="text" class="form-control" name="phas_detail[]" value="">
			                            <span class="input-group-addon remove-contact btn btn-danger"><i class="fa fa-remove "></i></span>
			                        </div>
			                    </td>
			                </tr>
			            </tbody>
			            <tfoot>
			                <tr class="mh-input" style="display: table-row;">
			                    <td colspan="2">
			                        <a href="#" class="btn btn-info btn-xs" id="medical-history-add-phas">Add Entry</a>
			                    </td>
			                </tr>
			            </tfoot>
			        </table>
			    </div>
			</li>
		    <li class="item">
		    	<strong>Implementation: </strong>
		    	<div>
		    		<textarea name="order_note" id="order_note" class="form-control gnv-input" rows="3"><?php echo $gnv['data']->order_note ?></textarea>
		    	</div>
		    </li>
		    <li class="item">
		    	<strong>Evaluation: </strong>
		    	<div>
		    		<textarea name="order_note" id="order_note" class="form-control gnv-input" rows="3"><?php echo $gnv['data']->order_note ?></textarea>
		    	</div>
		    </li>
		    <li class="item">
				<div class="btn-group pull-right">
					<button class="btn btn-primary gnv-save">Save</button>
					<button class="btn gnv-cancel">Cancel</button>
				</div>
	    	</li>
		</ul>
	</form>
</div>