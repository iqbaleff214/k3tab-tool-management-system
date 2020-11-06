<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?php echo base_url(); ?>">Tool Management System</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?php echo base_url(); ?>">TMS</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header text-dark">Dashboard</li>
            <li class="nav-item dropdown <?php if ($title == "Dashboard" || $title == "Daily Report") echo "active"; ?>">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class="<?php if ($sidebar == "Dashboard") echo "active"; ?>"><a class="nav-link" href="<?php echo base_url(); ?>"><i class="far fa-chart-bar"></i>General</a></li>
                    <li class="<?php if ($sidebar == "Report") echo "active"; ?>"><a class="nav-link" href="<?php echo base_url('dashboard/report'); ?>"><i class="fas fa-file-excel"></i>Daily Report</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown <?php if (($sidebar == "Employee") || ($sidebar == "Equipment") || ($sidebar == "Toolbox")) echo "active"; ?>">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-server"></i><span>Master Data</span></a>
                <ul class="dropdown-menu">
                    <li class="<?php if ($sidebar == "Employee") echo "active"; ?>"><a class="nav-link" href="<?php echo base_url('employee'); ?>"><i class="far fa-user"></i> <span>Employee</span></a></li>
                    <li class="<?php if ($sidebar == "Equipment") echo "active"; ?>"><a class="nav-link" href="<?php echo base_url('equipment'); ?>"><i class="fas fa-tools"></i> <span>Equipment</span></a></li>
                    <li class="<?php if ($sidebar == "Toolbox") echo "active"; ?>"><a class="nav-link" href="<?php echo base_url('toolbox'); ?>"><i class="fas fa-toolbox"></i> <span>Toolbox</span></a></li>
                </ul>
            </li>
            <li class="menu-header text-dark">Equipment Request</li>
            <li class="<?php if ($sidebar == "History") echo "active"; ?>"><a class="nav-link" href="<?php echo base_url('request/history'); ?>"><i class="fas fa-history"></i> <span>Request History</span></a></li>
            <li class="<?php if ($sidebar == "Request") echo "active"; ?>"><a class="nav-link" href="<?php echo base_url('request'); ?>"><i class="fas fa-sign-out-alt"></i> <span>Request</span></a></li>
            <li class="<?php if ($sidebar == "Return") echo "active"; ?>"><a class="nav-link" href="<?php echo base_url('request/return'); ?>"><i class="fas fa-sign-in-alt"></i> <span>Return</span></a></li>
        </ul>
    </aside>
</div>

<?php echo $this->session->flashdata('pesan'); ?>