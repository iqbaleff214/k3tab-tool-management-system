<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?php echo $title; ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#" class="text-warning">Equipment Return</a></div>
                <div class="breadcrumb-item"><?php echo $title; ?></div>
            </div>
        </div>
        <div class="section-body">
            <form action="<?php echo base_url('request/return'); ?>" method="POST">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-warning">Equipments</h4>
                                <input type="hidden" id="total-equipment" value="1">
                            </div>
                            <div class="card-body p-0">
                                <?php if (validation_errors()) : ?>
                                    <div class="alert alert-warning alert-has-icon alert-dismissible show fade mr-4 ml-4">
                                        <button class="close" data-dismiss="alert">
                                            <span>×</span>
                                        </button>
                                        <div class="alert-icon"><i class="fas fa-exclamation-triangle"></i></div>
                                        <div class="alert-body">
                                            <div class="alert-title">Warning!</div>
                                            Make sure equipments are in use or borrowed.
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped">
                                        <thead id="equipment-form">
                                            <tr>
                                                <th>Equipment Id</th>
                                                <th>Description</th>
                                                <th>Request Date</th>
                                                <th>Return Date</th>
                                                <th>Employee</th>
                                                <th>Condition</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="form-group pt-2">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="eq-id-1" name="id[]" autocomplete="off" required autofocus>
                                                            <div class="input-group-append">
                                                                <button class="btn btn-danger disabled" type="button"><i class="fas fa-trash-alt"></i></button>
                                                            </div>
                                                            <input type="hidden" id="tr-eq-id-1" name="tr-id[]">
                                                            <input type="hidden" name="tool[]" id="eq-tool-1">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group pt-2">
                                                        <input type="text" class="form-control" id="eq-description-1" name="description[]" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group pt-2">
                                                        <input type="date" class="form-control" id="eq-request-1" name="request[]" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group pt-2">
                                                        <input type="date" class="form-control date_picker" id="eq-return-1" name="return[]">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group pt-2">
                                                        <input type="text" class="form-control" id="eq-employee-1" name="employee[]" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group pt-2">
                                                        <select class="form-control" name="condition[]" id="eq-stat-1">
                                                            <option value="Good">Good</option>
                                                            <option value="Damaged">Damaged</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <button class="m-4 btn btn-warning" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <script>
        Date.prototype.toDateInputValue = (function() {
            var local = new Date(this);
            local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
            return local.toJSON().slice(0, 10);
        });
        setDate();

        keyUp();

        function addField() {
            let total = parseInt($("#total-equipment").val());
            let nameField = $("#eq-employee-" + total).val();
            if (nameField != '' && nameField != null) {
                total++;
                let form = '<tr>' +
                    '<td>' +
                    '<div class="form-group pt-2">' +
                    '<div class="input-group">' +
                    '<input type="text" class="form-control" id="eq-id-' + total + '" name="id[]" autocomplete="off" autofocus>' +
                    '<input type="hidden" name="tool[]" id="eq-tool-' + total + '">' +
                    '<div class="input-group-append">' +
                    '<button class="btn btn-danger btn-remove-field" type="button"><i class="fas fa-trash-alt"></i></button>' +
                    '</div>' +
                    '<input type="hidden" id="tr-eq-id-' + total + '" name="tr-id[]">' +
                    '</div>' +
                    '</td>' +
                    '<td>' +
                    '<div class="form-group pt-2">' +
                    '<input type="text" class="form-control" id="eq-description-' + total + '" name="description[]" readonly>' +
                    '</div>' +
                    '</td>' +
                    '<td>' +
                    '<div class="form-group pt-2">' +
                    '<input type="date" class="form-control" id="eq-request-' + total + '" name="request[]" readonly>' +
                    '</div>' +
                    '</td>' +
                    '<td>' +
                    '<div class="form-group pt-2">' +
                    '<input type="date" class="form-control date_picker" id="eq-return-' + total + '" name="return[]">' +
                    '</div>' +
                    '</td>' +
                    '<td>' +
                    '<div class="form-group pt-2">' +
                    '<input type="text" class="form-control" id="eq-employee-' + total + '" name="employee[]" readonly>' +
                    '</div>' +
                    '</td>' +
                    '<td>' +
                    '<div class="form-group pt-2">' +
                    '<select class="form-control" name="condition[]" id="eq-stat-' + total + '">' +
                    '<option value="Good">Good</option>' +
                    '<option value="Damaged">Damaged</option>' +
                    '</select>' +
                    '</div>' +
                    '</td>' +
                    '</tr>';
                $("#equipment-form").append(form);
                $("#eq-id-" + total).focus();
                $("#total-equipment").val(total);
                setDate();
                keyUp();
            }
        }

        function removeField(field) {
            $(field).parents('tr').remove();
        }

        function keyUp() {
            $("input[name='id[]']").on('input', (v) => {
                let idEq = $(v.target).val();
                idEq = idEq.trim()
                let idField = $(v.target).attr('id').split('-');
                let idSplit = idField[2];
                findRequest(idEq, idSplit);
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

            $(document).keypress((e) => {
                if (e.key == " ") {
                    // $("form").submit();
                }
            });
        }

        function findRequest(id, index) {
            let requestDatepicker = $("#eq-request-" + index);
            let requestIdTag = $("#tr-eq-id-" + index);
            $.ajax({
                url: '<?php echo base_url("request/findrequest"); ?>',
                type: 'POST',
                data: {
                    id: id,
                },
                success: function(data) {
                    let req = data.split('%%');
                    if (req.length > 1) {
                        let ids = '';
                        req.forEach(element => {
                            let request = element.split('$');
                            if (request[0]) {
                                ids += "#" + request[0];
                                let requestDate = request[3];
                                let requestEmpId = request[1];
                                requestDatepicker.val(requestDate);
                                findEmployee(requestEmpId, index);
                            }
                        });
                        requestIdTag.val(ids);
                    } else {
                        let request = data.split('$');
                        let requestId = request[0];
                        let requestDate = request[3];
                        let requestEmpId = request[1];
                        requestIdTag.val(requestId);
                        requestDatepicker.val(requestDate);
                        findEmployee(requestEmpId, index);
                    }
                    findEquipment(id, index);
                }
            });
        }

        function findEquipment(id, index) {
            let equipmentName = $("#eq-description-" + index);
            let equipmentTool = $("#eq-tool-" + index);
            $.ajax({
                url: '<?php echo base_url("request/findequipment"); ?>',
                type: 'POST',
                data: {
                    id: id,
                    status: 'In Use'
                },
                success: function(data) {
                    if (data != '') {
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

        function findEmployee(id, index) {
            let employeeName = $("#eq-employee-" + index);
            $.ajax({
                url: '<?php echo base_url("request/findemployee"); ?>',
                type: 'POST',
                data: {
                    id: id,
                },
                success: function(data) {
                    employeeName.val(data);
                }
            });
        }

        function setDate() {
            $('.date_picker').val(new Date().toDateInputValue());
        }
    </script>
</div>