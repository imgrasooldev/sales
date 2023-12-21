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

                            @can('show-main-amount')
                                <div class="mainamount">
                                    <span>This Month</span>
                                    <h4 id="my-element"></h4>
                                </div>
                            @endcan

                            <div class="celebration" style="z-index: -1 !important">
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
                        <div class="container">
                            <div class="adduser" style="margin-top: 10px">
                                <div class="row">
                                    <div class="col-lg-12 margin-tb d-flex" style="justify-content: space-between">
                                        <div class="pull-left">
                                            <h2 style="font-size: 30px; font-weight: bold">Edit Role</h2>
                                        </div>
                                        <div class="pull-right">
                                            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back </a>
                                        </div>
                                    </div>
                                </div>


                                @if (count($errors) > 0)
                                    <div class="alert alert-danger mt-2">
                                        <strong>Whoops!</strong> something went wrong.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                {!! Form::model($role, ['method' => 'PATCH', 'route' => ['roles.update', $role->id]]) !!}
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="addfield">
                                            {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control mt-2']) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Permission:</strong>
                                            <br />
                                            @foreach ($permission as $value)
                                                <label>{{ Form::checkbox('permission[]', $value->name, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'name']) }}
                                                    {{ $value->name }}</label>
                                                <br />
                                            @endforeach
                                        </div>
                                    </div>
                                        <button type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {!! Form::close() !!}
    @include('includes.scripts')
    <script>
        <?php
        $salesTarget = $target[0]->target;
        $currentSales = $month[0]->amount == '' ? 0 : $month[0]->amount;
        ?>
        $('#leadsTable').DataTable();
        $('#leadsTable2').DataTable();
        var salesTarget = <?php echo $salesTarget; ?>;

        function checkSales() {
            var currentSales = <?php echo $currentSales; ?>;
            var currentSalesWithDollorSign = '$' + currentSales;
            $('#my-element').html(currentSalesWithDollorSign);

            if (currentSales >= salesTarget) {
                $('.sales-image').css('display', 'block');
            } else {}
        }
        checkSales();
        $('.menu-Bar').click(function() {
            $(this).toggleClass('open');
            $('.menuWrap').toggleClass('open');
            $('body').toggleClass('ovr-hiddn');
        });
        $('.copyLink').click(function() {
            var value = $(this).attr('data');

            // Create a temporary input element
            var tempInput = $('<input>');
            $('body').append(tempInput);

            // Set the input value to your variable value
            tempInput.val(value);

            // Select the input content
            tempInput.select();

            // Execute the copy command
            document.execCommand('copy');

            // Remove the temporary input element
            tempInput.remove();
        })
    </script>
@endsection
