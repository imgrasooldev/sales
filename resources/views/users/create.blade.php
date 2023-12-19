{{-- @extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New User</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back </a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong>Something went wrong.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif



{!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Password:</strong>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Confirm Password:</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Role:</strong>
            {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}

@endsection --}}

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
                        <form enctype="multipart/form-data" action="{{ Route('users.store') }}" method="POST"
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
                                <h4>Add New User</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="addfield">
                                            <label>Image</label>
                                            <input required name="profile_image" class="form-control" type="file">
                                            @if ($errors->has('profile_image'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('profile_image') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>First Name</label>
                                            <input required name="name" placeholder="John" type="text">
                                            @if ($errors->has('name'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Last Name</label>
                                            <input required name="last_name" placeholder="Doe" type="text">
                                            @if ($errors->has('last_name'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('last_name') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Email</label>
                                            <input required name="email" placeholder="johndoe@gmail.com" type="email">
                                            @if ($errors->has('email'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('email') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Password</label>
                                            <input required type="password" placeholder="**********" name="password">
                                            @if ($errors->has('password'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('password') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Confirm Password</label>
                                             <input required type="password" placeholder="**********" name="confirm-password">
                                            @if ($errors->has('confirm-password'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('confirm-password') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Phone</label>
                                            <input required type="number" name="phone" placeholder="03189878911">
                                            @if ($errors->has('phone'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('phone') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="addfield">
                                            <label>Pseudo Name</label>
                                            <input required type="text" placeholder="" name="pseudo_name">
                                            @if ($errors->has('pseudo_name'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('pseudo_name') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="addfield">
                                            <label>Position</label>
                                            <input required type="text" placeholder="Back-End Developer" name="position">
                                            @if ($errors->has('position'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('position') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="addfield">
                                            <label>Address</label>
                                            <input required type="text" placeholder="Karachi" name="address">
                                            @if ($errors->has('address'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('address') }}</p>
                                            @endif
                                        </div>
                                    </div>



                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Joinning Date</label>
                                            <input required type="date" name="join_date">
                                            @if ($errors->has('join_date'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('join_date') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Country</label>
                                            <input required type="Pakistan" name="country">
                                            @if ($errors->has('country'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('country') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Target</label>
                                            <input required type="number" placeholder="10000" name="target">
                                            @if ($errors->has('target'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('target') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Team Lead</label>
                                            <select id="team" required name="type" class="form-control">
                                                <option disabled selected>Select Role</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                            @if ($errors->has('target'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('target') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12" id="show_lead" hidden>
                                        <div class="addfield">
                                            <label>Select Lead</label>
                                            <select id="lead" required class="form-control">
                                                <option disabled selected>Select Role</option>
                                                @foreach ($leads as $lead)
                                                    <option value="{{ $lead->id }}">{{ $lead->name }} {{ $lead->last_name }}</option>
                                                @endforeach

                                            </select>
                                            @if ($errors->has('target'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('target') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12 show_team" hidden>
                                        <div class="addfield">
                                            <label>Select Team Members</label>
                                            <select style="width: 100%" id="members" class="members"
                                                multiple="multiple">
                                                @foreach ($team as $member)
                                                    <option value="{{ $member->id }}">{{ $member->name }} {{ $member->last_name  }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('target'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('target') }}</p>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="addfield">
                                            <label>Select Brands</label>
                                            <select style="width: 100%" name="brands[]" class="js-basic-multiple"
                                                multiple="multiple">
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('target'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('target') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="addfield">
                                            <div class="form-group">
                                                <strong>Role:</strong>
                                                {!! Form::select('roles[]', $roles,[], array('class' => 'form-control')) !!}
                                            </div>
                                        </div>
                                    </div>
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

        $('#team').on('change', function() {
            if (this.value == 1) {
                $('.show_team').removeAttr('hidden', 'false')
                $('#show_lead').attr('hidden', 'true')
                $('#lead').removeAttr('name')
                $('#members').attr('name', 'team[]')
                // alert($('#lead').val())
            }
            if (this.value == 0) {
                $('#members').removeAttr('name')
                $('#lead').attr('name', 'lead')
                $('.show_team').attr('hidden', 'true')
                $('#show_lead').removeAttr('hidden', 'false')
            }
        })

        $('.menu-Bar').click(function() {
            $(this).toggleClass('open');
            $('.menuWrap').toggleClass('open');
            $('body').toggleClass('ovr-hiddn');
        });
    </script>
@endsection
