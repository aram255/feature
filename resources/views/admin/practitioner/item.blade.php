<h1>{{$id}}</h1>
<div class="row">

    <input type="hidden" name="practitioner_id" id="practitioner_id" value="{{$profile->id}}" />
{{--    <input type="hidden" name="practitioner_id" id="email_r" value="{{$profile->email}}" />--}}
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Personal info</h6>
            </div>
            <div class="card-body">
                <div class="form-group nopadding">
                    <span class="el_item">First name:<label>{{$profile->first_name}}</label></span>
                    <span class="el_item">Last name: <label>{{$profile->last_name}}</label></span>
                    <span class="el_item">Gender: <label>{{$profile->gender == null ? '---' : $profile->gender}}</label></span>
                    <span class="el_item">Location: <label>{{$profile->country}}</label> / <label>{{$profile->city}}</label> / <label>{{$profile->time_zone}}</label></span>
                    <span class="el_item">Phone number: <label>{{$profile->phone_number}}</label></span>
                    <span class="el_item">Email: <label>{{$profile->email}}</label></span>
                    <span class="el_item">Languages: <label>{{$profile->languages}}</label></span>
                </div>
                <div class="my-2"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Details</h6>
            </div>
            <div class="card-body">
                <div class="form-group nopadding">
                    <span class="el_item">Practice: <label>{{$profile->practice}}</label></span>
                    <span class="el_item">Speciality: <label>{{$profile->speciality}}</label></span>
                    <span class="el_item">Price selection: <label class="capitalize">{{$profile->price_selection}}</label></span>
                    <span class="el_item">Mode of delivery: <label class="capitalize">{{$profile->mode_of_delivery == 'virtual' ? 'Virtual' : 'In Person'}}</label></span>
                    <span class="el_item">Illnesses and symtoms: <label> --- </label></span>
                </div>
                <div class="my-2"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Status</h6>
            </div>
            <div class="card-body">
                <div class="form-group" id='validation_container'>
                    <select class="form-select form-control" id="practitioner_status" aria-label="Default select example">
                        <option @if($profile->status == 'validation') selected @endif value="validation">Validation</option>
                        <option @if($profile->status == 'rejected') selected @endif value="rejected">Reject</option>
                        <option @if($profile->status == 'disabled') selected @endif value="disabled">Disabled</option>
                        <option @if($profile->status == 'active') selected @endif value="active">Active</option>
                    </select>
                </div>
                <div class="float-right">
                    <a href="#" class="btn btn-success" id="changeStatusBtn">
                        <span  onclick="saveStatus()" class="text">Save</span>
                    </a>
                </div>
                <div class="my-2"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Services</h6>
            </div>
            <div class="card-body fixed-height">
                @isset($profile->services)
                <div class="row">
                    @foreach($profile->services as $service)
                        <div class="service_container col-lg-4">
                            <span class="service_title">{{$service['title']}}</span>
                            @isset($profile->services)
                                <div class="service_sessions">
                                    @foreach($service['session'] as $session)
                                        <span>{{$session}}</span>
                                    @endforeach
                                </div>
                            @endisset
                            <div class="service_price">
                                {{$service['price']}}
                            </div>
                            @isset($profile->services)
                                <ul class="service_points">
                                    @foreach($service['points'] as $point)
                                        <li>{{$point}}</li>
                                    @endforeach
                                </ul>
                            @endisset
                        </div>
                    @endforeach
                </div>
                @endisset
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">About info</h6>
            </div>
            <div class="card-body fixed-height">
                {{$profile->description}}
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Reviews
                    <span class="float-right">
                        Rate
                        @if($profile->rate)
                            @for ($i = 0; $i < $profile->rate; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        @else
                            ---
                        @endif
                    </span>
                </h6>
            </div>
            <div class="card-body fixed-height">
                @if(count($profile->reviews))
                    @foreach ($profile->reviews as $review)
                        <span class="el_item">
                            <label>{{$review->created_at}}</label> /
                            <label>
                                @for ($i = 0; $i < $review->rate; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </label>
                        </span>
                        <span class="el_item">{{$review->description}}</span>
                        <hr>
                    @endforeach
                @else
                    No reviews
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Documents</h6>
            </div>
        </div>
    </div>
</div>
<div class="modal-buttons">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
<script>
        function saveStatus(status){
            Loading.add($('#changeStatusBtn'));

            id = $('#practitioner_id').val();
            // var email_r = $('#email_r').val();
            // alert(email_r)
            status = $('#practitioner_status').val();
            statusText = $( "#practitioner_status option:selected" ).text()

            $.ajax({
                type: "GET",
                url: "{{route('changeStatus')}}",
                data: { id:id, status: status },
                dataType: 'json',
                success: function(response){
                    if(response.status == 0){
                        toastr['error'](response.message, 'Error');
                    }
                    if(response.status == 1){
                        $('#row_'+id+" .status").html(statusText)
                        toastr['success']('Saved.', 'Success');
                    }
                    Loading.remove($('#changeStatusBtn'));
                }
            });
        }
</script>
