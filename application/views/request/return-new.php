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
                                                            <input type="text" class="form-control input_id" name="id[]" autocomplete="off" required autofocus>
                                                            <div class="input-group-append">
                                                                <button class="btn btn-danger disabled" type="button"><i class="fas fa-trash-alt"></i></button>
                                                            </div>
                                                            <input type="hidden" class="input_tr_id" name="tr-id[]">
                                                            <input type="hidden" class="input_tool" name="tool[]">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group pt-2">
                                                        <input type="text" class="form-control input_description" name="description[]" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group pt-2">
                                                        <input type="date" class="form-control input_request" name="request[]" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group pt-2">
                                                        <input type="date" class="form-control date_picker" name="return[]">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group pt-2">
                                                        <input type="text" class="form-control input_employee" name="employee[]" readonly>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group pt-2">
                                                        <select class="form-control" name="condition[]">
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

        $(document).ready(function() {

            setDate();

            $(document).on('input', "input.input_id", function(e) {
                const eqId = $(this).val();
                const tr = $(this).closest('tr');
                $.ajax({
                    url: "<?= base_url('request/ajaxequipment') ?>/" + eqId,
                    method: "GET",
                    success: function(res) {
                        if (res) {
                            res = JSON.parse(res);
                            console.log(res);
                            tr.find('.input_description').val(res.description);
                            tr.find('.input_request').val(res.booking_date);
                            tr.find('.input_employee').val(res.name);
                            let tool, id;
                            if (res.tool) {
                                tool = 'toolbox';
                                id = res.id_transaksi;
                            } else {
                                tool = 'equipment';
                                id = res.id;
                            }
                            tr.find('.input_tr_id').val(id);
                            tr.find('.input_tool').val(tool);

                            addField();
                            $(document).find('.input_id').last().focus();
                            setDate();
                        }
                    }
                });
            });

            $(document).on('click', '.btn-delete-row', function() {
                $(this).closest('tr').remove();
            });
        });

        function addField() {
            const row = `<tr>
                            <td>
                                <div class="form-group pt-2">
                                    <div class="input-group">
                                        <input type="text" class="form-control input_id" name="id[]" autocomplete="off" autofocus>
                                        <div class="input-group-append">
                                            <button class="btn btn-danger btn-delete-row" type="button"><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                        <input type="hidden" class="input_tr_id" name="tr-id[]">
                                        <input type="hidden" class="input_tool" name="tool[]">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group pt-2">
                                    <input type="text" class="form-control input_description" name="description[]" readonly>
                                </div>
                            </td>
                            <td>
                                <div class="form-group pt-2">
                                    <input type="date" class="form-control input_request" name="request[]" readonly>
                                </div>
                            </td>
                            <td>
                                <div class="form-group pt-2">
                                    <input type="date" class="form-control date_picker" name="return[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-group pt-2">
                                    <input type="text" class="form-control input_employee" name="employee[]" readonly>
                                </div>
                            </td>
                            <td>
                                <div class="form-group pt-2">
                                    <select class="form-control" name="condition[]">
                                        <option value="Good">Good</option>
                                        <option value="Damaged">Damaged</option>
                                    </select>
                                </div>
                            </td>
                        </tr>`;
            $('tbody').append(row);
        }

        Date.prototype.toDateInputValue = (function() {
            var local = new Date(this);
            local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
            return local.toJSON().slice(0, 10);
        });

        function setDate() {
            $('.date_picker').val(new Date().toDateInputValue());
        }
    </script>
</div>