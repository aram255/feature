<div class="row">
    <input type="hidden" name="practitioner_id" id="user_id" value="{{$profile->id}}" />
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Personal info</h6>
            </div>
            <div class="card-body">
                <div class="form-group nopadding">
                    <span class="el_item">First name: <label>{{$profile->first_name}}</label></span>
                    <span class="el_item">Last name: <label>{{$profile->last_name}}</label></span>
                    <span class="el_item">Gender: <label>{{$profile->gender == null ? '---' : $profile->gender}}</label></span>
                    <span class="el_item">Phone number: <label>{{$profile->phone_number}}</label></span>
                    <span class="el_item">Email: <label>{{$profile->email}}</label></span>
                    <span class="el_item">Languages: <label>{{$profile->languages}}</label></span>
                    <span class="el_item">Created: <label>{{$profile->created_at}}</label></span>
                </div>
                <div class="my-2"></div>
            </div>
        </div>
    </div>
</div>
<div class="modal-buttons">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>