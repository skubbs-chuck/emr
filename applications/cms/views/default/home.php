<?php include_once $inc_header; ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Dashboard <small>Electronic Medical Records</small></h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
            <?php echo $this->session->flashdata('alert_message') ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="ion ion-ios-people-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Number of Patients</span>
                        <span class="info-box-number">2,000</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Number of Users/Doctors</span>
                        <span class="info-box-number">2,000</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary box-solid">
                    <div class="box-header with-border">
                    <h3 class="box-title">_hookHeader</h3>
                    </div>
                    <div class="box-body">
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<?php include_once $inc_footer; ?>