<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="<?php echo base_url('employee'); ?>" class="btn btn-icon btn-warning"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1><?php echo $title; ?> <small><?php echo $employee['name']; ?></small></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#" class="text-warning">Master Data</a></div>
                <div class="breadcrumb-item"><a href="<?php echo base_url('employee'); ?>" class="text-warning">Employee</a></div>
                <div class="breadcrumb-item"><?php echo $employee['id']; ?></div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                            <img alt="image" src="<?php echo base_url('assets/') . 'img/avatars/avatar-' . rand(0, 9) . '.png'; ?>" class="rounded-circle profile-widget-picture">
                            <div class="profile-widget-items">
                                <div class="profile-widget-item">
                                    <div class=""><b>Email</b></div>
                                    <div class=""><?php echo $employee['email']; ?></div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class=""><b>Phone</b></div>
                                    <div class=""><?php echo $employee['phone']; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-widget-description">
                            <div class="row">
                                <div class="col-12">
                                    <a href="<?php echo base_url('employee/edit/' . $employee['id']); ?>" class="btn btn-sm btn-warning float-right">Edit</a>
                                </div>
                            </div>
                            <div class="profile-widget-name"><?php echo $employee['name']; ?> <div class="text-muted d-inline font-weight-normal">
                                    <div class="slash"></div> <?php echo $employee['id']; ?>
                                </div>
                            </div>
                            <?php echo $employee['name']; ?> was born on <?php echo date('j F Y', strtotime($employee['birthdate'])); ?>
                        </div>
                        <div class="card-footer text-center">
                            <!-- / -->
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-warning">Request History</h4>
                            <span>Last 5 requests</span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Request</th>
                                            <th>Return</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($equipments as $equipment) : ?>
                                            <tr class="<?php if (!$equipment['return_date']) echo 'text-danger'; ?>">
                                                <td><?php echo date("d/m/Y", strtotime($equipment['booking_date'])); ?></td>
                                                <td><?php if ($equipment['return_date']) echo date("d/m/Y", strtotime($equipment['return_date']));
                                                    else echo '-' ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('equipment/view/' . $equipment['equipment']); ?>">
                                                        <?php echo $equipment['description']; ?>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>