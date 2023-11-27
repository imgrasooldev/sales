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
                <div class="mainWrap mt-5 p-5">
                    <div class="allpaid">
                        <a href="{{ Route('add_new_lead') }}" class="btn btn-success">Add New Lead</a>
                        <br />
                        <br />
                        <h4>All Manual Entry Leads By Users</h4>
                        <table id="leadsTable" class="table table-striped table-bordered dataTable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr #</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Lead Title</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Description</th>
                                    <th>Lead Value</th>
                                    <th>Status</th>
                                    <th>Comment</th>
                                    <th>Created By</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $counter = 1;
                                @endphp
                                @foreach($filter as $item)
                                    @php $check = true @endphp
                                    @foreach ($leads as $lead)
                                        @if (str_word_count($lead->lead_comment) > 3 )
                                        @php
                                        $commentsWithoutDots = implode(' ', array_slice(str_word_count($lead->lead_comment,1), 0, 3));
                                        $comments = $commentsWithoutDots . '...';
                                        @endphp
                                        
                                        @else
                                        @php
                                        $comments = $lead->lead_comment;
                                        @endphp
                                        @endif
                                        
                                        @if($lead->lead_id == $item->id && $check == true)
                                            <tr>
                                            @php $check = false @endphp
                                                <td>{{ $counter }}</td>
                                                <td>{{ $lead->lead_name }}</td>
                                                <td>{{ $lead->lead_last_name }}</td>
                                                <td>{{ $lead->leadTitle }}</td>
                                                <td><a href="mailto:{{ $lead->lead_email }}">{{ $lead->lead_email }}</a></td>
                                                <td><a href="tel:{{ $lead->lead_phone }}">{{ $lead->lead_phone }}</a></td>
                                                <td>{{ $lead->description }}</td>
                                                <td>{{ $lead->leadValue }}</td>
                                                <td>{{ $lead->lead_status }}</td>
                                                <td data-toggle="tooltip" data-placement="bottom" title="{{ ucwords($lead->lead_comment) }}">{{ ucwords($comments) }}</td>
                                                <td>{{ $lead->name." ".$lead->last_name  }}</td>
                                                <td>{{ $lead->created_at }}</td>
                                                <td
                                                    class="text-center d-flex align-items-center justify-content-center">
                                                    <a class="btn btn-sm btn-info" href="{{ Route('edit_lead', $lead->lead_id) }}" title="Edit">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    @if (isset(Auth::user()->id) && Auth::user()->type == 1)
                                                    <a class="btn btn-sm btn-danger deleteLead" href="#" data-leadid="{{ $lead->lead_id }}" title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                    @endif
                                                    <a class="btn btn-sm btn-success leadpopbtn edit_comment" href="#" id="" data="{{ $lead->lead_id }}" data-viewlead_id="{{ $lead->lead_id }}" title="Views">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="#" data="{{ $lead->lead_id }}" class="btn btn-sm btn-primary leadAssignbtn" title="Assign the Lead">
                                                        <i class="fas fa-user-plus"></i>
                                                    </a>
                                                </td>
                                                @php $counter++ @endphp
                                            @endif
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>

                            <tfoot>
                                <th>Sr #</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Lead Title</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Description</th>
                                <th>Lead Value</th>
                                <th>Status</th>
                                <th>Comment</th>
                                <th>Created By</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tfoot>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<div class="leadpop">
    <a href="#" class="closePop"><i class="far fa-times-circle"></i></a>
    <h4 id="leadTitle"></h4>
    <ul class="leadtabs">
        <li class="timelineBtn" data-targetit="box-l2"><a href="#">Timeline</a></li>
    </ul>
    <div class="box-l1 showfirst">
        <ul class="timeline">

        </ul>
        <form role="form" id="addComment" action="{{ Route('add_comment') }}" method="post">
            @csrf
            <textarea placeholder="Comments" id="postComment" name="comment" required></textarea>
            <input type="hidden" class="get_lead_id" name="lead_id" value="">
            <input type="submit" value="Submit">
        </form>
    </div>
</div>

<div class="leadAssign">
    <a href="#" class="closePop2"><i class="far fa-times-circle"></i></a>
    <h4>Assign lead to user</h4>
    <form action="{{ Route('assign_lead') }}" method="POST">
        @csrf
        <div class="row align-items-center">
            <div class="col-md-6">
                <label>
                    Users List
                    <input type="hidden" id="get_user_id" name="lead_id" value="">
                    <select name="user_id" id="">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name.''.$user->last_name }}</option>
                        @endforeach
                    </select>
                </label>
            </div>
            <div class="col-md-6">
                <input type="submit" value="Submit">
            </div>
        </div>
    </form>
</div>
<div class="overlay"></div>

@include('includes.scripts')
<script>
    $('#leadsTable').DataTable();

    $('.leadAssignbtn').on('click', function(){
        var user_id = $(this).attr('data')
        $('#get_user_id').val(user_id)
    })

    $(document).ready(function() {
            $('.edit_comment').on('click', function(){
                $('.timeline').html('')
                var data = $(this).attr('data');
                $('.get_lead_id').val(data)
                $.ajax({
                    type: 'get',
                    url: 'comments',
                    data: {
                        id: data,
                    },
                    success: function(data) {
                        var html = ''

                        $.each(data, function(item){
                            html += '<li><a href="#">'+data[item].name+' '+data[item].last_name+'</a><a class="float-right">'+data[item].created_at+'</a><p>'+data[item].comment+'</p></li>'
                        })
                        $('.timeline').html(html)

                    }
                });
            });



        });
</script>
</body>

</html>
