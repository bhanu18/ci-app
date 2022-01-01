<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <?php if($current_month_pieces): ?>
                        <h3><?php echo $current_month_pieces[0]->Piece; ?></h3>

                        <p><?php echo $current_month_pieces[0]->Month; ?> Piece Sold</p>
                        <?php else: ?>
                        <h3>0</h3>
                        <p><?php echo Date("M"); ?> Piece Sold</p>
                        <?php endif;?>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <?php if($current_month): ?>
                        <h3>&#3647; <?php echo $current_month[0]->sales; ?></h3>

                        <p><?php echo $current_month[0]->Month; ?> Sales</p>
                        <?php else: ?>
                        <h3>0</h3>
                        <p><?php echo Date("M"); ?> Sales</p>
                        <?php endif;?>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <?php if($avg_month_sale): ?>
                        <h3>&#3647; <?php echo $avg_month_sale[0]->avg_month; ?></h3>
                        <?php else: ?>
                        <h3>0</h3>
                        <?php endif; ?>
                        <p>Average Sales this month</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <?php if($avg_month_pieces): ?>
                        <h3><?php echo $avg_month_pieces[0]->avg_piece; ?></h3>
                        <?php else: ?>
                        <h3>0</h3>
                        <?php endif; ?>
                        <p>Average Pieces Sold</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
            </div>
            <!-- ./col -->
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="card card-primary">
                    <div class="card-body p-0">
                        <!-- THE CALENDAR -->
                        <div id="calendar"></div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                        <h3 class="card-title">
                            <i class="fas fa-th mr-1"></i>
                            Daily Sales
                        </h3>
                    </div>
                    <div class="chart">
                        <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                        <h3 class="card-title">
                            <i class="fas fa-th mr-1"></i>
                            Trending Products
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="card-body">
                            <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-6 col-sm-12">

        </div>
    </div>
    <!-- row ending -->
    </div>
    <!-- /.container-fluid -->

</section>
<!-- /.content -->
</div>
<!-- jQuery -->
<script src="<?php echo site_url('public/Asset/plugins/jquery/jquery.min.js');?>"></script>
<!-- Page specific script -->
<script>
$(function() {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
        ele.each(function() {

            // create an Event Object (https://fullcalendar.io/docs/event-object)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            }

            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject)

            // // make the event draggable using jQuery UI
            // $(this).draggable({
            //     zIndex: 1070,
            //     revert: true, // will cause the event to go back to its
            //     revertDuration: 0 //  original position after the drag
            // })

        })
    }

    ini_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/

    var Calendar = FullCalendar.Calendar;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

    var calendar = new Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        themeSystem: 'bootstrap',
        //Random default events
        events: [
            <?php if($calendar):
                foreach ($calendar as $sale):?> {
                title: '<?php echo $sale->total_sales; ?>',
                start: '<?php echo $sale->date; ?>',
                backgroundColor: '#f56954', //red
                borderColor: '#f56954', //red
                allDay: true

            },
            <?php endforeach;?>
            <?php endif; ?>
        ],
    });

    calendar.render();

})
$(function() {
    var areaChartData = {
        labels: [
            <?php if($calendar) {foreach($calendar as $sale): echo " '".$sale->date."',"; endforeach;}?>
        ],
        datasets: [{
            label: 'Daily Sale',
            backgroundColor: 'rgba(60,141,188,0.9)',
            borderColor: 'rgba(60,141,188,0.8)',
            pointRadius: true,
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data: [
                <?php if($calendar) {foreach ($calendar as $sale):?><?php echo $sale->total_sales.","; endforeach;}?>
            ]
        }]
    }

    var areaChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            display: false
        },
        scales: {
            xAxes: [{
                gridLines: {
                    display: true,
                }
            }],
            yAxes: [{
                gridLines: {
                    display: true,
                }
            }]
        }
    }

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    // var temp1 = areaChartData.datasets[1]
    // barChartData.datasets[0] = temp1
    barChartData.datasets[0] = temp0

    var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false,
        legend: false
    }

    new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
    })

    var donutData = {
        labels: [
            <?php if($trend_sale) foreach($trend_sale as $sales): echo "'".$sales->products."',"; endforeach;?>
        ],
        datasets: [{
            data: [
                <?php if($trend_sale) foreach($trend_sale as $sales): echo $sales->Count.","; endforeach;?>],
            backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }]
    }

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData = donutData;
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