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

{{--    {{dd($data)}}--}}
{{--    <section>--}}
{{--        <div class="container">--}}
{{--            <div class="card mb-3">--}}
{{--                <h2 style="text-align: center;">My Meetings Zoom  </h2>--}}
{{--                <form action="{{route('zoom-delete',[app()->getLocale()])}}" method="post" >--}}
{{--                    {{csrf_field()}}--}}
{{--                    <div class="card-header py-3">--}}
{{--                        <button class="btn btn-danger"  type="submit">Remove</button>--}}
{{--                    </div>--}}

{{--                    --}}{{--  Edit category title--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="table-responsive">--}}
{{--                            <table class="table table-bordered"  width="100%" cellspacing="0">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th style="width: 3%;"><input id="checkAll" class="group-checkable sb-checkbox" type="checkbox" ></th>--}}
{{--                                    <th>Title</th>--}}
{{--                                    <th>Start Time</th>--}}
{{--                                    <th>Duration</th>--}}
{{--                                    <th>Time Zone</th>--}}
{{--                                    <th>Remove</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                @foreach($data->meetings as $val)--}}
{{--                                    <tr>--}}
{{--                                        <td><input class="group-checkable sb-checkbox" type="checkbox" name="form_id[]" value=""></td>--}}
{{--                                        <td><a href="{{$val->join_url}}" target="_blank">{{$val->topic}}</a></td>--}}
{{--                                        <td>{{date('d-m-Y-H:i:s', strtotime($val->start_time)) }}</td>--}}
{{--                                        <td>{{$val->duration}}</td>--}}
{{--                                        <td>{{$val->timezone}}</td>--}}
{{--                                        <td>--}}

{{--                                                <input type="hidden" name="delete_id" value="{{$val->id}}">--}}
{{--                                                <input type="submit" value="Remove">--}}

{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--    </section>--}}

    <section>
        <div class="container">
            <div class="card mb-3">
                <h2 style="text-align: center;">My Meetings Zoom  </h2>
                <form action="{{route('zoom-delete-table',[app()->getLocale()])}}" method="post" >
                    {{csrf_field()}}

                    {{--  Edit category title--}}
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered"  width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Start Time</th>
                                    <th>Duration</th>
                                    <th>Remove</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $val)
                                    <tr>
                                        <td><a href="{{$val->join_url}}" target="_blank">{{$val->title}}</a></td>
                                        <td>{{date('d-m-Y-H:i:s', strtotime($val->start)) }}</td>
                                        <td>{{$val->duration}}</td>
                                        <td>
                                            <input type="hidden" name="delete_id" value="{{$val->id}}">
                                            <input type="hidden" name="delete_meeting_id" value="{{$val->meeting_id}}">
                                            <input type="submit" value="Remove">
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
    </section>
@endsection

@section('style')


@endsection
