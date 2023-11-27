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
                    </div>
                </div>
                <div class="mainWrap">
                    <div class="profilewrap">
                        <div class="row">
                            @if ($user->type == 1)
                            <div class="col-md-9">
                                @else
                                <div class="col-md-12">
                                    @endif
                                    <h3>{{ $user->name }} {{ $user->last_name }}</h3>
                                    <ul class="userdesig">
                                        <li>{{ $user->position }}</li>
                                        <li>
                                            @php
                                            $counter = 0;
                                            @endphp
                                            @foreach ($user_brand as $brand)
                                            @if ($counter >= 1)
                                            {{ ' | ' }}
                                            @endif
                                            {{ $brand->name }}
                                            @php
                                            $counter++;
                                            @endphp
                                            @endforeach
                                        </li>
                                    </ul>
                                    <div class="userinfo">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="profimg">
                                                    <img style="width: 100%" src="{{ asset('public/profiles/' . $user->profile_image) }}" alt="{{ $user->name }} {{ $user->last_name }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <ul>
                                                    <li>
                                                        <span>Full Name</span>
                                                        <h6>{{ $user->name }} {{ $user->last_name }}</h6>
                                                    </li>
                                                    <li>
                                                        <span>Email</span>
                                                        <h6><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></h6>
                                                    </li>
                                                    <li>
                                                        <span>Phone Number</span>
                                                        <h6><a href="tel:{{ $user->phone }}">{{ $user->phone }}</a></h6>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-3">
                                                <ul class="padleft">
                                                    <li>
                                                        <span>Date Of Joining</span>
                                                        <h6>{{ $user->join_date }}</h6>
                                                    </li>
                                                    <li>
                                                        <span>Title</span>
                                                        <h6>{{ $user->position }}</h6>
                                                    </li>
                                                    <li>
                                                        <span>Pseudo Name</span>
                                                        <h6>{{ $user->pseudo_name }}</h6>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-3">
                                                <ul>
                                                    <li>
                                                        <span>Country</span>
                                                        <h6>{{ $user->country }}</h6>
                                                    </li>
                                                    <li>
                                                        <span>Address</span>
                                                        <h6>{{ $user->address }}</h6>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="usertargets">
                                                <ul>
                                                    <li>
                                                        <span>Today Sales</span>
                                                        <h6>${{ number_format($today[0]->amount) }}</h6>
                                                        <span>{{ date('D, d M Y') }}</span>
                                                    </li>
                                                    <li>
                                                        <span>Monthly Sales</span>
                                                        <h6>${{ number_format($month[0]->amount) }}</h6>
                                                        <span>{{ date('M') }} {{ date('Y') }}</span>
                                                    </li>
                                                    <li>
                                                        <span>Yearly Sales</span>
                                                        <h6>${{ number_format($year[0]->amount) }}</h6>
                                                        <span>{{ date('Y') }}</span>
                                                    </li>
                                                    <li>
                                                        <span>Unpaid Leads</span>
                                                        <h6>${{ number_format($un_paid[0]->amount) }}</h6>
                                                        <span>{{ date('Y') }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="useroverview">
                                                <h5>Sales Overview</h5>
                                                <canvas id="myChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    @if ($user->type == 1)
                                    <div class="otheragents">
                                        @else
                                        <div class="otheragents" hidden>
                                            @endif
                                            @foreach ($team as $member)
                                            <div class="relbox">
                                                <h4>{{ $member->name }} {{ $member->last_name }}</h4>
                                                <ul class="otherusersdesig">
                                                    <li>{{ $member->position }}</li>
                                                    {{-- <li>Amaze Logo</li> --}}
                                                </ul>
                                                <ul class="scalelst">
                                                    <li>
                                                        <span>Team Sale</span>
                                                        <h6>{{ number_format($team_sale[0]->amount) }}</h6>
                                                    </li>
                                                    <li>
                                                        <span>Individual</span>
                                                        <h6>{{ number_format($member->amount) }}</h6>
                                                    </li>
                                                </ul>
                                            </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="allpaid">
                                    <h4>All Paid Leads</h4>
                                    <div class="table-responsive">
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
                                                    <td><a href="mailto:{{ strtolower($payment->customeremail) }}">{{ strtolower($payment->customeremail) }}</a></td>
                                                    <td><a href="tel:{{ $payment->customerphone }}">{{ $payment->customerphone }}</a></td>
                                                    <td data-toggle="tooltip" data-placement="bottom" title="{{ $payment->comments }}">{{ $comments }}</td>
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

                            <div class="col-md-12">
                                <div class="allpaid">
                                    <h4>All Unpaid Leads</h4>
                                    <table id="leadsTable" class="table table-striped table-bordered" style="width:100%">
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
                                                <th>Link</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $counter = 1;
                                            @endphp
                                            @foreach ($unpad_leads as $payment)

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
                                                <td>{{ $payment->updated_at }}</td>
                                                <td><a href="mailto:{{ strtolower($payment->customeremail) }}">{{ strtolower($payment->customeremail) }}</a></td>
                                                <td><a href="tel:{{ $payment->customerphone }}">{{ $payment->customerphone }}</a></td>
                                                <td data-toggle="tooltip" data-placement="bottom" title="{{ $payment->comments }}">{{ $comments }}</td>
                                                <td>{{ $payment->paymenttype }}</td>
                                                <td>${{ $payment->amount }}</td>
                                                <td>{{ $payment->agent_name }}</td>
                                                <td>{{ $payment->brand_name }}</td>
                                                <td><a href="https://securepayments.amazelogo.com/payment/{{ $payment->link }}" target="_blank">{{ $payment->link }}</a></td>
                                            </tr>
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
                                                <th>Link</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>




                            <div class="col-md-12">
                                <div class="allpaid">
                                    <h4>Assigned Leads</h4>
                                    <table id="leadsTable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Sr #</th>
                                                <th>Client Name</th>
                                                <th>Lead Title</th>
                                                <th>Description</th>
                                                <th>Client Email</th>
                                                <th>Client Phone</th>
                                                <th>Lead Value</th>
                                                <th>Assined By</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $counter = 1;
                                            @endphp
                                            @foreach ($lead_assigned as $item)
                                            <td>{{ $counter++ }}</td>
                                            <td>{{ $item->firstName.' '.$item->lastName }}</td>
                                            <td>{{ $item->leadTitle }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->telephone }}</td>
                                            <td>{{ $item->leadValue }}</td>
                                            <td>{{ $item->name.' '.$item->last_name }}</td>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Sr #</th>
                                                <th>Client Name</th>
                                                <th>Lead Title</th>
                                                <th>Description</th>
                                                <th>Client Email</th>
                                                <th>Client Phone</th>
                                                <th>Lead Value</th>
                                                <th>Assined By</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            @if(Auth::user()->email == 'jason.brown@amazelogo.com')
                            <div class="col-md-12">
                                <div class="allpaid">
                                    <h4>All Agents Paid Leads</h4>
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
                                                @foreach ($paid_leads as $payment)
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
                                                    <td><a href="mailto:{{ strtolower($payment->customeremail) }}">{{ strtolower($payment->customeremail) }}</a></td>
                                                    <td><a href="tel:{{ $payment->customerphone }}">{{ $payment->customerphone }}</a></td>
                                                    <td data-toggle="tooltip" data-placement="bottom" title="{{ $payment->comments }}">{{ $comments }}</td>
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
                                                <th>Client Name</th>
                                                <th>Lead Title</th>
                                                <th>Description</th>
                                                <th>Client Email</th>
                                                <th>Client Phone</th>
                                                <th>Lead Value</th>
                                                <th>Assined By</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
