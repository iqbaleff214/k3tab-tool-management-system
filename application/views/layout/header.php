<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= $title ?> - Tool Management System</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/jquery-ui.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/fa/css/all.css'); ?>">

    <!-- CSS Libraries -->

    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/components.css') ?>">




    <!-- General JS Scripts -->
    <script src="<?= base_url('assets/vendor/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/nicescroll.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/moment.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/sweetalert2.all.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/jquery-ui.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/chartjs/Chart.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/stisla.js') ?>"></script>

    <!-- JS Libraies -->
    <!-- DataTables  & Plugins -->
    <script src="<?= base_url('assets/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/datatables-buttons/js/buttons.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/jszip/jszip.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/pdfmake/pdfmake.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/pdfmake/vfs_fonts.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/datatables-buttons/js/buttons.html5.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/datatables-buttons/js/buttons.print.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/datatables-buttons/js/buttons.colVis.min.js') ?>"></script>


    <!-- Template JS File -->
    <script src="<?php echo base_url('assets/js/scripts.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/custom.js') ?>"></script>

    <!-- Page Specific JS File -->
    <script>
        $(document).ready(function() {
            var table1 = $('#table1').DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                buttons: [ 
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        }
                    },
                    {
                        extend: 'excel',
                        text: 'Excel',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        }
                    },
                    {
                        extend: 'pdf',
                        text: 'PDF',
                        orientation: 'landscape',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        },
                        customize: function (doc) {
                            doc.content[1].table.widths = 
                                Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                        }
                    },
                    {
                        extend: 'colvis',
                        text: 'Kolom',
                    },
                ]
            });
            table1.buttons().container().appendTo('#table1_wrapper .col-md-6:eq(0)');

            var table2 = $('.table2').DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false, "searching": false,
            });

            var table3 = $('.table3').DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
            });
            
            var table4 = $('#table4').DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                buttons: [ 
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        }
                    },
                    {
                        extend: 'excel',
                        text: 'Excel',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        }
                    },
                    {
                        extend: 'pdf',
                        text: 'PDF',
                        orientation: 'landscape',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        },
                        customize: function (doc) {
                            doc.content[1].table.widths = 
                                Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                        }
                    },
                    {
                        extend: 'colvis',
                        text: 'Kolom',
                    },
                ]
            });
            table4.buttons().container().appendTo('#table4_wrapper .col-md-6:eq(0)');

            var deleted_history = [];

            $('#table1 tbody').on( 'click', 'tr', function () {
                $(this).toggleClass('bg-primary text-white');
                $(this).find('a').toggleClass('text-white');
                const id = $(this).data('id');
                if (deleted_history.includes(id)) {
                    deleted_history = deleted_history.filter((e) => e != id);
                } else {
                    deleted_history.push(id);
                }
            } );

            var select_status = 1;

            $('#select-all').on('click', function() {
                $('tbody tr').toggleClass('bg-primary text-white');
                $('tbody tr a').toggleClass('text-white');
                if (select_status == 1) {
                    $('tbody tr').each(function(i, e) {
                        const id = $(this).data('id');
                        deleted_history.push(id);
                    });
                    $(this).html('Unselect All');
                    select_status = 0;
                } else {
                    deleted_history.length = 0;
                    $(this).html('Select All');
                    select_status = 1;
                }
            });

            $('#delete-all').on('click', function() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value && deleted_history.length >= 1) {
                        $.ajax({
                            url: "<?= base_url('request/history') ?>",
                            type: 'post',
                            data: {
                                ids: deleted_history
                            }, 
                            success: function(res) {
                                if (res == true) {
                                    table1.rows('.bg-primary').remove().draw(false);
                                } else {
                                    alert('Failed to delete selected history');
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>

</head>