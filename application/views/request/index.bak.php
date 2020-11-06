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
            <form action="<?php echo base_url('request'); ?>" method="POST">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-warning">Equipment Request Form</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Employee Id</label>
                                    <input type="text" class="form-control <?php if (form_error('employee_id')) echo 'is-invalid'; ?>" name="employee_id" id="employee_id" value="<?php echo set_value('employee_id'); ?>">
                                    <div class="invalid-feedback">
                                        <?php echo form_error('employee_id'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Employee Name</label>
                                    <input type="text" class="form-control <?php if (form_error('employee_name')) echo 'is-invalid'; ?>" name="employee_name" id="employee_name" value="<?php echo set_value('employee_name'); ?>" readonly>
                                    <div class="invalid-feedback">
                                        <?php echo form_error('employee_name'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" class="form-control datemask" name="date_picker" id="date_picker">
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-warning">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-warning">Equipments</h4>
                                <div class="card-header-action">
                                    <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-success btn-icon" id="btn-add-more">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        <button class="btn" disabled>
                                            <span id="total-equipment">1</span>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-icon" id="btn-remove-more" disabled>
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
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
                                            Make sure equipments are available.
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
                                            <tr>
                                                <td>
                                                    <div class="form-group pt-2">
                                                        <input type="text" class="form-control eq-id" id="eq-id-1" name="id[]" required autofocus>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group pt-2">
                                                        <input type="text" class="form-control eq-name" id="eq-name-1" name="name[]" readonly>
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
        // $(document).ready(() => {
        Date.prototype.toDateInputValue = (function() {
            var local = new Date(this);
            local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
            return local.toJSON().slice(0, 10);
        });
        $('#date_picker').val(new Date().toDateInputValue());

        $('#btn-add-more').on('click', () => {
            let total = parseInt($("#total-equipment").html());
            let nameField = $("#eq-name-" + total).val();

            if (nameField != '' && nameField != null) {
                total++;
                if (total > 1) {
                    $("#btn-remove-more").attr('disabled', false);
                }
                let form = '<tr>' +
                    '<td>' +
                    '<div class="form-group pt-2">' +
                    '<input type="text" class="form-control eq-id" id="eq-id-' + total + '" name="id[]" required>' +
                    '</div>' +
                    '</td>' +
                    '<td>' +
                    '<div class="form-group pt-2">' +
                    '<input type="text" class="form-control eq-name" id="eq-name-' + total + '" name="name[]" readonly>' +
                    '</div>' +
                    '</td>' +
                    '</tr>';
                $("#equipment-form").append(form);

                $("#eq-id-" + total).focus();
                $("#total-equipment").html(total);

                idKeyUp();
            }
        });

        $('#btn-remove-more').on('click', () => {
            let total = parseInt($("#total-equipment").html());
            if (total > 1) {
                total--;
                $('#equipment-form>tr:last-child').remove();
                $("#eq-id-" + total).focus();
                $("#total-equipment").html(total);
                idKeyUp();
            } else {
                $("#btn-remove-more").attr('disabled', true);
            }
        });

        $("#employee_id").on('keyup', (v) => {
            let id = $(v.target).val();
            $.ajax({
                url: '<?php echo base_url("request/findemployee"); ?>',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(data) {
                    $("#employee_name").val(data);
                }
            });
        });

        idKeyUp();

        function idKeyUp() {
            $("input[name='id[]']").on('keyup', (v) => {
                let idEq = $(v.target).val();
                let idField = $(v.target).attr('id').split('-');
                let idSplit = idField[2];
                findEquipment(idEq, idSplit);
            });
        }

        function findEquipment(id, index) {
            let equipmentName = $("#eq-name-" + index);
            $.ajax({
                url: '<?php echo base_url("request/findequipment"); ?>',
                type: 'POST',
                data: {
                    id: id,
                    status: 'Available'
                },
                success: function(data) {
                    equipmentName.val(data);
                }
            });
        }
        // });
    </script>
</div>