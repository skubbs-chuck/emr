<?php include_once $inc_header; ?>
<div class="content-wrapper">
    <section class="content-header">
    	<h1>Clinics</h1> 
    </section>
    <section class="content">
    	<div class="row">
    		<div class="col-md-12">
    		<?php echo $this->session->flashdata('alert_message') ?>
    		</div>
    	</div>
    	<div class="box">
    		<div class="box-header with-border">
                <h3 class="box-title">Clinics <small><a href="<?php echo base_url() . 'clinic/add' ?>">Add New Clinic</a></small></h3>
                <div class="box-tools">
                	<?php echo isset($clinic_list_links) ? $clinic_list_links : '' ?>
                </div>
            </div>
            <div class="box-body no-padding">
            	<table class="table table-bordered table-hover">
            		<thead>
            			<tr>
							<th>Clinic Name</th>
							<th>Hours Start</th>
							<th>Hours End</th>
							<th>Address</th>
							<th>Contact #</th>
							<th>Action</th>
						</tr>
            		</thead>
					<tbody>
						<?php if (isset($clinic_list) && $clinic_list): ?>
							<?php foreach ($clinic_list as $clinic): ?>
							<tr>
								<td><a href="<?php echo base_url() . 'clinic/edit/' . $clinic->id_clinic ?>"><?php echo $clinic->name ?></a></td>
								<td><?php echo $clinic->hour_start ?></td>
								<td><?php echo $clinic->hour_end ?></td>
								<td><?php echo implode(', ', array($clinic->country, $clinic->street, $clinic->city . ' City', $clinic->zip_code)) ?></td>
								<td><?php echo ($clinic->contact_number) ? $clinic->contact_number : 'none' ?></td>
								<td>delete</td>
							</tr>
							<?php endforeach ?>
						<?php else: ?>
							<tr>
								<td colspan="6" class="text-center">No records found.</td>
							</tr>
						<?php endif ?>
					</tbody>
					<tfoot>
						<tr>
							<th>Clinic Name</th>
							<th>Hours Start</th>
							<th>Hours End</th>
							<th>Address</th>
							<th>Contact #</th>
							<th>Action</th>
						</tr>
					</tfoot>
          		</table>
            </div>
            <div class="box-footer with-border">
                <!-- <h3 class="box-title">Clinics</h3> -->
                <div class="box-tools">
                <?php echo isset($clinic_list_links) ? $clinic_list_links : '' ?>
                </div>
            </div>
    	</div>
    </section>
</div>
<?php include_once $inc_footer; ?>