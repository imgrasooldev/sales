@extends('master');
@section('admin-dashboard')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>
    </script>

    <style>
        * {
            user-select: none;
        }


        /* Custom CSS to style selected row */
        .selected {
            background-color: #ffffff;
            /* Change the background color as needed */
            user-select: text;
        }
    </style>
    <section class="dashboardWrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1 pad-zero">
                    @include('includes.sidebar')
                </div>
                <div class="col-md-11 pad-zero">
                    <div class="dashboardheader">
                        <div class="container">
                            <div class="header">
                                @include('includes.header')
                            </div>
                            {{-- <div class="mainamount">
                                <span>This Month</span>
                                <h4 id="my-element"></h4>
                            </div> --}}
                            <div class="celebration">
                                <div class="imgg1">
                                    <img class="sales-image" src="{{ asset('/assets/images/fireworks.gif') }}"
                                        style="display:none;">
                                </div>
                                <div class="imgg2">
                                    <img class="sales-image" src="{{ asset('/assets/images/celeb.gif') }}"
                                        style="display:none;">
                                </div>
                                <div class="imgg3">
                                    <img class="sales-image" src="{{ asset('/assets/images/fireworks.gif') }}"
                                        style="display:none;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mainWrap">
                        <div style="margin: 10px" class="">
                            <div class="allpaid">
                                <table id="leadsTable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Sr #</th>
                                            <th>Comment</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                        </tr>
                                    </thead>
                                    <tbody id="customerData">
                                        @php
                                            $count = 1;
                                        @endphp
                                        @foreach ($comment as $item)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ $item->date }}</td>
                                                <td>{{ $item->time }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('includes.scripts')
    <script>
   $(document).ready(function () {
    var table = $('#leadsTable').DataTable({
        "paging": true,
        "searching": true,
        // Add other DataTable initialization options as needed
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        // Enable FixedHeader
        fixedHeader: true,
    });

    // Add click event to rows
    $('#leadsTable tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            // If the row is already selected, do nothing
            return;
        } else {
            // Deselect any previously selected row and select the current row
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');

            // Copy the selected row's data to the clipboard
            var selectedRow = table.row('.selected');
            if (selectedRow.any()) {
                var rowData = selectedRow.data();
                var rowText = rowData.join('\t'); // Convert the row data to a tab-separated string

                // Create a hidden input element to copy the data to the clipboard
                var tempInput = $('<input>');
                $('body').append(tempInput);
                tempInput.val(rowText).select();
                document.execCommand('copy');
                tempInput.remove();
            }
        }
    });
});

document.addEventListener('contextmenu', function (e) {
    e.preventDefault();
});
    </script>
    </body>

    </html>
@endsection
