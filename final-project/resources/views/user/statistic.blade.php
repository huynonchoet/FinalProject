@extends('user.layouts.app')
@section('content')
    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="heading-page header-text">
        <section class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-content">
                            <h2>Statistic Lanlord.</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- AREA CHART -->
                        <div class="card card-primary">
                            <div class="card-header text-center">
                                <h3 class="card-title">Statistic By Month</h3>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="areaChart"
                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="col-md-6">
                        <!-- /.card -->
                        <!-- PIE CHART -->
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Statistic By Homestay</h3>
                            </div>
                            <div class="card-body">
                                <canvas id="pieChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                    <div class="col-md-6">
                        <!-- DONUT CHART -->
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Statistic By Type Room</h3>
                            </div>
                            <div class="card-body">
                                <canvas id="donutChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        <div class="card-header text-center">
            <h3 class="card-title">Statistic By Month</h3>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-1">
                        Month
                    </th>
                    <th class="col-1">
                        1
                    </th>
                    <th class="col-1">
                        2
                    </th>
                    <th class="col-1">
                        3
                    </th>
                    <th class="col-1">
                        4
                    </th>
                    <th class="col-1">
                        5
                    </th>
                    <th class="col-1">
                        6
                    </th>
                    <th class="col-1">
                        7
                    </th>
                    <th class="col-1">
                        8
                    </th>
                    <th class="col-1">
                        9
                    </th>
                    <th class="col-1">
                        10
                    </th>
                    <th class="col-1">
                        11
                    </th>
                    <th class="col-1">
                        12
                    </th>
                </tr>
            </thead>
        </table>
        <table class="table table-striped">
            <tbody>
                <td class="col-1">Money (VNĐ)</td>
                @foreach (json_decode($dataStatisticByMonth) as $item)
                        <td class="col-1">{{ number_format($item) }}</td>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        $(function() {
            var dataStatisticByMonth = <?php echo $dataStatisticByMonth; ?>;
            var dataStatisticByTypeRoom = <?php echo $dataStatisticByTypeRoom; ?>;
            var typeRoom = <?php echo $typeRoom; ?>;
            var dataStatisticByHomestay = <?php echo $dataStatisticByHomestay; ?>;
            var homestay = <?php echo $homestay; ?>;
            console.log(homestay);
            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */
            //--------------
            //- AREA CHART -
            //--------------

            // Get context with jQuery - using jQuery's .get() method.
            var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

            var areaChartData = {
                labels: ["January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"
                ],
                datasets: [{
                        label: 'Digital Goods',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: dataStatisticByMonth,
                    },
                    {},
                ]
            }

            var areaChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                responsiveAnimationDuration: 0,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function(value, index, values) {
                                return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") +
                                    ' VNĐ';
                            }
                        },
                    }]
                }
            }

            // This will get the first returned node in the jQuery collection.
            new Chart(areaChartCanvas, {
                type: 'line',
                data: areaChartData,
                options: areaChartOptions
            })

            //-------------
            //- DONUT CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
            var donutData = {
                labels: typeRoom,
                datasets: [{
                    data: dataStatisticByTypeRoom,
                    backgroundColor: ['#00a65a', '#f56954', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                }]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })

            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieData = {
                labels: homestay,
                datasets: [{
                    data: dataStatisticByHomestay,
                    backgroundColor: ['#00a65a', '#f56954', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                }]
            }
            var pieOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            })
        })
    </script>
@endsection
@section('css')
@endsection
