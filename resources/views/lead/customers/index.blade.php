@include('lead.includes.siteHeader')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js">
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
                @include('lead.includes.sidebar')
            </div>
            <div class="col-md-11 pad-zero">
                <div class="dashboardheader">
                    <div class="container">
                        <div class="header">
                            @include('lead.includes.header')
                        </div>
                        <!-- <div class="mainamount">
                                <span>This Month</span>
                                <h4 id="my-element"></h4>
                            </div> -->
                        <div class="celebration">
                            <div class="imgg1">
                                <img class="sales-image" src="{{ asset('assets/images/fireworks.gif') }}" style="display:none;">
                            </div>
                            <div class="imgg2">
                                <img class="sales-image" src="{{ asset('assets/images/celeb.gif') }}" style="display:none;">
                            </div>
                            <div class="imgg3">
                                <img class="sales-image" src="{{ asset('assets/images/fireworks.gif') }}" style="display:none;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mainWrap">
                    <a href="{{ Route('create_customers') }}" style="margin: 10px" class="btn btn-success">New
                        Customer</a>
                    <div style="margin: 10px" class="">
                        <div class="allpaid">
                            <h4>Customers</h4>
                            <table id="leadsTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr #</th>
                                        <th>Date</th>
                                        <th>Brand</th>
                                        <th>Customer Name</th>
                                        <th>Phone Number</th>
                                        <th>Email</th>
                                        <th>Bussiness Name</th>
                                        <th>Package</th>
                                        <th>Amount</th>
                                        <th>Remaining</th>
                                        <th>Agent</th>
                                        <th>Assigned To</th>
                                        <th>Welcome Email</th>
                                        <th>Assigned PM</th>
                                        <th>Project Status</th>
                                        <th>Calling</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $count = 1;
                                    @endphp
                                    @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $customer->date }}</td>
                                        <td>{{ $customer->brand }}</td>
                                        <td>{{ $customer->customer_name }}</td>
                                        <td>{{ $customer->phone_number }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->bussiness_name }}</td>
                                        <td>{{ $customer->package }}</td>
                                        <td>{{ $customer->amount }}</td>
                                        <td>{{ $customer->remaining }}</td>
                                        <td>{{ $customer->agent }}</td>
                                        <td>{{ $customer->assigned_to }}</td>
                                        <td>{{ $customer->welcome_email }}</td>
                                        <td>{{ $customer->assigned_pm }}</td>
                                        <td>{{ $customer->project_status }}</td>
                                        <td>{{ $customer->calling }}</td>
                                        <td><a class="btn btn-info" href="{{ Route('customer.edit', isset($customer->id)?$customer->id:0) }}">Edit</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sr #</th>
                                        <th>Date</th>
                                        <th>Brand</th>
                                        <th>Customer Name</th>
                                        <th>Phone Number</th>
                                        <th>Email</th>
                                        <th>Bussiness Name</th>
                                        <th>Package</th>
                                        <th>Amount</th>
                                        <th>Remaining</th>
                                        <th>Agent</th>
                                        <th>Assigned To</th>
                                        <th>Welcome Email</th>
                                        <th>Assigned PM</th>
                                        <th>Project Status</th>
                                        <th>Calling</th>
                                        <th>Edit</th>
                                    </tr>
                                </tfoot>
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
        $(document).ready(function() {
            var table = $('#leadsTable').DataTable();

            // Add click event to rows
            $('#leadsTable tbody').on('click', 'tr', function() {
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
@include('lead.includes.scripts')