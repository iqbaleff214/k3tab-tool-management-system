<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="<?php echo base_url('equipment'); ?>" class="btn btn-icon btn-warning"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1><?php echo $title; ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#" class="text-warning">Master Data</a></div>
                <div class="breadcrumb-item"><a href="<?php echo base_url('equipment'); ?>" class="text-warning">Equipment</a></div>
                <div class="breadcrumb-item"><?php echo $equipment['id']; ?></div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-warning">Equipment Detail</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <a href="<?php echo base_url('equipment/edit/' . $equipment['id']); ?>" class="btn btn-sm btn-warning float-right">Edit</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4"><b>Equipment Id</b></div>
                                <div class="col-8">
                                    <p><?php echo $equipment['id']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4"><b>Description</b></div>
                                <div class="col-8">
                                    <p><?php echo $equipment['description']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4"><b>Material</b></div>
                                <div class="col-8">
                                    <p><?php echo $equipment['material']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4"><b>Manufacture</b></div>
                                <div class="col-8">
                                    <p><?php echo $equipment['manufacture']; ?></p>
                                </div>
                            </div>
                            <?php if (isset($toolbox)) : ?>
                                <div class="row">
                                    <div class="col-4"><b>Toolbox Set</b></div>
                                    <div class="col-8">
                                        <p><a href="<?php echo base_url('toolbox/view/' . $toolbox['id']); ?>"><?php echo $toolbox['description']; ?></a></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="row">
                                <div class="col-4"><b>Status</b></div>
                                <div class="col-8">
                                    <p><?php echo $equipment['status']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4"><b>Last Used by</b></div>
                                <div class="col-8">
                                    <p><?php if (isset($employee['name'])) echo $employee['name'];
                                        else echo "-"; ?></p>
                                </div>
                            </div>
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
                                            <th>Employee</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($employees as $emp) : ?>
                                            <tr class="<?php if (!$emp['return_date']) echo 'text-danger'; ?>">
                                                <td><?php echo date("d/m/Y", strtotime($emp['booking_date'])); ?></td>
                                                <td><?php if ($emp['return_date']) echo date("d/m/Y", strtotime($emp['return_date']));
                                                    else echo '-' ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('employee/view/' . $emp['employee']); ?>">
                                                        <?php echo $emp['name']; ?>
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