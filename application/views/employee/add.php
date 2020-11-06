<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="<?php echo base_url('employee'); ?>" class="btn btn-icon btn-warning"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1><?php echo $title; ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#" class="text-warning">Master Data</a></div>
                <div class="breadcrumb-item"><a href="<?php echo base_url('employee'); ?>" class="text-warning">Employee</a></div>
                <div class="breadcrumb-item"><?php echo $title; ?></div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-warning">Fill Employee's Data</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="<?php echo base_url('employee/add'); ?>">
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Employee Id</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control <?php if (form_error('id')) echo 'is-invalid'; ?>" name="id" id="txt-id" value="<?php echo set_value('id'); ?>" autofocus>
                                        <div class="invalid-feedback">
                                            <?php echo form_error('id'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Full Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control <?php if (form_error('name')) echo 'is-invalid'; ?>" name="name" id="txt-name" value="<?php echo set_value('name'); ?>">
                                        <div class="invalid-feedback">
                                            <?php echo form_error('name'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Class</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control <?php if (form_error('class')) echo 'is-invalid'; ?>" name="class" id="txt-class" value="<?php echo set_value('class'); ?>">
                                        <div class="invalid-feedback">
                                            <?php echo form_error('class'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Birth Date</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="date" class="form-control <?php if (form_error('birthdate')) echo 'is-invalid'; ?>" name="birthdate" id="txt-birthdate" value="<?php echo set_value('birthdate'); ?>">
                                        <div class="invalid-feedback">
                                            <?php echo form_error('birthdate'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="email" class="form-control <?php if (form_error('email')) echo 'is-invalid'; ?>" name="email" id="txt-email" value="<?php echo set_value('email'); ?>">
                                        <div class="invalid-feedback">
                                            <?php echo form_error('email'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Phone Number / Whatsapp</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="tel" class="form-control <?php if (form_error('phone')) echo 'is-invalid'; ?>" name="phone" id="txt-phone" value="<?php echo set_value('phone'); ?>">
                                        <div class="invalid-feedback">
                                            <?php echo form_error('phone'); ?>
                                        </div>
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