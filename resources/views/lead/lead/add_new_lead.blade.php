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
                        <form action="{{ Route('create_lead') }}" method="POST"
                            class="container">
                            @csrf
                            <div class="adduser">
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-info alert-dismissible fade show z-50" role="alert">
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
                                <h4>Add New Lead</h4>
                                <div class="row">


                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>First Name</label>
                                            <input required name="first_name" placeholder="John" type="text">
                                            @if ($errors->has('name'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('first_name') }}</p>
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
                                    <div class="col-md-12">
                                        <div class="addfield">
                                            <label>Lead Title</label>
                                            <input required name="lead_title" placeholder=""
                                                type="text">
                                            @if ($errors->has('lead_title'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('lead_title') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="addfield">
                                            <label>Description</label>
                                            <select id="description" name="description" required class="form-control">
                                                <option value="Email Lead">Email Lead</option>
                                                <option value="Facebook Message">Facebook Message</option>
                                                <option value="Instagram Message">Instagram Message</option>
                                                <option value="Inbound Call">Inbound Call</option>
                                                <option value="Referral Call">Referral Call</option>
                                            </select>
                                            @if ($errors->has('description'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('description') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Email</label>
                                            <input required type="email" placeholder="" name="email">
                                            @if ($errors->has('eamil'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('eamil') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="addfield">
                                            <label>Phone</label>
                                            <input required type="tel" placeholder="" name="phone">
                                            @if ($errors->has('phone'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('phone') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="addfield">
                                            <label>Value Lead ($)</label>
                                            <input required type="number" min="1" placeholder=""
                                                name="lead_value">
                                            @if ($errors->has('lead_value'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('lead_value') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="addfield">
                                            <label>Status</label>
                                            <select id="status" name="status" required class="form-control">
                                                <option value="No Answer">No Answer</option>
                                                <option value="Leave Voicemail">Leave Voicemail</option>
                                                <option value="Busy, will call back late">Busy, will call back late
                                                </option>
                                                <option value="Payment Done">Payment Done</option>
                                                <option value="Partial Payment Received">Partial Payment Received
                                                </option>
                                                <option value="Not Interested">Not Interested</option>
                                                <option value="Payment Refunded">Payment Refunded</option>
                                                <option value="Already in Progress">Already in Progress</option>
                                            </select>
                                            @if ($errors->has('status'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('status') }}</p>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="addfield">
                                            <label>Comment</label>
                                            <textarea class="form-control required" id="comments" name="comment" spellcheck="false"></textarea>
                                            @if ($errors->has('comment'))
                                                <p class="bg-danger w-full mt-2 p-2 rounded-lg text-white">
                                                    {{ $errors->first('comment') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <button type="submit">Add Lead</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    @include('includes.scripts')
    <script>
        $('#leadsTable').DataTable();
    </script>
    </body>

    </html>
