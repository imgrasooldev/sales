@extends('master');
@section('admin-dashboard')
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
                                    <img class="sales-image" src="{{ Asset('public/assets/images/fireworks.gif') }}"
                                        style="display:none;">
                                </div>
                                <div class="imgg2">
                                    <img class="sales-image" src="{{ Asset('public/assets/images/celeb.gif') }}"
                                        style="display:none;">
                                </div>
                                <div class="imgg3">
                                    <img class="sales-image" src="{{ Asset('public/assets/images/fireworks.gif') }}"
                                        style="display:none;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mainWrap">
                        <div style="margin: 10px" class="">
                            <div class="allpaid">
                                <h4>Customer Sale Details</h4>
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
                                        </tr>
                                    </thead>
                                    <tbody id="customerData">
                                        @php
                                            $count = 1;
                                        @endphp
                                        @foreach ($sales as $sale)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                            <td>{{ $sale->date }}</td>
                                                <td>{{ $sale->brand }}</td>
                                                <td>{{ $sale->customer_name }}</td>
                                                <td>{{ $sale->phone_number }}</td>
                                                <td>{{ $sale->email }}</td>
                                                <td>{{ $sale->bussiness_name }}</td>
                                                <td>{{ $sale->package }}</td>
                                                <td>{{ $sale->amount }}</td>
                                                <td>{{ $sale->remaining }}</td>
                                                <td>{{ $sale->agent }}</td>
                                                <td>{{ $sale->assigned_to }}</td>
                                                <td>{{ $sale->welcome_email }}</td>
                                                <td>{{ $sale->assigned_pm }}</td>
                                                <td>{{ $sale->project_status }}</td>
                                                <td>{{ $sale->calling }}</td>
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
            var table = $('#leadsTable').DataTable();
    </script>
    </body>

    </html>
@endsection
