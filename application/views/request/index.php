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
                                    <label>Employee Name</label>
                                    <input type="text" class="form-control <?php if (form_error('employee_name')) echo 'is-invalid'; ?>" name="employee_name" id="employee_name" value="<?php echo set_value('employee_name'); ?>" autofocus>
                                    <div class="invalid-feedback">
                                        <?php echo form_error('employee_name'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Employee Id</label>
                                    <input type="text" class="form-control <?php if (form_error('employee_id')) echo 'is-invalid'; ?>" name="employee_id" id="employee_id" value="<?php echo set_value('employee_id'); ?>" readonly>
                                    <div class="invalid-feedback">
                                        <?php echo form_error('employee_id'); ?>
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
                                                        <div class="input-group">
                                                            <input type="text" class="form-control eq-id" id="eq-id-1" name="id[]" autocomplete="off" required>
                                                            <input type="hidden" name="tool[]" id="eq-tool-1">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-danger disabled" type="button"><i class="fas fa-trash-alt"></i></button>
                                                            </div>
                                                        </div>
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
        keyUp();
        employeeName('');
        // $(document).ready(() => {
        Date.prototype.toDateInputValue = (function() {
            var local = new Date(this);
            local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
            return local.toJSON().slice(0, 10);
        });
        $('#date_picker').val(new Date().toDateInputValue());


        function addField() {
            let total = parseInt($("#total-equipment").val());
            let nameField = $("#eq-name-" + total).val();

            if (nameField != '' && nameField != null) {
                total++;
                let form = '<tr>' +
                    '<td>' +
                    '<div class="form-group pt-2">' +
                    '<div class="input-group">' +
                    '<input type="text" class="form-control eq-id" id="eq-id-' + total + '" name="id[]" autocomplete="off" >' +
                    '<input type="hidden" name="tool[]" id="eq-tool-' + total + '">' +
                    '<div class="input-group-append">' +
                    '<button class="btn btn-danger btn-remove-field" type="button"><i class="fas fa-trash-alt"></i></button>' +
                    '</div>' +
                    '</div>' +
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
                $("#total-equipment").val(total);

                keyUp();
            }
        }

        function removeField(field) {
            $(field).parents('tr').remove();
        }

        function employeeName(name) {
            $.ajax({
                url: "<?php echo base_url('request/get_autocomplete') ?>",
                type: 'POST',
                data: {
                    name: name
                },
                dataType: "json",
                success: (data) => {
                    $("#employee_name").autocomplete({
                        source: data,
                        select: (event, ui) => {
                            findEmployee(ui.item.value);
                        }
                    })
                }
            });
        }

        function keyUp() {
            $("input[name='id[]']").on('input', (v) => {
                let idEq = $(v.target).val();
                idEq = idEq.trim()
                let idField = $(v.target).attr('id').split('-');
                let idSplit = idField[2];
                findEquipment(idEq, idSplit);
            });

            $("input").keypress(function(event) {
                if (event.which == 10 || event.which == 13 || event.which == 32) {
                    event.preventDefault();
                    return false;
                }
            });

            $('.btn-remove-field').on('click', (v) => {
                removeField(v.target);
            });

            $("#employee_name").on('keyup', (v) => {
                let name = $(v.target).val();
                employeeName(name);
            });

            $(document).keypress((e) => {
                if (e.key == " ") {
                    // $("form").submit();
                }
            });
        }

        function findEmployee(name) {
            $.ajax({
                url: '<?php echo base_url("request/findemployeeid"); ?>',
                type: 'POST',
                data: {
                    name: name
                },
                success: function(data) {
                    $("#employee_id").val(data);
                    $("#eq-id-1").focus();
                }
            });
        }

        function findEquipment(id, index) {
            let equipmentName = $("#eq-name-" + index);
            let equipmentTool = $("#eq-tool-" + index);
            $.ajax({
                url: '<?php echo base_url("request/findequipment"); ?>',
                type: 'POST',
                data: {
                    id: id,
                    status: 'Available'
                },
                success: function(data) {
                    if (data) {
                        let newData = data.split("%%")
                        equipmentName.val(newData[0]);
                        equipmentTool.val(newData[1]);
                        addField();
                    } else {
                        equipmentName.val(data);
                        equipmentTool.val(data);
                    }
                }
            });
        }
        // });
    </script>
</div>