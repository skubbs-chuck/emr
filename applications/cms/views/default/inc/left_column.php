<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li<?php if ($current_page == 'home/index') echo ' class="active"'; ?>><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            
            <li class="header">Patients</li>
            <li<?php if ($current_page == 'patient/management') echo ' class="active"'; ?>><a href="<?php echo base_url() . 'patient/management' ?>"><i class="fa fa-user-plus"></i> Patients</a></li>
            
            <li class="header">Calendar</li>
            <li<?php if ($current_page == 'calendar/index') echo ' class="active"'; ?>><a href="<?php echo base_url() . 'calendar' ?>"><i class="fa fa-calendar"></i> <span>Calendar</span></a></li>
            
            <li class="header">Billing</li>
            <li<?php if ($current_page == 'billing/list') echo ' class="active"'; ?>><a href="<?php echo base_url() . 'billing/list' ?>"><i class="fa fa-list-alt"></i> Billing List</a></li>
            <li<?php if ($current_page == 'billing/accreceivable') echo ' class="active"'; ?>><a href="<?php echo base_url() . 'billing/accreceivable' ?>"><i class="fa fa-money"></i> Accounts Receivable</a></li>
            
            <li class="header">Administrations</li>
            <li<?php if ($current_page == 'user/management') echo ' class="active"'; ?>><a href="<?php echo base_url() . 'user/management' ?>"><i class="fa fa-user"></i> User Management</a></li>
            <li<?php if ($current_page == 'user/groups') echo ' class="active"'; ?>><a href="<?php echo base_url() . 'user/groups' ?>"><i class="fa fa-group"></i> User Groups</a></li>
            <li<?php if ($current_page == 'clinic/management') echo ' class="active"'; ?>><a href="<?php echo base_url() . 'clinic/management' ?>"><i class="fa fa-stethoscope"></i> Clinics</a></li>
            <li<?php if ($current_page == 'item/management') echo ' class="active"'; ?>><a href="<?php echo base_url() . 'item/management' ?>"><i class="fa fa-book"></i> Item Management</a></li>
            <li<?php if ($current_page == 'log/audit') echo ' class="active"'; ?>><a href="<?php echo base_url() . 'log/audit' ?>"><i class="fa fa-tasks"></i> Audit Log</a></li>
            <li<?php if ($current_page == 'data/export') echo ' class="active"'; ?>><a href="<?php echo base_url() . 'data/export' ?>"><i class="fa fa-upload"></i> Data Export</a></li>
            <li<?php if ($current_page == 'data/import') echo ' class="active"'; ?>><a href="<?php echo base_url() . 'data/import' ?>"><i class="fa fa-download"></i> Data Import</a></li>
            <li<?php if ($current_page == 'data/usage') echo ' class="active"'; ?>><a href="<?php echo base_url() . 'data/usage' ?>"><i class="fa fa-bar-chart"></i> Data Usage</a></li>
        </ul>
    </section>
</aside>