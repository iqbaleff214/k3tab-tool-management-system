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
                <div class="breadcrumb-item"><?php echo $title; ?></div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-warning">Fill Equipment's Data</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="<?php echo base_url('equipment/edit/' . $equipment['id']); ?>">
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Equipment Id</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control <?php if (form_error('id')) echo 'is-invalid'; ?>" name="id" id="txt-id" value="<?php echo $equipment['id']; ?>" readonly>
                                        <div class="invalid-feedback">
                                            <?php echo form_error('id'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Decription of Technical Object</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control <?php if (form_error('description')) echo 'is-invalid'; ?>" name="description" id="txt-description" value="<?php echo $equipment['description']; ?>" autofocus>
                                        <div class="invalid-feedback">
                                            <?php echo form_error('description'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Manufacture</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control <?php if (form_error('manufacture')) echo 'is-invalid'; ?>" name="manufacture" id="txt-manufacture" value="<?php echo $equipment['manufacture']; ?>">
                                        <div class="invalid-feedback">
                                            <?php echo form_error('manufacture'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Material</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control <?php if (form_error('material')) echo 'is-invalid'; ?>" name="material" id="txt-material" value="<?php echo $equipment['material']; ?>">
                                        <div class="invalid-feedback">
                                            <?php echo form_error('material'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Type</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control <?php if (form_error('type')) echo 'is-invalid'; ?>" name="type" id="txt-type" value="<?php echo $equipment['type']; ?>">
                                        <div class="invalid-feedback">
                                            <?php echo form_error('type'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Unit</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control <?php if (form_error('unit')) echo 'is-invalid'; ?>" name="unit" id="txt-unit" value="<?php echo $equipment['unit']; ?>">
                                        <div class="invalid-feedback">
                                            <?php echo form_error('unit'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control selectric" name="status" id="txt-status">
                                            <option value="Available" <?php if ($equipment['status'] == 'Available') echo 'selected'; ?>>Available</option>
                                            <option value="Maintenance" <?php if ($equipment['status'] == 'Maintenance') echo 'selected'; ?>>Maintenance</option>
                                            <option value="Broken" <?php if ($equipment['status'] == 'Broken') echo 'selected'; ?>>Broken</option>
                                            <option value="In Use" <?php if ($equipment['status'] == 'In Use') echo 'selected'; ?>>In Use</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-warning" type="submit">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>