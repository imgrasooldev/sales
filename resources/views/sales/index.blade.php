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
                                <h4>Sales Data</h4>
                                <table id="leadsTable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Sr #</th>
                                            <th>Date</th>
                                            <th>Customer Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Bussiness Name</th>
                                            <th>Total Sale</th>
                                        </tr>
                                    </thead>
                                        @php
                                            $i = 1;
                                        @endphp
                                    <tbody id="customerData">
                                        @foreach ($sales as $sale)
                                        <tr>
                                            <th>{{ $i++ }}</th>
                                            <th>{{ $sale->date }}</th>
                                            <th>{{ $sale->customer_name }}</th>
                                            <th>{{ $sale->email }}</th>
                                            <th>{{ $sale->phone_number }}</th>
                                            <th>{{ $sale->bussiness_name }}</th>
                                            <th><a href="{{ Route('sales.show', $sale->id) }}">{{ $sale->sum }}</a></th>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Sr #</th>
                                            <th>Date</th>
                                            <th>Customer Name</th>
                                            <th>Phone Number</th>
                                            <th>Email</th>
                                            <th>Bussiness Name</th>
                                            <th>Total Sale</th>
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
