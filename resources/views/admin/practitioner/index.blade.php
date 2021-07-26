@extends('admin.layouts.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

    $(document).ready(function() {
        $('#filter_status').on('change', function () {
            $(this).closest("form").submit();
        });
    });</script>
@section('content')


    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Practitioners</h1>

        </div>

        <!-- Modal -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
            </div>
            <div class="card-body">
                <div class="form-group col-md-2 float-right nopadding">
                    <form amethod="post"  action="{{route('adminPractitioners')}}">
                        <select  class="form-control" name="status" id="filter_status">
                            <option value=''>-- Select status--</option>
                            <option value='pending' @if(!empty($CheckStatus) && $CheckStatus == 'pending') selected="selected" @endif >Pending</option>
                            <option value='accept'     @if(!empty($CheckStatus) && $CheckStatus == 'accept')     selected="selected" @endif>Accept</option>
                            <option value='reject'   @if(!empty($CheckStatus) && $CheckStatus == 'reject')   selected="selected" @endif>Reject</option>
                            <option value='disable'   @if(!empty($CheckStatus) && $CheckStatus == 'disable')   selected="selected" @endif>Disable</option>
                        </select>
                    </form>

                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Speciality</th>
                            <th>Practice</th>
                            <th>Created</th>
                            <th>Status</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Practitioners as $val)
                            <tr id="row_12" role="row" class="odd">
                                <td class="sorting_1">{{$val->id}}</td>
                                <td>{{$val->first_name}}</td>
                                <td>Afghanistan Andaman and Nicobar Islands</td>
                                <td>
                                    @foreach($PractitionerSpecialities->where('practitioner_id',$val->id) as $ValPractitionerSpecialities)
                                        @if(!empty($ValPractitionerSpecialities->title))
                                            {{ $ValPractitionerSpecialities->title }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($PractitionerPractice->where('practitioner_id',$val->id) as $ValPractitionerPractitionerPractice)
                                        @if(!empty($ValPractitionerPractitionerPractice->title))
                                            <label>{{ $ValPractitionerPractitionerPractice->title }}</label>
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{$val->created_at}}</td>
                                <td class=" status" @if($val->status == 'pending') style="color: red" @endif>{{$val->status}}</td>
                                <td class=" content-middel"><a href="javascript:;" data-toggle="modal"
                                                               data-target="#show_info{{$val->id}}"
                                                               class="btn btn-success item_edit btn-sm btn-circle"><i
                                            class="fas fa-edit"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('css')
        <link href="/backend/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    @endpush
    @push('script')
        <script src="/backend/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="/backend/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    @endpush


    <!--  item blade -->


    @foreach($Practitioners as $profile)
        <div class="modal" id="show_info{{$profile->id}}">
            <div style="max-width: 1119px;" class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Tag</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">

                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">


                                    <div class="row">

                                        <input type="hidden" name="practitioner_id" id="practitioner_id"
                                               value="{{$profile->id}}"/>
                                        <input type="hidden" name="practitioner_id" id="email_r"
                                               value="{{$profile->email}}"/>
                                        <div class="col-lg-4">
                                            <div class="card shadow mb-4">
                                                <div class="card-header py-3">
                                                    <h6 class="m-0 font-weight-bold text-primary">Personal info</h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group nopadding">
                                                        <span
                                                            class="el_item">First name:<label>{{$profile->first_name}}</label></span>
                                                        <span
                                                            class="el_item">Last name: <label>{{$profile->last_name}}</label></span>
                                                        <span
                                                            class="el_item">Gender: <label>{{$profile->gender == null ? '---' : $profile->gender}}</label></span>
                                                        <span
                                                            class="el_itmodal-dialog modal-lgem">Location: <label>{{$profile->country}}</label> / <label>{{$profile->city}}</label> / <label>{{$profile->time_zone}}</label></span>
                                                        <span
                                                            class="el_item">Phone number: <label>{{$profile->phone_number}}</label></span>
                                                        <span class="el_item">Email: <label>{{$profile->email}}</label></span>
                                                        @foreach($Lang->where('practitioner_id',$profile->id) as $ValLang)
                                                            <span
                                                                class="el_item">Languages: <label>{{$ValLang->language}}</label></span>
                                                        @endforeach
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

                                                        <span
                                                            class="el_item">Practice:
                                                            @foreach($PractitionerPractice->where('practitioner_id',$profile->id) as $ValPractitionerPractitionerPractice)
                                                                @if(!empty($ValPractitionerPractitionerPractice->title))
                                                                    <label>{{ $ValPractitionerPractitionerPractice->title }}</label>
                                                                @endif
                                                            @endforeach
                                                        </span>
                                                        <span
                                                            class="el_item">Speciality:
                                                             @foreach($PractitionerSpecialities->where('practitioner_id',$profile->id) as $ValPractitionerSpecialities)
                                                                @if(!empty($ValPractitionerSpecialities->title))
                                                                    <label>{{ $ValPractitionerSpecialities->title }}</label>
                                                                @endif
                                                             @endforeach

                                                        </span>
                                                        <span class="el_item">Price selection: <label
                                                                class="capitalize">{{$profile->price_selection}}</label></span>
                                                        <span class="el_item d-flex">Mode of delivery: <label
                                                                class="capitalize">
{{--                                                                {{$profile->virtual == 'virtual' ? 'Virtual' : 'In Person'}}--}}
                                                                <span class="mx-1 d-inline-block">
                                                                    @if($profile->virtuall == "virtuall")
                                                                        Virtual /
                                                                    @endif
                                                                </span>
                                                                <span>

                                                                    @if($profile->in_persion == "in_persion")
                                                                        In Person
                                                                    @endif
                                                                </span>
                                                            </label></span>
                                                        <span
                                                            class="el_item">Illnesses and symtoms: <label> --- </label></span>
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
                                                    <form action="{{route('changeStatus')}}" method="post">
                                                        {{csrf_field()}}
                                                    <div class="form-group" id='validation_container'>
                                                        <input type="hidden" name="p_id" value="{{$profile->id}}">
                                                        <select name="status" class="form-select form-control"
                                                                id="practitioner_status"
                                                                aria-label="Default select example">
                                                            <option @if($profile->status == 'pending') selected
                                                                    @endif value="pending">Pending
                                                            </option>
                                                            <option @if($profile->status == 'reject') selected
                                                                    @endif value="reject">Reject
                                                            </option>
                                                            <option @if($profile->status == 'disable') selected
                                                                    @endif value="disable">Disable
                                                            </option>
                                                            <option @if($profile->status == 'accept') selected
                                                                    @endif value="accept">Accept
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="float-right">
{{--                                                        <a href="#" class="btn btn-success" id="changeStatusBtn">--}}
{{--                                                            <span class="text">Save</span>--}}
{{--                                                        </a>--}}
                                                        <input type="submit" class="btn btn-success" id="changeStatusBtn">
                                                    </div>
                                                    <div class="my-2"></div>
                                                    </form>
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
                                                                                    @foreach($Service->where('practitioner_id',$profile->id) as $ServiceValue)
                                                                                        <div class="service_container col-lg-4">
                                                                                            <span class="service_title" >{{$ServiceValue['title']}}</span>
                                                                                                <div class="service_sessions">
                                                                                                    <span class="sp_a">Sessions</span>
                                                                                                    @foreach($ServiceSession->where('services_id',$ServiceValue->id) as $session)
                                                                                                        <span><li>{{$session->sessions}}</li></span>
                                                                                                    @endforeach
                                                                                                </div>
                                                                                            <div class="service_price">
                                                                                                $ {{$ServiceValue['price']}}
                                                                                            </div>
                                                                                                <ul class="service_points">
                                                                                                    <span class="sp_a" >Description</span>
                                                                                                    @foreach($ServiceDescription->where('services_id',$ServiceValue->id) as $description)
                                                                                                        <span><li>{{$description->description}}</li></span>
                                                                                                    @endforeach
                                                                                                </ul>
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
                                                    @if(count($Reviews->where('practitoner_id',$profile->id)))
                                                        @foreach ($Reviews->where('practitoner_id',$profile->id)  as $review)
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
                                                <div class="mb-3">
                                                    <div class="card-header py-3">
                                                        <h4 class="mb-0 mr-5 font-weight-bold text-primary"><a target="_blank" href="#">ID or Passport</a></h4>
                                                    </div>
                                                    <div class="bg-white px-5 py-3">
                                                        <a class="text-black-50" target="_blank" href="{{ asset('web_sayt/upload_document/'.$profile->id_or_passport) }}">{{$profile->id_or_passport}}</a>
                                                    </div>
                                                </div>




                                                <div class="d-flex">
                                                    <div class="flex-1">
                                                        <div class="card-header py-3">
                                                            <h4 class="m-0 font-weight-bold text-primary"><a  href="#">Additional documents</a></h4>
                                                        </div>
                                                        <div class="bg-white px-5 py-3">
                                                            @foreach($Additional->where('practitioner_id',$profile->id) as $ValAdditional)
                                                                <div class="py-3">
                                                                    <h6 class="m-0 font-weight-bold">
                                                                        <a class="text-black-50" target="_blank" href="{{ asset('web_sayt/upload_document/'.$ValAdditional->additional_document) }}">{{$ValAdditional->additional_document}}</a>
                                                                    </h6>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="flex-1">
                                                        <div class="card-header py-3">
                                                            <h4 class="m-0 font-weight-bold text-primary"><a  href="#">Certifications and Licensing</a></h4>
                                                        </div>
                                                        <div class="bg-white px-5 py-3">
                                                            @foreach($Certifications->where('practitioner_id',$profile->id) as $ValCertifications)
                                                                <div class="py-3">
                                                                    <h6 class="m-0 font-weight-bold">
                                                                        <a class="text-black-50" target="_blank" href="{{ asset('web_sayt/upload_document/'.$ValCertifications->certifications_licensing) }}">{{$ValCertifications->certifications_licensing}}</a>
                                                                    </h6>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-buttons">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- kjkljkljkljkl  -->

    @endforeach
    <script>
        {{--function saveStatus(status){--}}
        {{--    Loading.add($('#changeStatusBtn'));--}}

        {{--    var el = this.status;--}}

        {{--    var id = $('#practitioner_id').val();--}}
        {{--    // var email_r = $('#email_r').val();--}}
        {{--    // alert(email_r)--}}
        {{--    var status = $('#practitioner_status').val();--}}
        {{--    var statusText = $( "#practitioner_status option:selected" ).text()--}}
        {{--        alert(id);--}}
        {{--    $.ajax({--}}
        {{--        type: "GET",--}}
        {{--        url: "{{route('changeStatus')}}",--}}
        {{--        data: { id:id, status: status },--}}
        {{--        dataType: 'json',--}}
        {{--        success: function(response){--}}
        {{--            if(response.status == 0){--}}
        {{--                toastr['error'](response.message, 'Error');--}}
        {{--            }--}}
        {{--            if(response.status == 1){--}}
        {{--                $('#row_'+id+" .status").html(statusText)--}}
        {{--                toastr['success']('Saved.', 'Success');--}}
        {{--            }--}}
        {{--            Loading.remove($('#changeStatusBtn'));--}}
        {{--        }--}}
        {{--    });--}}
        {{--}--}}

        // $(document).ready(function(){

        // $("#changeStatusBtn").on('click', function (e) {
        //     pubItemId = $(this).attr('pub_item_id');
        //     var item = $(this);
        //     var id = item.parent().prev().attr('id');


          // alert('sdsdfdfdf');
            {{--$.ajax({--}}
            {{--    type: "GET",--}}
            {{--    url: "{{route('changeStatus')}}",--}}
            {{--    dataType: 'JSON',--}}
            {{--    data:{_token: "<?php echo csrf_token(); ?>", pubItemId:pubItemId},--}}
            {{--    success: function(response){--}}
            {{--        if(response.status == 1){--}}
            {{--            if(response.published == 1){--}}
            {{--                $item.removeClass('btn-dark').addClass('btn-success');--}}
            {{--                $item.find('.fa').removeClass('fa-exclamation-triangle').addClass('fa-check');--}}
            {{--            }else{--}}
            {{--                $item.removeClass('btn-success').addClass('btn-dark');--}}
            {{--                $item.find('.fa').removeClass('fa-check').addClass('fa-exclamation-triangle');--}}
            {{--            }--}}
            {{--        }--}}
            {{--    }--}}
            {{--});--}}
        // });
        // });


    </script>
    {{ $Practitioners->links() }}
@endsection
