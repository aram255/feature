


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Your zoom meeting Url</div>
                <div class="card-body">
                    <h1><p><span style="color: red;">Customer Info</span></p></h1>
                    <p>Fisrt Name: <span style="red">{{$first_name}}</span></p>
                    <p>Last Name: <span style="red">{{$last_name}}</span></p>
                    <p>Email: <span style="red">{{$email}}</span></p>
                    <p>Phone number: <span style="red">{{$phone_number}}</span></p>

                    <h1><p><span style="color: red">Customer meeting Info</span></p></h1>

                    <p>Title: <span style="red">{{$title}}</span></p>
                    <p>Start Time: <span style="red">{{$start_time}}</span></p>
                    <p>Duration: <span style="red">{{$duration}}</span></p>
                    <p>Password: <span style="red">{{$password}}</span></p>
                    <p>Join Url: <span style="red">{{$JoinUrl}}</span></p>
                    <h1><p><span style="color: red">Confirm Meeting</span></p></h1>
                    <p><a style="color: #1c7430;font-size: larger;text-decoration: none;font-weight:bold;" target="_blank" href="https://{{$URLAccept}}">Confirm</a>  <a target="_blank" style="color: red;font-size: larger;text-decoration: none;font-weight:bold;" href="https://{{$URLReject}}">Reject</a> </p>
                </div>
            </div>
        </div>
    </div>
</div>

