<?php include_once $inc_header; ?>
<div class="content-wrapper">
    <section class="content">
    	<div class="well">
            <div class="row">
                <div class="patient-image col-md-1">
                    <img src="https://cms.medcurial.com/images/profile_default.png">
                </div>
                <div class="patient-details col-md-11">
                    <div class="pull-right text-right">asasas</div>
                    <div><strong><?php echo $pinfo->last_name . ', ' . $pinfo->first_name . ' ' . $pinfo->middle_name ?></strong></div>
                    <div><?php echo $pinfo->gender ?> / <?php echo $pinfo->birth_date ?></div>
                    <div>Member Since: <?php echo $member_since ?></div>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="box-header with-border">
                <ul class="nav pull-right">
                  <li class="dropdown pull-right">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                      <i class="fa fa-gear"></i>
                    </a>
                    <ul class="dropdown-menu">
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                      <li role="presentation" class="divider"></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                    </ul>
                  </li>
                </ul>
                <h3 class="box-title">Notes</h3>
            </div>
            <div class="box-body no-padding">
                <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Tab 1</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Tab 2</a></li>
                  <li><a href="#tab_3" data-toggle="tab">Tab 3</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Tab 2</a></li>
                  <li><a href="#tab_3" data-toggle="tab">Tab 3</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Tab 2</a></li>
                  <li><a href="#tab_3" data-toggle="tab">Tab 3</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Tab 2</a></li>
                  <li><a href="#tab_3" data-toggle="tab">Tab 3</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Tab 2</a></li>
                  <li><a href="#tab_3" data-toggle="tab">Tab 3</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Tab 2</a></li>
                  <li><a href="#tab_3" data-toggle="tab">Tab 3</a></li>
                  <li><a href="#tab_3" data-toggle="tab">Tab 3</a></li>
                  <!-- <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li> -->
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                   a
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div>
            </div>
        </div>
    </section>
</div>
<?php include_once $inc_footer; ?>
