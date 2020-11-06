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
                <div class="breadcrumb-item"><?php echo $title; ?></div>
            </div>
        </div>

        <div class="section-body">
            <form method="POST" action="<?php echo base_url('toolbox/edit/' . $toolbox['id']); ?>">
                <div class="row">
                    <div class="col-7">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-warning">Fill Toolbox's Data</h4>
                            </div>

                            <div class="card-body">
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Toolbox Id</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control <?php if (form_error('id')) echo 'is-invalid'; ?>" name="id" id="txt-id" value="<?php echo $toolbox['id']; ?>" readonly>
                                        <div class="invalid-feedback">
                                            <?php echo form_error('id'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Decription of Toolbox</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control <?php if (form_error('description')) echo 'is-invalid'; ?>" name="description" id="txt-description" value="<?php echo $toolbox['description']; ?>" autofocus>
                                        <div class="invalid-feedback">
                                            <?php echo form_error('description'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control selectric" name="status" id="txt-status">
                                            <option value="Available" <?php if ($toolbox['status'] == 'Available') echo 'selected'; ?>>Available</option>
                                            <option value="Maintenance" <?php if ($toolbox['status'] == 'Maintenance') echo 'selected'; ?>>Maintenance</option>
                                            <option value="Lost" <?php if ($toolbox['status'] == 'Lost') echo 'selected'; ?>>Broken</option>
                                            <option value="In Use" <?php if ($toolbox['status'] == 'In Use') echo 'selected'; ?>>In Use</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Note</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="note" id="txt-note" value="<?php echo $toolbox['note']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-warning" type="submit">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-warning">Equipments</h4>
                                <input id="total-equipment" type="hidden" value="1">
                            </div>
                            <div class="card-body p-0">
                                <?php if (validation_errors()) : ?>
                                    <div class="alert alert-warning alert-has-icon alert-dismissible show fade mr-4 ml-4">
                                        <button class="close" data-dismiss="alert">
                                            <span>×</span>
                                        </button>
                                        <div class="alert-icon"><i class="fas fa-exclamation-triangle"></i></i></div>
                                        <div class="alert-body">
                                            <div class="alert-title">Warning!</div>
                                            Make sure equipments are not in other Toolbox.
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped">
                                        <tbody id="equipment-form">
                                            <tr>
                                                <th>Equipment Id</th>
                                                <th>Description</th>
                                            </tr>
                                            <?php foreach ($equipments as $equipment) : ?>
                                                <tr>
                                                    <td>
                                                        <div class="form-group pt-2">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="id_eq" value="<?php echo $equipment['id']; ?>" readonly>
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-danger delete-equipment-btn" type="button" value="<?php echo $equipment['id']; ?>"><i class="fas fa-trash-alt"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group pt-2">
                                                            <input type="text" class="form-control" name="desc_eq" value="<?php echo $equipment['description']; ?>" readonly>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td>
                                                    <div class="form-group pt-2">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control eq-id" id="eq-id-1" name="id-e[]">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-danger" type="button"><i class="fas fa-trash-alt"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group pt-2">
                                                        <input type="text" class="form-control eq-name" id="eq-name-1" name="desc-e[]" readonly>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <script>
        keyUp();

        function keyUp() {
            $("input").keypress(function(event) {
                if (event.which == 10 || event.which == 13 || event.which == 32) {
                    event.preventDefault();
                    return false;
                }
            });
            $("input[name='id-e[]']").on('keyup', (v) => {
                let idEq = $(v.target).val();
                idEq = idEq.trim();
                let idField = $(v.target).attr('id').split('-');
                let idSplit = idField[2];
                findEquipment(idEq, idSplit);
            });
            $('.btn-remove-field').on('click', (v) => {
                removeField(v.target);
            });
            $('button.delete-equipment-btn').on('click', (v) => {
                let target = v.target;
                let id = $(target).val()
                console.log(id);
                if (id) {
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
                            removeEquipment(id);
                        }
                    })
                }
            });
        }

        function findEquipment(id, index) {
            let equipmentName = $("#eq-name-" + index);
            $.ajax({
                url: '<?php echo base_url("toolbox/findequipment"); ?>',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(data) {
                    equipmentName.val(data);
                    if (data) {
                        addField();
                    }
                }
            });
        }

        function addField() {
            let total = parseInt($("#total-equipment").val());
            let nameField = $("#eq-name-" + total).val();

            if (nameField != '' && nameField != null) {
                total++;
                let form = '<tr>' +
                    '<td>' +
                    '<div class="form-group pt-2">' +
                    '<div class="input-group">' +
                    '<input type="text" class="form-control eq-id" id="eq-id-' + total + '" name="id-e[]">' +
                    '<div class="input-group-append">' +
                    '<button class="btn btn-danger btn-remove-field" type="button"><i class="fas fa-trash-alt"></i></button>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</td>' +
                    '<td>' +
                    '<div class="form-group pt-2">' +
                    '<input type="text" class="form-control eq-name" id="eq-name-' + total + '" name="desc-e[]" readonly>' +
                    '</div>' +
                    '</td>' +
                    '</tr>';
                $("#equipment-form").append(form);

                $("#eq-id-" + total).focus();
                $("#total-equipment").val(total);

                keyUp();
            }
        }

        function removeEquipment(id) {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('toolbox/deleteequipment') ?>',
                data: {
                    id: id
                },
                success: (data) => {
                    // console.log(data);
                    if (data === "success") {
                        location.reload();
                    }
                }
            });
        }
    </script>
</div>