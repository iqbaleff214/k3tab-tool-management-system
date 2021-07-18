<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?php echo $title; ?></h1>
            <div class="section-header-button">
                <a href="<?php echo base_url('employee/add'); ?>" class="btn btn-warning">Add New</a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#" class="text-warning">Master Data</a></div>
                <div class="breadcrumb-item"><?php echo $title; ?></div>
            </div>
        </div>

        <div class="section-body">

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <?php if (isset($keyword)) : ?>
                                <h4 class="text-warning"><?php echo $title . '\'s data with keyword: "<b>' . $keyword . '</b>"'; ?></h4>
                            <?php else : ?>
                                <h4 class="text-warning">All <?php echo $title . 's'; ?></h4>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-striped" id="table4">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Employee Id</th>
                                            <th>Full Name</th>
                                            <th>Class</th>
                                            <th>Birth Date</th>
                                            <th>Email</th>
                                            <th>Phone Number / Whatsapp</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; ?>
                                        <?php foreach ($employees as $employee) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?php echo $employee['id']; ?>
                                                    <div class="table-links notexport">
                                                        <a href="<?php echo base_url('employee/view/' . $employee['id']); ?>">View</a>
                                                        <div class="bullet"></div>
                                                        <a href="<?php echo base_url('employee/edit/' . $employee['id']); ?>">Edit</a>
                                                        <div class="bullet"></div>
                                                        <a href="javascript:void(0)" data="<?php echo base_url('employee/delete/' . $employee['id']); ?>" class="delete-item">Trash</a>
                                                    </div>
                                                </td>
                                                <td><?php echo $employee['name']; ?></td>
                                                <td><?php echo $employee['class']; ?></td>
                                                <td><?php echo date("d/m/Y", strtotime($employee['birthdate'])); ?></td>
                                                <td><?php echo $employee['email']; ?></td>
                                                <td><?php echo $employee['phone']; ?></td>
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
    <script>
        $(".delete-item").on('click', (v) => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    window.location.href = $(v.target).attr('data');
                }
            })
        });
    </script>
</div>