<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?php echo $title; ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#" class="text-warning">Dashboard</a></div>
                <div class="breadcrumb-item"><?php echo $title; ?></div>
            </div>
        </div>
        <div class="section-body">
            <?php $monthDay = ""; ?>
            <?php $monthVal = null; ?>
            <?php foreach ($monthGraphs as $graph) : ?>
                <?php $monthDay .= "'" . $graph['date'] . "/" . date('m', time()) . "', "; ?>
                <?php $monthVal .= $graph['total'] . ", "; ?>
            <?php endforeach; ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-warning">Used Equipments</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th>Equipment Id</th>
                                            <th>Description</th>
                                            <th>Manufacture</th>
                                            <!-- <th>Material</th> -->
                                            <th>Type</th>
                                            <th>Status</th>
                                        </tr>
                                        <?php foreach ($equipments as $equipment) : ?>
                                            <tr>
                                                <td><?php echo $equipment['id']; ?>
                                                    <div class="table-links">
                                                        <a href="<?php echo base_url('equipment/view/' . $equipment['id']); ?>">View</a>
                                                        <div class="bullet"></div>
                                                        <a href="<?php echo base_url('equipment/edit/' . $equipment['id']); ?>">Edit</a>
                                                        <div class="bullet"></div>
                                                        <a href="javascript:void(0)" data="<?php echo base_url('equipment/delete/' . $equipment['id']); ?>" class="delete-item">Trash</a>
                                                    </div>
                                                </td>
                                                <td><?php echo $equipment['description']; ?></td>
                                                <td><?php echo $equipment['manufacture']; ?></td>
                                                <td><?php echo $equipment['type']; ?></td>
                                                <td>
                                                    <?php if ($equipment['toolbox']) : ?>
                                                        <div class="badge badge-pill badge-info mb-1 float-right">Toolbox Only</div>
                                                    <?php else : ?>
                                                        <?php if ($equipment['status'] == 'Available') : ?>
                                                            <div class="badge badge-pill badge-success mb-1 float-right">Available</div>
                                                        <?php elseif ($equipment['status'] == 'Maintenance') : ?>
                                                            <div class="badge badge-pill badge-warning mb-1 float-right">Maintenance</div>
                                                        <?php elseif ($equipment['status'] == 'Broken') : ?>
                                                            <div class="badge badge-pill badge-danger mb-1 float-right">Broken</div>
                                                        <?php else : ?>
                                                            <div class="badge badge-pill badge-primary mb-1 float-right"><?php echo $equipment['status']; ?></div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
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
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-warning">Request Statistic by Equipment Id</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="equipmentChart" height="182"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-warning">Request Data</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Description</th>
                                            <th>Request</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $equipments = ""; ?>
                                        <?php $values = null; ?>
                                        <?php foreach ($graphs as $graph) : ?>
                                            <tr>
                                                <td><?php echo $graph['id']; ?></td>
                                                <td><?php echo $graph['equipment']; ?></td>
                                                <td><?php echo $graph['total']; ?></td>
                                            </tr>
                                            <?php $equipments .= "'" . $graph['id'] . "', "; ?>
                                            <?php $values .= $graph['total'] . ", "; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-warning"><?php echo date('F Y', time()); ?> Request by Date</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="monthChart" height="250"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        var equipChart = document.getElementById('equipmentChart').getContext('2d');
        var chartEq = new Chart(equipChart, {
            type: 'bar',
            data: {
                labels: [<?php echo $equipments; ?>],
                datasets: [{
                    label: 'Equipment request',
                    data: [<?php echo $values; ?>],
                    borderWidth: 2,
                    borderColor: 'rgb(252, 168, 3)',
                    backgroundColor: 'rgb(252, 168, 3)',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
                }]
            },
            options: {
                // responsive: true,
                // maintainAspectRatio: false,
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            drawBorder: false,
                            color: '#f2f2f2',
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            // display: false
                        },
                        gridLines: {
                            display: false
                        }
                    }]
                },
            }
        });

        var monthChart = document.getElementById('monthChart').getContext('2d');
        var chartMonth = new Chart(monthChart, {
            type: 'line',
            data: {
                labels: [<?php echo $monthDay; ?>],
                datasets: [{
                    label: 'Request',
                    borderColor: 'rgb(252, 168, 3)',
                    backgroundColor: 'rgb(252, 168, 3)',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4,
                    borderWidth: 2,
                    data: [<?php echo $monthVal; ?>],
                    height: 130
                }]
            },
            options: {
                legend: {
                    display: false
                },
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        gridLines: {
                            drawBorder: false,
                            color: '#f2f2f2',
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            // display: false
                        },
                        gridLines: {
                            display: false
                        }
                    }]
                },
            }
        });
    </script>
</div>