</section>
@include('includes.scripts')
<script>
    $(document).ready(function() {
        var id = <?php echo $user->id; ?>;
        $.ajax({
            type: 'get',
            url: '/chart',
            data: {
                id: id,
            },
            success: function(data) {
                var date = []
                var amount = []
                for (item of data) {
                    date.push(item.date)
                    amount.push(item.amount)

                }
                // Chart JS
                window.chartColors = {
                    red: 'rgb(255, 99, 132)',
                    orange: 'rgb(255, 159, 64)',
                    yellow: 'rgb(255, 205, 86)',
                    green: 'rgb(75, 192, 192)',
                    blue: '#F27424',
                    purple: 'rgb(153, 102, 255)',
                    grey: 'rgb(231,233,237)'
                };

                var ctx = document.getElementById("myChart").getContext("2d");

                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: date,
                        datasets: [{
                            label: 'Sales',
                            borderColor: window.chartColors.blue,
                            borderWidth: 2,
                            fill: false,
                            data: amount
                        }]
                    },
                    options: {
                        responsive: true,
                        title: {
                            display: true,
                            text: 'Sales Achivement'
                        },
                        tooltips: {
                            mode: 'index',
                            intersect: true
                        },
                        annotation: {
                            annotations: [{
                                type: 'line',
                                mode: 'horizontal',
                                scaleID: 'y-axis-0',
                                value: 2225,
                                endValue: 0,
                                borderColor: 'rgb(75, 192, 192)',
                                borderWidth: 4,
                                label: {
                                    enabled: true,
                                    content: 'Trendline',
                                    yAdjust: -16,
                                }
                            }]
                        }
                    }
                })
            }
        });



    });
</script>
</body>

</html>