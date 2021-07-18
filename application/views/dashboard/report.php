<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?php echo $title; ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#" class="text-warning">Dashboard</a></div>
                <div class="breadcrumb-item"><?php echo $sidebar; ?></div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-warning">Request Report</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0 table3">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Date</th>
                                            <th>Employee</th>
                                            <th>Equipment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; ?>
                                        <?php foreach ($reports as $report) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?php echo date("d/m/Y", strtotime($report['booking_date'])); ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('employee/view/' . $report['employee']); ?>">
                                                        <?php echo $report['name']; ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="<?php echo base_url('equipment/view/' . $report['equipment']); ?>">
                                                        <?php echo $report['description']; ?>
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
                <div class="col-lg-4 col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-warning">Download Report</h4>
                        </div>
                        <div class="card-body">
                            <a class="btn btn-block btn-warning" href="<?php echo base_url('dashboard/exporthistory/today'); ?>">Report Download</a>
                            <a class="btn btn-block btn-warning" href="<?php echo base_url('dashboard/exportexcel/1'); ?>">Request Report Download</a>
                            <a class="btn btn-block btn-warning" href="<?php echo base_url('dashboard/exportexcel/2'); ?>">Return Report Download</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-warning">Return Report</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0 table3">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Date</th>
                                            <th>Employee</th>
                                            <th>Equipment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; ?>
                                        <?php foreach ($reports_return as $report) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?php echo date("d/m/Y", strtotime($report['return_date'])); ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('employee/view/' . $report['employee']); ?>">
                                                        <?php echo $report['name']; ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="<?php echo base_url('equipment/view/' . $report['equipment']); ?>">
                                                        <?php echo $report['description']; ?>
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