@extends('master')
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
                        <form enctype="multipart/form-data" action="{{ Route('brands.store') }}" method="POST"
                            class="container">
                            @csrf
                            @method('POST')
                            <div class="adduser">
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>{{ $message }}</strong>
                                        {{-- <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button> --}}
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
                                <h4>Add New Brand</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="addfield">
                                            <label>Image</label>
                                            <input required name="image" class="form-control" type="file">
                                            @if ($errors->has('image'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('image') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="addfield">
                                            <label>Name</label>
                                            <input required name="name" placeholder="google" type="text">
                                            @if ($errors->has('name'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="addfield">
                                            <label>URL</label>
                                            <input required name="url" placeholder="http://google.com" type="text">
                                            @if ($errors->has('url'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('url') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="addfield">
                                            <label>Contact No</label>
                                            <input required name="contact" placeholder="01920323" type="number">
                                            @if ($errors->has('contact'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('contact') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12">
                              <div class="addfield">
                                <label>Address</label>
                                <input type="text">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="addfield">
                                <label>Pseudo Name</label>
                                <input type="text">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="addfield">
                                <label>Position</label>
                                <input type="text">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="addfield">
                                <label>Date Joined</label>
                                <input type="date">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="addfield">
                                <label>Country</label>
                                <input type="text">
                              </div>
                            </div> --}}
                                </div>
                                <button type="submit">Add Brand</button>
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
