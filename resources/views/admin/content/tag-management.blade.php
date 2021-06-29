@extends('admin.layouts.app')
@section('content')
    <!-- Begin Page Content -->
{{--    <div class="modal-backdrop fade show">   <div class="toast-message">Saved.</div> </div>--}}

    @if (Session::get('success'))

{{--    <div id="toast-container" class="toast-top-right">--}}
{{--        <div class="toast toast-success" style="">--}}
{{--            <button type="button" class="close" data-dismiss="alert">×</button>--}}
{{--            <div class="toast-title">{{Session::get('success')}}</div>--}}
{{--            <div class="toast-message">Saved.</div>--}}
{{--        </div>--}}
{{--       --}}
{{--    </div>--}}
<div class="alert alert-success" style="text-align: center;">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ session('success') }}
</div>
   @endif


    <div class="card mb-3">
        <h2 style="text-align: center;">Tag management systems</h2>

      <form method="post" action="{{route('adminDeletePracticesTegManagement')}}">
          {{csrf_field()}}
        <div class="card-header py-3">
            <button class="btn btn-primary"  data-toggle="modal" data-target="#add" type="button">Add</button>
            <button class="btn btn-danger"  type="submit">Remove</button>
        </div>

        {{--  Add--}}
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered"  width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th style="width: 3%;"><input class="group-checkable sb-checkbox" type="checkbox" onclick="toggle(this);"  /></th>
                        <th style="width: 73%;">Title</th>
                        <th>Edit</th>
                        <th>Publish</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($TegManagements as $key => $TegManagement)
                    <tr>
                        <td><input class="group-checkable sb-checkbox" type="checkbox" name="teg_id[{{$key}}]" value="{{$TegManagement->id}}"   /></td>
                        <td>{{$TegManagement->name}}</td>
                        <td><a data-toggle="modal" data-target="#edit{{$TegManagement->id}}" href="javascript:;"  class="btn btn-success item_edit btn-sm btn-circle"><i class="fas fa-edit"></i></a></td>
                        <td>
                            @if($TegManagement->published == 1)
                            <a href="#"  class="btn btn-success item_edit btn-sm btn-circle"><i class="fa fa-check"></i></a>
                            @else
                            <a href="#"  class="btn btn-dark btn-sm btn-circle item_published"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>
                            @endif
                        </td>
{{--                        <td><a data-toggle="modal" data-target="#edit" href="javascript:;" edit_item_id="12" class="btn btn-success item_edit btn-sm btn-circle"><i class="fas fa-trash"></i></a></td>--}}
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
      </form>
    </div>



    {{-- Add--}}
    <div class="modal" id="add">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Tag</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">

                                <form class="forms-sample" method="post"  action="{{route('adminAddPracticesTegManagement')}}" >
                                    {{csrf_field()}}

                                    <div class="form-group">
                                        <span class="el_item">Title:</span>
                                        <input type="text" class="form-control"   name="teg" required>
                                    </div>
                                    <div class="form-group">
                                        <span class="el_item">Published:</span>
                                        <select class="browser-default custom-select" name="published" required>
                                            <option value="1">Published</option>
                                            <option value="0">Unpublished</option>
                                        </select>
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


    {{-- Edit--}}
    @foreach($TegManagements as $TegManagement)
    <div class="modal" id="edit{{$TegManagement->id}}">
        <div class="modal-dialog modal-lg">
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

                                <form class="forms-sample" method="post"  action="{{route('adminEditPracticesTegManagement')}}"  >
                                    {{csrf_field()}}

                                    <div class="form-group">
                                        <span class="el_item">Title:</span>
                                        <input type="hidden" name="teg_id" value="{{$TegManagement->id}}">
                                        <input type="text" class="form-control" value="{{$TegManagement->name}}"   name="teg">
                                    </div>
                                    <div class="form-group">
                                        <span class="el_item">Published:</span>
                                        <select class="browser-default custom-select" name="published">

                                            <option @if($TegManagement->published == 1)  selected @endif value="1">Published</option>
                                            <option @if($TegManagement->published == 0)  selected @endif value="0">Unpublished</option>
                                        </select>
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
    <div class="d-flex justify-content-center">
        {{ $TegManagements->links() }}
    </div>
    <style>
        .hidden {
            margin-left:12px;
            margin-top:24px;
        }
        .z-0{
            display: none;
        }
    </style>

@endsection
