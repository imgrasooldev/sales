@extends('admin.master')
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
                        </div>
                    </div>

                    <div class="mainWrap">
                        <form enctype="multipart/form-data" action="{{ Route('admin.insert_new_user') }}" method="POST"
                            class="container">
                            @csrf
                            <div class="adduser">
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>{{ $message }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
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
                                <div
                                    style="width: 100%; display: flex; flex-direction: row; justify-content: space-between; align-items: center">
                                    <h4>Edit User</h4>
                                    <a href="{{ Route('admin.delete_user', $user->id) }}" class="btn btn-danger">Delete
                                        User</a>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="addfield">
                                            <img style="width: 100px; height: 100px; border-radius: 50%"
                                                src="{{ asset('public/profiles/' . $user->profile_image) }}" />
                                            <label>Profile Image</label>
                                            <input required name="image" class="form-control" type="file">
                                            @if ($errors->has('image'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('image') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>First Name</label>
                                            <input required value="{{ $user->name }}" name="first_name" placeholder="John"
                                                type="text">
                                            @if ($errors->has('name'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('first_name') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Last Name</label>
                                            <input required value="{{ $user->last_name }}" name="last_name"
                                                placeholder="Doe" type="text">
                                            @if ($errors->has('last_name'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('last_name') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Email</label>
                                            <input required value="{{ $user->email }}" name="email"
                                                placeholder="johndoe@gmail.com" type="email">
                                            @if ($errors->has('email'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('email') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Password</label>
                                            <input required type="password" disabled placeholder="**********"
                                                name="password">
                                            @if ($errors->has('password'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('password') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Phone</label>
                                            <input required value="{{ $user->phone }}" type="number" name="phone"
                                                placeholder="03189878911">
                                            @if ($errors->has('phone'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('phone') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Pseudo Name</label>
                                            <input required value="{{ $user->pseudo_name }}" type="text" placeholder=""
                                                name="pseudo_name">
                                            @if ($errors->has('pseudo_name'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('pseudo_name') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="addfield">
                                            <label>Position</label>
                                            <input required value="{{ $user->position }}" type="text"
                                                placeholder="Back-End Developer" name="position">
                                            @if ($errors->has('position'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('position') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="addfield">
                                            <label>Address</label>
                                            <input required value="{{ $user->address }}" type="text"
                                                placeholder="Karachi" name="address">
                                            @if ($errors->has('address'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('address') }}</p>
                                            @endif
                                        </div>
                                    </div>



                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Joinning Date</label>
                                            <input required value="{{ $user->join_date }}" type="date" name="join_date">
                                            @if ($errors->has('join_date'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('join_date') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Country</label>
                                            <input required value="{{ $user->country }}" type="Pakistan" name="country">
                                            @if ($errors->has('country'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('country') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Target</label>
                                            <input required value="{{ $user->target }}" type="number"
                                                placeholder="10000" name="target">
                                            @if ($errors->has('target'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('target') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Team Lead</label>
                                            <select required name="type" class="form-control">
                                                @if ($user->type == 1)
                                                    <option selected value="1">Yes</option>
                                                    <option value="0">No</option>
                                                @else
                                                    <option value="1">Yes</option>
                                                    <option selected value="0">No</option>
                                                @endif
                                            </select>
                                            @if ($errors->has('target'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('target') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <button type="submit">Update User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
            
    $('.menu-Bar').click(function() {
        $(this).toggleClass('open');
        $('.menuWrap').toggleClass('open');
        $('body').toggleClass('ovr-hiddn');
    });
    </script>
    </body>

    </html>
@endsection
