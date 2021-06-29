@section('style header')
    <link rel="stylesheet" href="{{ asset('web_sayt/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/owl-carousel-min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/star-rating.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/css/main.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
                $("#checkAll").click(function () {
                    $('input:checkbox').not(this).prop('checked', this.checked);
                });
        });
    </script>
@endsection

@section('title', __('site.Home') )

@extends('app.layouts.app_home')


@section('content')


    @if (Session::get('success'))
        <div class="alert alert-success" style="text-align: center;">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('success') }}
        </div>
    @endif

     <section>
             <div class="container">
                        <div class="card mb-3">
                            <h2 style="text-align: center;">My Intake Forms  </h2>
                            <form action="{{route('delete-type-form-practitioner',[app()->getLocale()])}}" method="post">
                                {{csrf_field()}}
                                <div class="card-header py-3">
                                    <button class="btn btn-primary"  data-toggle="modal" data-target="#add" type="button">Add</button>
                                    <button class="btn btn-danger"  type="submit">Remove</button>
                                </div>

                            {{--  Edit category title--}}
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered"  width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th style="width: 3%;"><input id="checkAll" class="group-checkable sb-checkbox" type="checkbox" ></th>
                                            <th>Title</th>
                                            <th>Edit</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($TypeForm as $val)
                                        <tr>
                                            <td><input class="group-checkable sb-checkbox" type="checkbox" name="form_id[]" value="{{$val->id}}"></td>
                                            <td><a href="{{route('type-form-practitioner-view',[app()->getLocale(),'id'=>$val->id])}}">{{$val->title}}</a></td>
                                            <td><a data-toggle="modal" data-target="#edit{{$val->id}}" href="javascript:;"  class="btn btn-success item_edit btn-sm btn-circle">Edit</a></td>
                                        </tr>
                                         @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </form>
                        </div>



                        {{--     Edit --}}
                 @foreach($TypeForm as $v)
                        <div class="modal" id="edit{{$v->id}}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit My Intake Forms</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">

                                        <div class="col-12 grid-margin stretch-card">
                                            <div class="card">
                                                <div class="card-body">
                                                    <form class="forms-sample" method="post"  action="{{route('edit-type-form-practitioner',[app()->getLocale()])}}" >
                                                        {{csrf_field()}}

                                                        <div class="form-group">
                                                            <span class="el_item">Title:</span>
                                                            <input type="hidden" name="id" value="{{$v->id}}">
                                                            <input type="text" class="form-control" value="{{$v->title}}"   name="title">
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <label for="comment">Url:</label>
                                                                <textarea class="form-control" rows="5" name="url">{{$v->url}}</textarea>
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-gradient-primary mr-2" style="background-color: #28a745; color: white;">Edit</button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                 @endforeach


                 {{--     Add --}}
                 <div class="modal" id="add">
                     <div class="modal-dialog modal-lg">
                         <div class="modal-content">

                             <!-- Modal Header -->
                             <div class="modal-header">
                                 <h4 class="modal-title">Add My Intake Forms</h4>
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                             </div>

                             <!-- Modal body -->
                             <div class="modal-body">

                                 <div class="col-12 grid-margin stretch-card">
                                     <div class="card">
                                         <div class="card-body">
                                             <form class="forms-sample" method="post"  action="{{route('add-type-form-practitioner',[app()->getLocale()])}}" >
                                                 {{csrf_field()}}

                                                 <div class="form-group">
                                                     <span class="el_item">Title:</span>
                                                     <input type="text" class="form-control" value=""   name="title">
                                                 </div>
                                                 <div class="form-group">
                                                         <label for="comment">Url:</label>
                                                         <textarea class="form-control" rows="5" name="url"></textarea>
                                                 </div>
                                                 <button type="submit" class="btn btn-gradient-primary mr-2" style="background-color: #28a745; color: white;">Add</button>
                                             </form>

                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>


             </div>
                    </section>
@endsection

@section('style')


@endsection
