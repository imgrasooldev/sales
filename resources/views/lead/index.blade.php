@include('lead.includes.siteHeader')
    <section class="dashboardWrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1 pad-zero">
                    @include('lead.includes.sidebar')
                </div>
                <div class="col-md-11 pad-zero">
                    <div class="dashboardheader">
                        <div class="container">
                            <div class="header">
                                @include('lead.includes.header')
                            </div>
                            <div class="mainamount">
                                <span>This Month</span>
                                <h4 id="my-element"></h4>
                            </div>
                            <div class="celebration">
                                <div class="imgg1">
                                    <img class="sales-image" src="{{ asset('public/assets/images/fireworks.gif') }}" style="display:none;">
                                </div>
                                <div class="imgg2">
                                    <img class="sales-image" src="{{ asset('public/assets/images/celeb.gif') }}" style="display:none;">
                                </div>
                                <div class="imgg3">
                                    <img class="sales-image" src="{{ asset('public/assets/images/fireworks.gif') }}" style="display:none;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mainWrap">
                        <div class="container">
                            <div class="salesOverview">
                                <h4>Sales Overview</h4>
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5><span>Today</span> ${{ number_format($today[0]->amount) }}</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>
                                            <span>Yesterday</span> ${{ number_format($yesterday[0]->amount) }}
                                        </h5>
                                    </div>
                                    <div class="col-md-4">
                                        <h5><span>This Month</span> ${{ number_format($month[0]->amount) }}</h5>
                                    </div>

                                    <div class="col-md-4">
                                        <h5><span>Unpaid This Month</span> ${{ number_format($un_paid_month[0]->amount) }}</h5>
                                    </div>

                                    <div class="col-md-4">
                                        <h5><span>Last Month</span> ${{ number_format($last_month[0]->amount) }}</h5>
                                    </div>


                                    <div class="col-md-4">
                                        <h5><span>This Year</span> ${{ number_format($year[0]->amount) }}</h5>
                                    </div>



                                </div>
                            </div>

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
                                                                <a href="{{ Route('user_profile', $user->id) }}">
                                                                    <img style="width: 100px; height: 100px; border-radius: 50%" src="{{ asset('public/profiles/' . $user->profile_image) }}" alt="{{ $user->name }} {{ $user->last_name }}" title="{{ $user->name }} {{ $user->last_name }}">
                                                                </a>
                                                            </span> {{ $user->name }} {{ $user->last_name }}
                                                        </td>
                                                        <td class="text-center">{{ number_format($user->target) }}</td>
                                                        <td class="text-center">{{ number_format($user->achieved) }}</td>
                                                        @php
                                                            $per = ($user->achieved / $user->target) * 100;
                                                        @endphp
                                                        @if ($per > 85)
                                                        <td class="green text-center {{$per}}">{{ (int) $per }}%</td>
                                                        @elseif ($per > 70 && $per <= 85)
                                                        <td class="yellow text-center {{$per}}">{{ (int) $per }}%</td>
                                                        @else
                                                            <td class="red text-center {{$per}}">{{ (int) $per }}%</td>
                                                        @endif

                                                        <td class="text-center">
                                                            @if ( $user->achieved > $user->target )
                                                            @php
                                                            $overachieved = str_replace("-","",number_format($user->target - $user->achieved));
                                                            @endphp
                                                            ${{ $overachieved . " Over Achieved" }}
                                                            @else
                                                            ${{ number_format($user->target - $user->achieved)
                                                            }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            @if ($flag)
                                                <tr>
                                                    <td scope="row">
                                                        <span>
                                                            <a href="{{ Route('admin.user_profile', $check_user->id) }}">
                                                                <img style="width: 100px; height: 100px; border-radius: 50%" src="{{ asset('public/profiles/' . $check_user->profile_image) }}" alt="{{ $check_user->name }} {{ $check_user->last_name }}" title="{{ $check_user->name }} {{ $check_user->last_name }}">
                                                            </a>
                                                        </span> {{ $check_user->name }}
                                                        {{ $check_user->last_name }}
                                                    </td>
                                                    <td class="text-center">{{ number_format($check_user->target) }}</td>
                                                    <td class="text-center">{{ number_format(0) }}</td>

                                                    <td class="red text-center">{{ '0' }}%</td>
                                                    <td class="text-center">
                                                        {{ number_format($check_user->target) }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

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
                                                    <tr>
                                                        <td scope="row">
                                                            <span>
                                                                <a href="{{ $brand->url }}" target="_blank">
                                                                    <img style="width: 80px; height: 80px; border-radius: 50%" src="{{ asset('public/images/' . $brand->image) }}" alt="{{ $brand->name }}" title="{{ $brand->name }}">
                                                                </a>
                                                            </span> {{ $brand->name }}</td>
                                                        <td class="text-center">${{ number_format($brand->amount, 2) }}
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            @if ($flag)
                                                <tr>
                                                    <td scope="row">
                                                        <span>
                                                            <a href="{{ Route('admin.edit_brand', $check_brand->id) }}">
                                                                <img style="width: 80px; height: 80px; border-radius: 50%" src="{{ asset('public/images/' . $check_brand->image) }}" alt="{{ $check_brand->name }}" title="{{ $check_brand->name }}">
                                                            </a>
                                                        </span> {{ $check_brand->name }}
                                                    </td>
                                                    <td class="text-center">${{ '0' }}</td>
                                                </tr>
                                            @endif
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

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

                                            @if (str_word_count($payment->comments) > 3 )
                                            @php
                                            $commentsWithoutDots = implode(' ', array_slice(str_word_count($payment->comments,1), 0, 3));
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
                                                <td><a href="mailto:{{ $payment->customeremail }}">{{ $payment->customeremail }}</a></td>
                                                <td><a href="tel:{{ $payment->customerphone }}">{{ $payment->customerphone }}</a></td>
                                                <td data-toggle="tooltip" data-placement="bottom" title="{{ ucwords($payment->comments) }}">{{ ucwords($comments) }}</td>
                                                <td>{{ $payment->paymenttype }}</td>
                                                <td>${{ $payment->amount }}</td>
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
        $currentSales = $month[0]->amount;
        ?>
        $('#leadsTable').DataTable();

        //----- Celebration JS ---------//

        // Determine the sales target value
        var salesTarget = <?php echo $salesTarget; ?>;
        // Create a function that checks if the sales target has been reached
        function checkSales() {
            // Get the current sales value from your data source
            var currentSales = <?php echo $currentSales; ?>;
            var currentSalesWithDollorSign = '$' + currentSales;
            $('#my-element').html(currentSalesWithDollorSign);
            // Check if the sales target has been reached
            if (currentSales >= salesTarget) {
                console.log('if working');
                // If the sales target has been reached, display the image
                $('.sales-image').css('display', 'block');
            } else {
                console.log('else working');
            }
        }
        checkSales();
        $('.menu-Bar').click(function() {
            $(this).toggleClass('open');
            $('.menuWrap').toggleClass('open');
            $('body').toggleClass('ovr-hiddn');
        });
    </script>
    </body>

    </html>
    @include('lead.includes.scripts')
