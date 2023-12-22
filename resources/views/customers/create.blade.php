@extends('master')
@section('admin-dashboard')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .selection{
        width: 100%;
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
                        </div>
                    </div>

                    <div class="mainWrap">
                        <form enctype="multipart/form-data" action="{{ Route('customers.store') }}" method="POST"
                            class="container">
                            @csrf
                            <div class="adduser">
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-warning alert-dismissible fade show z-50" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @endif
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <h4>Add New Customer</h4>
                                <div class="row">

{{--
                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>data</label>
                                            <input required name="date" placeholder="Select Date" type="date">
                                            @if ($errors->has('date'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('date') }}</p>
                                            @endif
                                        </div>
                                    </div> --}}


                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Brand</label>
                                            <select id="brand" required name="brand" class="form-control">
                                                <option disabled selected>Select Brand`</option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('brand'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('brand') }}</p>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Customer Name</label>
                                            <input required name="customer_name" placeholder="Customer Name" type="text">
                                            @if ($errors->has('customer_name'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('customer_namecustomer_name') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Email</label>
                                            <input required name="customeremail" placeholder="Email" type="email">
                                            @if ($errors->has('customeremail'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('customeremail') }}</p>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Customer Phone</label>
                                            <input required name="customerphone" placeholder="Customer Phone" type="number">

                                            @if ($errors->has('customerphone'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('customerphone') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="addfield">
                                            <label>Bussiness Name</label>
                                            <input required name="bussiness_name" placeholder="Bussiness Name" type="text">
                                            @if ($errors->has('bussiness_name'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('bussiness_name') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="addfield">
                                            <textarea class="form-control" required name="comment" placeholder="Comment For Bussiness Details"></textarea>
                                            @if ($errors->has('comment'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('comment') }}</p>
                                            @endif
                                        </div>
                                    </div>


                                    {{-- <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Package</label>
                                            <input required name="package" placeholder="Package" type="text">
                                            @if ($errors->has('package'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('package') }}</p>
                                            @endif
                                        </div>
                                    </div> --}}


                                    {{-- <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Amount</label>
                                            <input required name="amount" placeholder="Amount" type="text">
                                            @if ($errors->has('amount'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('amount') }}</p>
                                            @endif
                                        </div>
                                    </div> --}}


                                    {{-- <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Remaining</label>
                                            <input required name="remanining" placeholder="Remaining" type="text">
                                            @if ($errors->has('remanining'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('remanining') }}</p>
                                            @endif
                                        </div>
                                    </div> --}}


                                    {{-- <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Agent</label>
                                            <input required name="agent" placeholder="Agent" type="text">
                                            @if ($errors->has('agent'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('agent') }}</p>
                                            @endif
                                        </div>
                                    </div> --}}



                                    {{-- <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Assigned To</label>
                                            <input required name="assigned_to" placeholder="Assigned To" type="text">
                                            @if ($errors->has('assigned_to'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('assigned_to') }}</p>
                                            @endif
                                        </div>
                                    </div> --}}

{{--
                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Welcome Email</label>
                                            <input required name="welcome_email" placeholder="Welcome Email" type="email">
                                            @if ($errors->has('welcome_email'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('welcome_email') }}</p>
                                            @endif
                                        </div>
                                    </div> --}}

                                    {{-- <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Assigned PM</label>
                                            <input required name="assigned_pm" placeholder="Assigned PM" type="text">
                                            @if ($errors->has('assigned_pm'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('assigned_pm') }}</p>
                                            @endif
                                        </div>
                                    </div> --}}


                                    {{-- <div class="col-md-6">
                                        <div class="addfield">
                                            <label>First Name</label>
                                            <input required name="first_name" placeholder="John" type="text">
                                            @if ($errors->has('name'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('first_name') }}</p>
                                            @endif
                                        </div>
                                    </div> --}}

{{--
                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Project Status</label>
                                            <input required name="project_status" placeholder="Project Status" type="text">
                                            @if ($errors->has('project_status'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('project_status') }}</p>
                                            @endif
                                        </div>
                                    </div> --}}
{{--

                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Calling</label>
                                            <input required name="calling" placeholder="Calling" type="text">
                                            @if ($errors->has('calling'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('calling') }}</p>
                                            @endif
                                        </div>
                                    </div> --}}


                                </div>
                                <button type="submit">Add User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </body>

    </html>
    @include('includes.scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
            $('.members').select2();
            $('.js-basic-multiple').select2();


        $('.menu-Bar').click(function() {
            $(this).toggleClass('open');
            $('.menuWrap').toggleClass('open');
            $('body').toggleClass('ovr-hiddn');
        });
    </script>
@endsection
