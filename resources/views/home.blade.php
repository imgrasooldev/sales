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
                        <div class="container">
                            @can('list-sales-cards')
                                <div class="salesOverview">
                                    <h4>Sales Overview</h4>
                                    <div class="row">
                                        @can('show-today-sale')
                                            <div class="col-md-4">
                                                <h5>
                                                    <span>Today</span> ${{ number_format($today[0]->amount) }}
                                                </h5>
                                            </div>
                                        @endcan

                                        @can('show-yesterday-sale')
                                            <div class="col-md-4">
                                                <h5>
                                                    <span>Yesterday</span> ${{ number_format($yesterday[0]->amount) }}
                                                </h5>
                                            </div>
                                        @endcan

                                        @can('show-upsale')
                                            <div class="col-md-4">
                                                <h5>
                                                    <span>This Month</span>${{ number_format($month[0]->amount) }}
                                                </h5>
                                            </div>
                                        @endcan

                                        @can('show-frontsale')
                                            <div class="col-md-4">
                                                <h5>
                                                    <span>Month Frontsale</span>${{ number_format($month_sale) }}
                                                </h5>
                                            </div>
                                        @endcan

                                        @can('show-this-month-sale')
                                            <div class="col-md-4">
                                                <h5>
                                                    <span>Month Upsale</span>${{ number_format($month_upsale) }}
                                                </h5>
                                            </div>
                                        @endcan

                                        @can('show-un-paid-this-month')
                                            <div class="col-md-4">
                                                <h5>
                                                    <span>Unpaid This Month</span>
                                                    ${{ number_format($un_paid_month[0]->amount) }}
                                                </h5>
                                            </div>
                                        @endcan

                                        @can('show-last-month-sale')
                                            <div class="col-md-4">
                                                <h5>
                                                    <span>Last Month</span> ${{ number_format($last_month[0]->amount) }}
                                                </h5>
                                            </div>
                                        @endcan

                                        @can('show-this-year-sale')
                                            <div class="col-md-4">
                                                <h5>
                                                    <span>This Year</span> ${{ number_format($year[0]->amount) }}
                                                </h5>
                                            </div>
                                        @endcan
                                    </div>
                                </div>
                            @endcan


                            @can('user-list')
                                <div class="salesusers">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center">Sales Person</th>
                                                <th scope="col" class="text-center">Target</th>
                                                <th scope="col" class="green text-center">Achieve</th>
                                                <th scope="col" class="orange text-center">Achieved</th>
                                                <th scope="col" class="red text-center">Remaining</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($all_users as $check_user)
                                                @php
                                                    $flag = true;
                                                @endphp
                                                @foreach ($users as $user)
                                                    @if ($check_user->id == $user->id)
                                                        @php
                                                            $flag = false;
                                                        @endphp
                                                        <tr>
                                                            <td scope="row">
                                                                <span>
                                                                    <a href="{{ Route('profile.show', $check_user->id) }}">
                                                                        <img style="width: 100px; height: 100px; border-radius: 50%"
                                                                            src="{{ Asset('public/profiles/' . $user->profile_image) }}"
                                                                            alt="{{ $user->name }} {{ $user->last_name }}"
                                                                            title="{{ $user->name }} {{ $user->last_name }}">
                                                                    </a>
                                                                </span>
                                                                {{ $user->name }} {{ $user->last_name }}
                                                            </td>
                                                            <td class="text-center">${{ number_format($user->target) }}</td>
                                                            <td class="text-center">${{ number_format($user->achieved) }}</td>
                                                            @php
                                                                $per = ($user->achieved / $user->target) * 100;
                                                            @endphp

                                                            @if ($per <= 70)
                                                                @php
                                                                    $perClass = 'red';
                                                                @endphp
                                                            @elseif ($per > 70 && $per <= 85)
                                                                @php
                                                                    $perClass = 'yellow';
                                                                @endphp
                                                            @else
                                                                @php
                                                                    $perClass = 'green';
                                                                @endphp
                                                            @endif

                                                            <td class="{{ $perClass }} text-center">{{ (int) $per }}%
                                                            </td>
                                                            <td class="text-center">
                                                                @if ($user->achieved > $user->target)
                                                                    @php
                                                                        $overachieved = str_replace('-', '', number_format($user->target - $user->achieved));
                                                                    @endphp
                                                                    ${{ $overachieved . ' Over Achieved' }}
                                                                @else
                                                                    ${{ number_format($user->target - $user->achieved) }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                @if ($flag)
                                                    <tr>
                                                        <td scope="row">
                                                            <span>
                                                                <a href="{{ Route('profile.show', $check_user->id) }}">
                                                                    <img style="width: 100px; height: 100px; border-radius: 50%"
                                                                        src="{{ Asset('public/profiles/' . $check_user->profile_image) }}"
                                                                        alt="{{ $check_user->name }} {{ $check_user->last_name }}"
                                                                        title="{{ $check_user->name }} {{ $check_user->last_name }}">
                                                                </a>
                                                            </span>
                                                            {{ $check_user->name }} {{ $check_user->last_name }}
                                                        </td>
                                                        <td class="text-center">${{ number_format($check_user->target) }}</td>
                                                        <td class="text-center">${{ number_format(0) }}</td>

                                                        <td class="red text-center">{{ '0' }}%</td>
                                                        <td class="text-center">
                                                            ${{ number_format($check_user->target) }}
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endcan

                            @can('brand-list')
                                <div class="salesusers">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Brand</th>
                                                <th scope="col" class="green text-center">Total Sale</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($all_brands as $check_brand)
                                                @php
                                                    $flag = true;
                                                @endphp
                                                @foreach ($brands as $brand)
                                                    @if ($check_brand->id == $brand->id)
                                                        @php
                                                            $flag = false;
                                                        @endphp
                                                        {{-- {{ dd(file_exists('images/' . $brand->image)) }} --}}
                                                        <tr>
                                                            <td scope="row">
                                                                <span>
                                                                    <a href="{{ Route('brands.edit', $brand->id) }}">
                                                                        <img style="width: 80px; height: 80px; border-radius: 50%"
                                                                            src="{{ Asset('public/images/' . $brand->image) }}"
                                                                            alt="{{ $brand->name }}"
                                                                            title="{{ $brand->name }}">
                                                                    </a>
                                                                </span>
                                                                {{ $brand->name }}
                                                            </td>
                                                            <td class="text-center">${{ number_format($brand->amount, 2) }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                @if ($flag)
                                                    <tr>
                                                        <td scope="row">
                                                            <span>
                                                                <a href="">
                                                                    <img style="width: 80px; height: 80px; border-radius: 50%"
                                                                        src="{{ Asset('public/images/' . $check_brand->image) }}"
                                                                        alt="{{ $check_brand->name }}"
                                                                        title="{{ $check_brand->name }}">
                                                                </a>
                                                            </span>
                                                            {{ $check_brand->name }}
                                                        </td>
                                                        <td class="text-center">${{ '0' }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            @endcan


                            @can('show-all-paid-leads')
                                <div class="allpaid">
                                    <h4>All Paid Leads</h4>
                                    <table id="leadsTable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Sr #</th>
                                                <th>PDF Invoice</th>
                                                <th>Date / Time</th>
                                                <th>Client Email</th>
                                                <th>Client Phone</th>
                                                <th>Comment</th>
                                                <th>Invoice Type</th>
                                                <th>Amount</th>
                                                <th>Agent</th>
                                                <th>Brand</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $counter = 1;
                                            @endphp

                                            @foreach ($payments as $payment)
                                                @if (str_word_count($payment->comments) > 3)
                                                    @php
                                                        $commentsWithoutDots = implode(' ', array_slice(str_word_count($payment->comments, 1), 0, 3));
                                                        $comments = $commentsWithoutDots . '...';
                                                    @endphp
                                                @else
                                                    @php
                                                        $comments = $payment->comments;
                                                    @endphp
                                                @endif

                                                <tr>
                                                    <td>{{ $counter }}</td>
                                                    <td><a href="{{ Route('pdf', $payment->id) }}">Download</a></td>
                                                    <td>{{ $payment->updated_at }}</td>
                                                    <td><a
                                                            href="mailto:{{ $payment->customeremail }}">{{ $payment->customeremail }}</a>
                                                    </td>
                                                    <td><a
                                                            href="tel:+{{ $payment->customerphone }}">{{ $payment->customerphone }}</a>
                                                    </td>
                                                    <td data-toggle="tooltip" data-placement="bottom"
                                                        title="{{ ucwords($payment->comments) }}">{{ ucwords($comments) }}
                                                    </td>
                                                    <td>{{ $payment->paymenttype }}</td>
                                                    <td>{{ $payment->amount }}</td>
                                                    <td>{{ $payment->agent_name }}</td>
                                                    <td>{{ $payment->brand_name }}</td>
                                                </tr>
                                                @php
                                                    $counter++;
                                                @endphp
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Sr #</th>
                                                <th>PDF Invoice</th>
                                                <th>Date / Time</th>
                                                <th>Client Email</th>
                                                <th>Client Phone</th>
                                                <th>Comment</th>
                                                <th>Invoice Type</th>
                                                <th>Amount</th>
                                                <th>Agent</th>
                                                <th>Brand</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            @endcan

                            @can('show-all-un-paid-leads')
                                <div class="allpaid">
                                    <h4>All Un Paid Leads</h4>
                                    <table id="leadsTable2" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Sr #</th>
                                                <th>Date / Time</th>
                                                <th>Client Email</th>
                                                <th>Client Phone</th>
                                                <th>Comment</th>
                                                <th>Invoice Type</th>
                                                <th>Amount</th>
                                                <th>Agent</th>
                                                <th>Brand</th>
                                                <th>Payment Link</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $counter = 1;
                                            @endphp

                                            @foreach ($UnPaid as $payment)
                                                @if (str_word_count($payment->comments) > 3)
                                                    @php
                                                        $commentsWithoutDots = implode(' ', array_slice(str_word_count($payment->comments, 1), 0, 3));
                                                        $comments = $commentsWithoutDots . '...';
                                                    @endphp
                                                @else
                                                    @php
                                                        $comments = $payment->comments;
                                                    @endphp
                                                @endif

                                                <tr>
                                                    <td>{{ $counter }}</td>
                                                    <td>{{ $payment->updated_at }}</td>
                                                    <td><a
                                                            href="mailto:{{ $payment->customeremail }}">{{ $payment->customeremail }}</a>
                                                    </td>
                                                    <td><a
                                                            href="tel:+{{ $payment->customerphone }}">{{ $payment->customerphone }}</a>
                                                    </td>
                                                    <td data-toggle="tooltip" data-placement="bottom"
                                                        title="{{ ucwords($payment->comments) }}">{{ ucwords($comments) }}
                                                    </td>
                                                    <td>{{ $payment->paymenttype }}</td>
                                                    <td>{{ $payment->amount }}</td>
                                                    <td>{{ $payment->agent_name }}</td>
                                                    <td>{{ $payment->brand_name }}</td>
                                                    <td><button class="copyLink"
                                                        data="https://pay.amazelogo.com/payment/<?php echo $payment->link; ?>">Payment
                                                        Link</button></td>                                                </tr>
                                                @php
                                                    $counter++;
                                                @endphp
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Sr #</th>
                                                <th>Date / Time</th>
                                                <th>Client Email</th>
                                                <th>Client Phone</th>
                                                <th>Comment</th>
                                                <th>Invoice Type</th>
                                                <th>Amount</th>
                                                <th>Agent</th>
                                                <th>Brand</th>
                                                <th>Payment Link</th>

                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            @endcan
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
    </body>

    </html>
@endsection
