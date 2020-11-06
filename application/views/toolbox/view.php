<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="<?php echo base_url('toolbox'); ?>" class="btn btn-icon btn-warning"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1><?php echo $title; ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#" class="text-warning">Master Data</a></div>
                <div class="breadcrumb-item"><a href="<?php echo base_url('toolbox'); ?>" class="text-warning">Toolbox</a></div>
                <div class="breadcrumb-item"><?php echo $toolbox['id']; ?></div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-warning">Toolbox Detail</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <a href="<?php echo base_url('toolbox/edit/' . $toolbox['id']); ?>" class="btn btn-sm btn-warning float-right">Edit</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4"><b>Toolbox Id</b></div>
                                <div class="col-8">
                                    <p><?php echo $toolbox['id']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4"><b>Description</b></div>
                                <div class="col-8">
                                    <p><?php echo $toolbox['description']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4"><b>Status</b></div>
                                <div class="col-8">
                                    <p><?php echo $toolbox['status']; ?></p>
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
                            <h4 class="text-warning">Equipment List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Description</th>
                                            <th>Manufacture</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($equipments as $equipment) : ?>
                                            <tr>
                                                <td><?php echo $equipment['id']; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('equipment/view/' . $equipment['id']); ?>">
                                                        <?php echo $equipment['description']; ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php echo $equipment['manufacture']; ?>
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