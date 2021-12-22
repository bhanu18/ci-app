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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title mt-2">Trending Products</h3>
                        <div class="card-tools">
                            <a href="<?php echo site_url('/sale');?>" class="btn btn-primary float-right"><i
                                    class="fas fa-binoculars"></i> View</a>
                            <a href="<?php echo site_url('/sale/add');?>" class="btn btn-primary float-right"><i
                                    class="fas fa-plus"></i> Add</a> &#160;
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="sale-table" class="table table-head-fixed text-nowrap">
                            <thead>
                                <tr>
                                    
                                    <th scope="col">Name</th>
                                    <th scope="col">Pieces Sold</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($sale):?>
                                <?php foreach($sale as $sales):?>
                                <tr>
                                   
                                    <td><?php echo $sales['product'];?></td>
                                    <td><?php echo $sales['Count'];?></td>
                                </tr>
                                <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                        <h3 class="card-title">
                            <i class="fas fa-th mr-1"></i>
                            Monthly Sales
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="lineChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
                        <h3 class="card-title">
                            <i class="fas fa-th mr-1"></i>
                            Daily Sales
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="barChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title mt-2">Products</h3>
                        <div class="card-tools">
                            <a href="<?php echo site_url('/product');?>" class="btn btn-primary float-right"><i
                                    class="fas fa-binoculars"></i> View </a>
                            <a href="<?php echo site_url('/product/add');?>" class="btn btn-primary float-right"><i
                                    class="fas fa-plus"></i> Add</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="product-table" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Quantiy</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($products)):?>
                                <?php foreach($products as $product):?>
                                <tr>
                                    <td><?php echo $product['ID']; ?> </td>
                                    <td><?php echo $product['Name']; ?> </td>
                                    <td><?php echo $product['Quantity']; ?> </td>
                                    <td><?php echo $product['Price']; ?> </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon"
                                                data-toggle="dropdown">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu">
                                                <a class="btn btn-primary dropdown-item"
                                                    href="<?php echo site_url('product/edit/').$product['ID'];?>">Edit</a>
                                            </div>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                                <?php endif; ?>
                            </tbody>
                        </table>
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
<script src="<?php echo site_url('/Asset/plugins/jquery/jquery.min.js');?>"></script>
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
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear()

    var Calendar = FullCalendar.Calendar;
    // var Draggable = FullCalendar.Draggable;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

    // initialize the external events
    // -----------------------------------------------------------------

    // new Draggable(containerEl, {
    //     itemSelector: '.external-event',
    //     eventData: function(eventEl) {
    //         return {
    //             title: eventEl.innerText,
    //             backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue(
    //                 'background-color'),
    //             borderColor: window.getComputedStyle(eventEl, null).getPropertyValue(
    //                 'background-color'),
    //             textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
    //         };
    //     }
    // });

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
            // {
            //     title: 'All Day Event',
            //     start: new Date(y, m, 1),
            //     backgroundColor: '#f56954', //red
            //     borderColor: '#f56954', //red
            //     allDay: true
            // },
            // {
            //     title: 'Long Event',
            //     start: new Date(y, m, d - 5),
            //     end: new Date(y, m, d - 2),
            //     backgroundColor: '#f39c12', //yellow
            //     borderColor: '#f39c12' //yellow
            // },
            // {
            //     title: 'Meeting',
            //     start: new Date(y, m, d, 10, 30),
            //     allDay: false,
            //     backgroundColor: '#0073b7', //Blue
            //     borderColor: '#0073b7' //Blue
            // },
            // {
            //     title: 'Lunch',
            //     start: new Date(y, m, d, 12, 0),
            //     end: new Date(y, m, d, 14, 0),
            //     allDay: false,
            //     backgroundColor: '#00c0ef', //Info (aqua)
            //     borderColor: '#00c0ef' //Info (aqua)
            // },
            // {
            //     title: 'Birthday Party',
            //     start: new Date(y, m, d + 1, 19, 0),
            //     end: new Date(y, m, d + 1, 22, 30),
            //     allDay: false,
            //     backgroundColor: '#00a65a', //Success (green)
            //     borderColor: '#00a65a' //Success (green)
            // },
            // {
            //     title: 'Click for Google',
            //     start: new Date(y, m, 28),
            //     end: new Date(y, m, 29),
            //     url: 'https://www.google.com/',
            //     backgroundColor: '#3c8dbc', //Primary (light-blue)
            //     borderColor: '#3c8dbc' //Primary (light-blue)
            // }
        ],
        // editable: true,
        // droppable: true, // this allows things to be dropped onto the calendar !!!
        // drop: function(info) {
        //     // is the "remove after drop" checkbox checked?
        //     if (checkbox.checked) {
        //         // if so, remove the element from the "Draggable Events" list
        //         info.draggedEl.parentNode.removeChild(info.draggedEl);
        //     }
        // }
    });

    calendar.render();
    // $('#calendar').fullCalendar()

    // /* ADDING EVENTS */
    // var currColor = '#3c8dbc' //Red by default
    // // Color chooser button
    // $('#color-chooser > li > a').click(function(e) {
    //     e.preventDefault()
    //     // Save color
    //     currColor = $(this).css('color')
    //     // Add color effect to button
    //     $('#add-new-event').css({
    //         'background-color': currColor,
    //         'border-color': currColor
    //     })
    // })
    // $('#add-new-event').click(function(e) {
    //     e.preventDefault()
    //     // Get value and make sure it is not null
    //     var val = $('#new-event').val()
    //     if (val.length == 0) {
    //         return
    //     }

    //     // Create events
    //     var event = $('<div />')
    //     event.css({
    //         'background-color': currColor,
    //         'border-color': currColor,
    //         'color': '#fff'
    //     }).addClass('external-event')
    //     event.text(val)
    //     $('#external-events').prepend(event)

    //     // Add draggable funtionality
    //     ini_events(event)

    //     // Remove event from text input
    //     $('#new-event').val('')
    // })
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
    var lineChartData = {
        labels: [<?php foreach($monthly_sales as $sale): echo " '".$sale->Month."',"; endforeach;?>],
        datasets: [{
            label: 'Monthly Sale',
            backgroundColor: 'rgba(60,141,188,0.9)',
            borderColor: 'rgba(60,141,188,0.8)',
            pointRadius: true,
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data: [
                <?php foreach ($monthly_sales as $sale):?><?php echo $sale->Sales.","; endforeach;?>
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
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = $.extend(true, {}, areaChartOptions)
    var lineChartData = $.extend(true, {}, lineChartData)
    lineChartData.datasets[0].fill = false;
    lineChartOptions.datasetFill = true

    var lineChart = new Chart(lineChartCanvas, {
        type: 'line',
        data: lineChartData,
        options: lineChartOptions
    })

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
})
</script>