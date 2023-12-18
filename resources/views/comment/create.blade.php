@extends('master')
@section('admin-dashboard')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .selection {
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
                        <form enctype="multipart/form-data" action="{{ Route('comment.store') }}" method="POST"
                            class="container">
                            @csrf
                            <input type="hidden" name="id" value="{{ $customer->id }}">
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
                                <h4>Add Comment</h4>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Customer Name</label>
                                            <input required disabled value="{{ $customer->customer_name }}"
                                                name="customer_name" placeholder="Customer Name" type="text">
                                            @if ($errors->has('customer_name'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('customer_name') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Email</label>
                                            <input required disabled value="{{ $customer->customeremail }}" name="email"
                                                placeholder="Email" type="email">
                                            @if ($errors->has('email'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('email') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Phone</label>
                                            <input required disabled value="{{ $customer->customerphone }}" name="phone"
                                                placeholder="Phone" disabled type="text">
                                            @if ($errors->has('email'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('email') }}</p>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Package</label>
                                            <input required disabled value="{{ $customer->package }}" name="package"
                                                placeholder="Package" disabled type="text">
                                            @if ($errors->has('email'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('email') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="addfield">
                                            <label>Comment</label>
                                            <textarea name="title" required class="form-control" placeholder="Write Comment"></textarea>
                                            @if ($errors->has('email'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('email') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <input style="margin-right: 6px; width: 30px" type="checkbox" name="meeting"
                                            id="meeting">Shedule Metting
                                    </div>

                                    <div id="dateAndTime" hidden class="col-md-12 row">
                                        <div class="col-md-6">
                                            <div class="addfield">
                                                <label>Date</label>
                                                <input name="date" placeholder="Date" type="date">
                                                @if ($errors->has('date'))
                                                    <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                        {{ $errors->first('date') }}</p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="addfield">
                                                <label>Time</label>
                                                <input name="time" placeholder="Time" type="time">
                                                @if ($errors->has('email'))
                                                    <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                        {{ $errors->first('email') }}</p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="addfield">
                                                <label>Show Alert</label>
                                                <select name="visibility">
                                                    <option value="0">To Me</option>
                                                    <option value="1">To All</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <button type="submit">Add Comment</button>
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

        $('#meeting').on('change', function() {
            var status = this.checked
            if (!status) {
                $('#dateAndTime').attr('hidden', 'true')
            } else {
                $('#dateAndTime').removeAttr('hidden')
            }
        })

        $('.menu-Bar').click(function() {
            $(this).toggleClass('open');
            $('.menuWrap').toggleClass('open');
            $('body').toggleClass('ovr-hiddn');
        });
    </script>
@endsection
