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
                        <div class="container">
                            <div class="adduser" style="margin-top: 10px">
                                <div class="row">
                                    <div class="col-lg-12 margin-tb d-flex" style="justify-content: space-between">
                                        <div class="pull-left">
                                            <h2 style="font-size: 30px; font-weight: bold">Roles</h2>
                                        </div>
                                        <div class="pull-right">
                                            @can('role-create')
                                                <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role
                                                </a>
                                            @endcan
                                        </div>
                                    </div>
                                </div>


                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success mt-2">
                                        <p>{{ $message }}</p>
                                    </div>
                                @endif


                                <table class="table table-bordered mt-2">
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th width="280px">Action</th>
                                    </tr>
                                    @foreach ($roles as $key => $role)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                <a class="btn btn-info" href="{{ route('roles.show', $role->id) }}">Show</a>
                                                @can('role-edit')
                                                    <a class="btn btn-primary"
                                                        href="{{ route('roles.edit', $role->id) }}">Edit</a>
                                                @endcan
                                                @can('role-delete')
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline']) !!}
                                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                    {!! Form::close() !!}
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>

                                {!! $roles->render() !!}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
