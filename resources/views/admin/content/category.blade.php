@extends('admin.layouts.app')
@section('content')

    @if (Session::get('success'))
        <div class="alert alert-success" style="text-align: center;">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('success') }}
        </div>
    @endif



    <div class="card mb-3">
        <h2 style="text-align: center;">Category Title</h2>

            {{--  Edit category title--}}
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered"  width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$CategoryTitle->title}}</td>
                                <td><a data-toggle="modal" data-target="#edit-title" href="javascript:;"  class="btn btn-success item_edit btn-sm btn-circle"><i class="fas fa-edit"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>


    {{--     Edit Title--}}
    <div class="modal" id="edit-title">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Category Title</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <form class="forms-sample" method="post"  action="{{route('adminEditTitleCategory')}}" >
                                    {{csrf_field()}}

                                    <div class="form-group">
                                        <span class="el_item">Title:</span>
                                        <input type="hidden" name="cat_title_id" value="{{$CategoryTitle->id}}">
                                        <input type="text" class="form-control" value="{{$CategoryTitle->title}}"   name="cat_title">
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

    <!-- Title  -->

    <div class="card mb-3">
        <h2 style="text-align: center;">Categories</h2>

        <form method="post" action="{{route('adminDeleteCategory')}}">
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
                            <th>Image</th>
                            <th>Alt</th>
                            <th>Edit</th>
                            <th>Publish</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Category as $key => $category)
                            <tr>
                                <td><input class="group-checkable sb-checkbox" type="checkbox" name="cat_id[{{$key}}]" value="{{$category->id}}"   /></td>
                                <td>{{$category->title}}</td>
                                <td><img width="40" src="{{ asset('web_sayt/img_category/'.$category->img) }}" alt="{{$category->alt}}"></td>
                                <td>{{$category->alt}}</td>
                                <td><a data-toggle="modal" data-target="#edit{{$category->id}}" href="javascript:;"  class="btn btn-success item_edit btn-sm btn-circle"><i class="fas fa-edit"></i></a></td>
                                <td>
                                    @if($category->published == 1)
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
                    <h4 class="modal-title">Add Category</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">

                                <form class="forms-sample" method="post"  action="{{route('adminAddCategory')}}"  enctype="multipart/form-data" >
                                    {{csrf_field()}}

                                    <div class="form-group">
                                        <span class="el_item">Title:</span>
                                        <input type="text" class="form-control"  name="cat" required>
                                    </div>

                                    <div class="form-group">
                                        <span class="el_item">Alt:</span>
                                        <input type="text" class="form-control"  name="alt">
                                    </div>

                                    <div class="form-group">
                                        <span class="el_item">Image:</span>
                                        <input type="file" class="form-control"   name="img" required>
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
    @foreach($Category as  $category)
        <div class="modal" id="edit{{$category->id}}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Category</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">

                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">

                                    <form class="forms-sample" method="post"  action="{{route('adminEditCategory')}}" enctype="multipart/form-data" >
                                        {{csrf_field()}}

                                        <div class="form-group">
                                            <span class="el_item">Title:</span>
                                            <input type="hidden" name="cat_id" value="{{$category->id}}">
                                            <input type="text" class="form-control" value="{{$category->title}}"   name="cat">
                                        </div>

                                        <div class="form-group">
                                            <span class="el_item">Alt:</span>
                                            <input type="text" class="form-control" value="{{$category->alt}}"   name="alt">
                                        </div>

                                        <div class="form-group">
                                            <span class="el_item">Image:</span>
                                            <input type="file" class="form-control"   name="img">
                                        </div>

                                        <div class="form-group">
                                            <span class="el_item">Published:</span>
                                            <select class="browser-default custom-select" name="published">

                                                <option @if($category->published == 1)  selected @endif value="1">Published</option>
                                                <option @if($category->published == 0)  selected @endif value="0">Unpublished</option>
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
        {{ $Category->links() }}
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
