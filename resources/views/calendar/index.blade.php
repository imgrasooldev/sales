@extends('master');
@section('admin-dashboard')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <style>
        * {
            user-select: none;
        }


        /* Custom CSS to style selected row */
        .selected {
            background-color: #ffffff;
            /* Change the background color as needed */
        }
    </style>
    <section class="dashboardWrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1 pad-zero">
                    @include('includes.sidebar')
                </div>
                <div class="col-md-11 pad-zero">

                    <div class="mainWrap">
                        <div style="margin: 10px" class="">
                            <div class="allpaid">
                                <div class="row mb-4">
                                    <div class="col-sm-6">
                                        <label>Customer</label>
                                        <input class="form-control" list="browsers" name="browser" id="browser">
                                    </div>
                                    <div class="col-sm-2">
                                        <label>Show Alert</label>
                                        <select name="visibility" class="form-control" id="visibility">
                                            <option value="0">To Me</option>
                                            <option value="1">To All</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <label>Show Alert</label>
                                        <input class="form-control" type="time" id="time"/>
                                    </div>
                                </div>
                                    <datalist style="overflow: scroll" id="browsers">
                                    @foreach ($customers as $customer)
                                        <option style="overflow: scroll" value="{{ $customer->id }}">
                                            {{ $customer->customer_name }} {{ '(' . $customer->customeremail . ')' }} - Amount:
                                            {{ $customer->amount }} - Date: {{ $customer->date }}</option>
                                    @endforeach
                                </datalist>
                                <div class="container">
                                    <div id='calendar'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- @include('includes.scripts') --}}
    <script>
        $(document).ready(function() {
            var customer_id = null;
            var time = null;
            var visibility = null;
            var SITEURL = "{{ url('/') }}";
            $('#browser').on('change', function() {
                customer_id = $(this).val()
            })
            $('#time').on('change', function() {
                time = $(this).val()
            })
            $('#visibility').on('change', function() {
                visibility = $(this).val()
            })

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var calendar = $('#calendar').fullCalendar({
                editable: true,
                events: SITEURL + "/fullcalender",
                displayEventTime: false,
                editable: true,
                eventRender: function(event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                    if (customer_id != null) {
                        var title = prompt('Event Title:');
                        if (title) {
                            var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                            var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                            $.ajax({
                                url: SITEURL + "/fullcalenderAjax",
                                data: {
                                    customer_id: customer_id,
                                    visibility: visibility,
                                    time: time,
                                    title: title,
                                    start: start,
                                    end: end,
                                    type: 'add'
                                },
                                type: "POST",
                                success: function(data) {
                                    displayMessage("Event Created Successfully");

                                    calendar.fullCalendar('renderEvent', {
                                        id: data.id,
                                        title: title,
                                        start: start,
                                        end: end,
                                        allDay: allDay
                                    }, true);

                                    calendar.fullCalendar('unselect');
                                }
                            });
                        }
                    }else{
                        alert('Please Select Customer')
                    }

                },
                eventDrop: function(event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
                    $.ajax({
                        url: SITEURL + '/fullcalenderAjax',
                        data: {
                            customer_id: customer_id,
                            title: event.title,
                            start: start,
                            end: end,
                            id: event.id,
                            type: 'update'
                        },
                        type: "POST",
                        success: function(response) {
                            displayMessage("Event Updated Successfully");
                        }
                    });
                },
                eventClick: function(event) {
                    // var deleteMsg = confirm("Do you really want to delete?");
                    if (true) {
                        $.ajax({
                            type: "POST",
                            url: SITEURL + '/fullcalenderAjax',
                            data: {
                                customer_id: customer_id,
                                id: event.id,
                                type: 'delete'
                            },
                            success: function(response) {
                                // calendar.fullCalendar('removeEvents', event.id);
                                displayMessage(response);
                            }
                        });
                    }
                }

            });

        });



        function displayMessage(message) {
            toastr.success(message, 'Event');
        }
    </script>


    </body>

    </html>
@endsection
