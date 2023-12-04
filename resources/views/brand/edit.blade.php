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
                            <!--  <div class="mainamount">
                                            <span>This Month</span>
                                            <h4>$285,175</h4>
                                            <strong>+55%</strong>
                                        </div> -->
                        </div>
                    </div>
                    <div class="mainWrap">
                        <form enctype="multipart/form-data" action="{{ Route('brands.update', $brand->id) }}" method="POST"
                            class="container">
                            @method('PATCH')
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
                                @can('brand-delete')
                                    <div
                                        style="width: 100%; display: flex; flex-direction: row; justify-content: space-between; align-items: center">
                                        <h4>Edit Brand</h4>
                                        <a href="{{ Route('brands.destroy', $brand->id) }}" class="btn btn-danger">Delete
                                            Brand</a>
                                    </div>
                                @endcan
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="addfield">
                                            <img style="width: 70px; height: 70px; border-radius: 50%; margin-right: 20px"
                                                src="{{ asset('public/images/' . $brand->image) }}"></img>
                                            <label style="margin-top: 20px">Image</label>
                                            <input name="id" value="{{ $brand->id }}" type="hidden">
                                            <input name="image" class="form-control" type="file">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="addfield">
                                            <label>Name</label>
                                            <input required value="{{ $brand->name }}" name="name" placeholder="google"
                                                type="text">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="addfield">
                                            <label>URL</label>
                                            <input required value="{{ $brand->url }}" name="url"
                                                placeholder="http://google.com" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="addfield">
                                            <label>Contact No</label>
                                            <input required value="{{ $brand->contact_no }}" name="contact"
                                                placeholder="01920323" type="number">
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
                                <button type="submit">Update Brand</button>
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
