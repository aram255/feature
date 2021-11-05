
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h1><p><span style="color: red;">Practitioner Info</span></p></h1>
                    @if(isset($first_name)) <p>Fisrt Name: <span>{{$first_name}}</span></p>@endif
                    @if(isset($last_name))<p>Last Name: <span >{{$last_name}}</span></p>@endif
                    @if(isset($email))<p>Email: <span>{{$email}}</span></p>@endif
                    @if(isset($service_name))<p>Service Name: <span>{{$service_name}}</span></p>@endif
                    @if(isset($status))<p>Status: <span style="@if($status == 'Rejected')color: red @else color: #1c7430 @endif ">{{$status}}</span></p>@endif
                </div>
            </div>
        </div>
    </div>
</div>






