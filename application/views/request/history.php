<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?php echo $title; ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#" class="text-warning">Equipment Request</a></div>
                <div class="breadcrumb-item"><?php echo $title; ?></div>
            </div>
        </div>
        <div class="section-body">

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-warning">All <?php echo $title; ?></h4>
                        </div>
                        <div class="card-body">
                            <a href="<?php echo base_url('dashboard/exporthistory/0'); ?>" class="btn btn-warning float-right">Download Excel Full</a>

                            <button class="btn btn-primary" id="select-all">Select All</button>
                            <button class="btn btn-danger" id="delete-all">Delete Selected</button>
                            
                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="table1">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Request</th>
                                            <th>Return</th>
                                            <th>Employee</th>

                                            <th>Equipment Id</th>
                                            <th>Equipment</th>
                                            <th>Condition</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; ?>
                                        <?php foreach ($equipments as $equipment) : ?>
                                            <tr data-id="<?= $equipment['id'] ?>">
                                                <td><?= $no++; ?></td>
                                                <td><?php echo date("d/m/Y", strtotime($equipment['booking_date'])); ?></td>
                                                <td>
                                                    <?= ($equipment['return_date']) ? date("d/m/Y", strtotime($equipment['return_date'])) : '-' ?>
                                                </td>
                                                <td><a href="<?php echo base_url('employee/view/' . $equipment['employee']); ?>"><?php echo $equipment['name']; ?></a></td>

                                                <td>
                                                    <?php echo $equipment['equipment']; ?>
                                                    <?php if ($equipment['toolbox']) : ?>
                                                        <sup>*</sup>
                                                        <div class="table-links">
                                                            <a href="<?php echo base_url('toolbox/view/' . $equipment['toolbox']); ?>">
                                                                <?php echo $equipment['toolbox']; ?>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                </td>
                                                <td><a href="<?php echo base_url('equipment/view/' . $equipment['equipment']); ?>"><?php echo $equipment['description']; ?></a></td>
                                                <td><?php echo $equipment['status'] ?: '-'; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <footer class="p-4">
                                    <h6>Note:</h6>
                                    *) Toolbox set
                                </footer>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>