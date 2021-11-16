<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Sales</h3>
                        <?php if(session()->get('msg')): ?>
                        <div class="alert alert-success" role="alert"><?php echo session()->get('msg'); ?></div>
                        <?php endif; ?>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($sale):?>
                                <?php foreach($sale as $sales):?>
                                <tr>
                                    <td><?php echo $sales['sale_id'];?></td>
                                    <td><?php echo $sales['name'];?></td>
                                    <td><?php echo $sales['date'];?></td>
                                    <td><?php echo $sales['sale_quantity'];?></td>
                                    <td><?php echo $sales['sale_price'];?></td>
                                    <td><a href="<?php echo base_url('sale/edit/'.$sales['sale_id']);?>"
                                            class="btn btn-primary">edit</a>
                                        <a href="<?php echo base_url('sale/delete/'.$sales['sale_id']);?>"
                                            class="btn btn-danger">delete</a>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                            <!-- <tfoot>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Group name</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot> -->
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
            <div class="col-6">
            <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Products</h3>
                        <?php if(session()->get('msg')): ?>
                        <div class="alert alert-success" role="alert"><?php echo session()->get('msg'); ?></div>
                        <?php endif; ?>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
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
                                    <td><a class="btn btn-primary"
                                            href="<?php echo site_url('product/edit/').$product['ID'];?>">Edit</a> <a
                                            class="btn btn-danger"
                                            href="<?php echo site_url('product/delete/').$product['ID'];?>">Delete</a>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                                <?php endif; ?>
                            </tbody>
                            <!-- <tfoot>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Group name</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot> -->
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

        </div>
        <!-- /.col -->

        <div class="row justify-content-center">
        <div class="col-8">
            <div class="card card-primary">
                <div class="card-body p-0">
                    <!-- THE CALENDAR -->
                    <div id="calendar"></div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    </div>
    <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

</section>
<!-- /.content -->
</div>
<!-- jQuery -->
<script src="/Asset/plugins/jquery/jquery.min.js"></script>
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
                foreach ($calendar as $sale):?>
                {
                title:'<?php echo $sale->total_sales; ?>',
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
</script>