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
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title', __('site.Home') )

@extends('app.layouts.app_home')


@section('content')

    <section>
        <div class="container">
            <div  data-tf-on-submit="submit" data-tf-widget="{{$TypeFormView->url}}" style="width:100%;height:400px;"></div><script src="//embed.typeform.com/next/embed.js"></script>
            <input type="hidden" name="" value="{{ Request::segment(4) }}" id="meeting_id">
            <script>
                function submit(event) { // this needs to be available on global scope (window)


                        var meetingID = $('#meeting_id').val();
                        var responseID = event.response_id;
                        var _token = $('input[name="_token"]').val();
                        $.ajax({
                            url: "{{ route('edit-response-id',app()->getLocale()) }}",
                            type: "POST",
                            data: {
                                meetingID: meetingID,
                                responseID: responseID,
                                _token:_token
                            },
                            success: function (data) {
                              // console.log(data.yes);
                                alert(data.yes)
                            },
                            error: function(data) {
                                alert(data.no)
                            }
                        });
                }

            </script>
        </div>
    </section>
@endsection

@section('style')


@endsection
