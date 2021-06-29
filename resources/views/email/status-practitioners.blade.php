


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Your check status</div>
                    <div class="card-body">
{{--                        @if (session('resent'))--}}
{{--                            <div class="alert alert-success" role="alert">--}}
{{--                                {{ __('A fresh verification link has been sent to your email address.') }}--}}
{{--                            </div>--}}
{{--                        @endif--}}
                        <h1>Your Status <span style="red">{{$status}}</span></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

