
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h1><p><span style="color: red;">Customer Info</span></p></h1>
                    @if(isset($first_name)) <p>Fisrt Name: <span style="red">{{$first_name}}</span></p>@endif
                    @if(isset($last_name))<p>Last Name: <span style="red">{{$last_name}}</span></p>@endif
                    @if(isset($email))<p>Email: <span style="red">{{$email}}</span></p>@endif
                    @if(isset($phone_number))<p>Phone number: <span style="red">{{$phone_number}}</span></p>@endif

                    <h1><p><span style="color: red">Customer meeting Info</span></p></h1>

                    @if(isset($title))<p>Title: <span style="red">{{$title}}</span></p>@endif
                    @if(isset($start_time))<p>Start Time: <span style="red">{{$start_time}}</span></p>@endif
                    @if(isset($duration))<p>Duration: <span style="red">{{$duration}}</span></p>@endif
                    @if(isset($location)) <p>Location: <span style="red">{{$location}}</span></p>@endif
                    <h1><p><span style="color: red">Confirm Meeting</span></p></h1>
                    <p>
                        @if(isset($URLAccept))<a style="color: #1c7430;font-size: larger;text-decoration: none;font-weight:bold;" target="_blank" href="https://{{$URLAccept}}">Confirm</a>@endif
                        @if(isset($URLReject))<a target="_blank" style="color: red;font-size: larger;text-decoration: none;font-weight:bold;" href="https://{{$URLReject}}">Reject</a>@endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>








