@section('style header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
          crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('web_sayt/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/service.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/star-rating.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .my-appointments-person-img{
            display: flex;
            align-items: center;
            border-radius: 10px;
            width: 150px;
            height: 150px;
            overflow: hidden;
            justify-content: center;
        }
        .info_imgg{
            /*width: 100%;*/
            object-fit: cover;
            width: 150px;
            height: 150px;
        }

        [data-star-rating] .gl-star-rating--stars[aria-label]:after {
            background: transparent;
            border-radius: 4px;
            border-radius: var(--gl-tooltip-border-radius);
            color: #fed638;
            content: attr(aria-label);
            font-size: .875rem;
            font-size: 18px;
            font-weight: 600;
            margin-left: 12px;
            margin-left: 0;
            padding: 0;
            padding: 5px;
            text-transform: none;
        }


    </style>
@endsection

@section('title', __('site.Home') )

@extends('app.layouts.app_home')


@section('content')



    <script>var body = document.body; body.classList.add("body");</script>
    <section>
        <div class="container">
            <div class="my-appointments">
                <div class="my-appointments__title">
                    <p>My Appointments</p>
                    <p>
                        <span class="my-appointments__title-li active"><a @if($id == 1) style="color: #585858;" @endif href="{{route('my-appointments-customer',[app()->getLocale(),2])}}">Complete</a></span>
                        <span class="my-appointments__title-border"></span>
                        <span class="my-appointments__title-li " ><a @if($id == 2) style="color: #585858;" @endif href="{{route('my-appointments-customer',[app()->getLocale(),1])}}">In Process</a></span>
                    </p>
                </div>

                @if($id == 1 and count($InProcess)>0)
                    @foreach($InProcess as $keyP => $InProcessVal)
                        <div class="my-appointments__complete-process">
                            <div class="my-appointments__complete-process-content">
                                <div class="my-appointments__complete-process-content-flex">
                                    <div class="my-appointments-person__info">
                                        <div class="my-appointments-person__info-cont1 mr-3 my-appointments-person-img">
                                            <img class="my-appointments-person__info-img .info_imgg" src="{{ asset('web_sayt/img_practitioners/'.$InProcessVal->img) }}" alt="" style="width: 100%;">
                                        </div>
                                        <div class="my-appointments-person__info-cont2">
                                            <div class="my-appointments-person__info-name">{{$InProcessVal->first_name}} {{$InProcessVal->last_name}}</div>
                                            <div class="my-appointments-person__info-specialist">Acne Specialist &amp; Holistic
                                                nutritionist (CNP)</div>
                                            <div class="my-appointments-person__info-data">{{date('M-jS, Y  H:i:s', strtotime($InProcessVal->start)) }}</div>
                                        </div>
                                    </div>
                                    <div class="my-appointments-person__complete-process">
                                        <div class="my-appointments-person__complete-process-time">{{$InProcessVal->duration}} Mins Consultation</div>
                                        <div class="my-appointments-person__complete-process-session"><a target="_blank" href="{{$InProcessVal->join_url}}">Join session</a></div>

                                        @foreach( $TypeForm->where('practitioner_id',$InProcessVal->practitioner_id) as $valTypeForm)
                                            @if($CheckTypeForm[$keyP] !== false)
                                                <button style="cursor: unset;" class="my-appointments-person__complete-process-button btn bg-yellow">Completed
                                                </button>
                                            @else
                                                <button class="my-appointments-person__complete-process-button btn bg-yellow">
                                                    <a href="{{route('customer-type-form-practitioner-view',[app()->getLocale(), 'id' => $valTypeForm->id, 'meeting_id' => $InProcessVal->id])}}">Fill Intake Form</a>
                                                </button>
                                            @endif
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif


            <!-- Complete -->
                {{--                <div class="my-appointments__complete-process d-none">--}}
                @if($id == 2  and count($Complete)>0)

                    @foreach($Complete as $InCompleteVal)

                        <div class="my-appointments__complete-process">
                            <div class="my-appointments__complete-process-content">
                                <div class="my-appointments__complete-process-content-flex">
                                    <div class="my-appointments-person__info">

                                        <div class="my-appointments-person__info-cont1 mr-3 my-appointments-person-img">
                                            <img class="my-appointments-person__info-img info_imgg" src="{{ asset('web_sayt/img_practitioners/'.$InCompleteVal->img) }}" alt="">
                                        </div>
                                        <div>
                                            <div class="my-appointments-person__info-cont2">
                                                <div class="my-appointments-person__info-name"><a href="{{route('profile-view-customer',[app()->getLocale(),$InCompleteVal->practitioner_id])}}
                                                    {{--route('add-edit-protocol-practitioner',[
                                                                                         app()->getLocale(),
                                                                                        'user_id'=> $InCompleteVal->user_id,
                                                                                        'practitioner_id'=>$InCompleteVal->practitioner_id,
                                                                                        'service_id'=>$InCompleteVal->service_id
                                                                                        ])--}}">{{$InCompleteVal->first_name}} {{$InCompleteVal->last_name}}</a></div>
                                                <div class="my-appointments-person__info-specialist">Acne Specialist &amp; Holistic
                                                    nutritionist (CNP)
                                                </div>
                                                <div class="my-appointments-person__info-data">{{date('M-jS, Y  H:i:s', strtotime($InCompleteVal->start)) }}</div>
                                            </div>
                                            <div class="person__info-rating qew">

                              <input type="hidden" class="meeting_id" value="{{$InCompleteVal->id}}">
                              <input type="hidden" class="practitioner_id" value="{{$InCompleteVal->practitioner_id}}">
{{--                                 <span class="gl-star-rating gl-star-rating--ltr " data-star-rating="">--}}
{{--                                   <select class="star-rating">--}}
{{--                                      <option value="5">5.0</option>--}}
{{--                                      <option value="4">4.0</option>--}}
{{--                                      <option value="3">3.0</option>--}}
{{--                                      <option value="2">2.0</option>--}}
{{--                                      <option value="1">1.0</option>--}}
{{--                                   </select>--}}

{{--                                   <span class="gl-star-rating--stars s50" role="tooltip" aria-label="5.0">--}}

{{--                                      <span data-index="0" data-value="1" class="gl-active" style="font-size: 28px;"></span>--}}
{{--                                      <span data-index="1" data-value="2" class="gl-active"></span>--}}
{{--                                      <span data-index="2" data-value="3" class="gl-active"></span>--}}
{{--                                      <span data-index="3" data-value="4" class="gl-active"></span>--}}
{{--                                      <span data-index="4" data-value="5" class="gl-selected gl-active"></span>--}}
{{--                                   </span>--}}
{{--                                </span>--}}
                                 @if(isset($ReviewRate->rate))
                                    <span class="gl-star-rating gl-star-rating--ltr " data-star-rating="">
                                       <select class="star-rating">
                                       @for($ReviewRate->rate; $ReviewRate->rate >=1 ; $ReviewRate->rate--)
                                               <option value="{{$ReviewRate->rate}}">{{$ReviewRate->rate}}.0</option>
                                           @endfor
                                       </select>
                                       <span class="gl-star-rating--stars s{{$ReviewRate->rate}}0" role="tooltip" aria-label="{{$ReviewRate->rate}}">
                                             @for($r = 1; $r <= $ReviewRate->rate; $r++)
                                               <span  data-value="{{$r}}" class="gl-selected"></span>
                                           @endfor
                                       </span>
                                    </span>
                               @else
                                <span class="gl-star-rating gl-star-rating--ltr " data-star-rating="">
                                   <select class="star-rating">
                                      <option value="5">5.0</option>
                                      <option value="4">4.0</option>
                                      <option value="3">3.0</option>
                                      <option value="2">2.0</option>
                                      <option value="1">1.0</option>
                                   </select>
                                   <span class="gl-star-rating--stars s50" role="tooltip" aria-label="5.0">

                                      <span data-index="0" data-value="1" class="gl-active" style="font-size: 28px;"></span>
                                      <span data-index="1" data-value="2" class="gl-active"></span>
                                      <span data-index="2" data-value="3" class="gl-active"></span>
                                      <span data-index="3" data-value="4" class="gl-active"></span>
                                      <span data-index="4" data-value="5" class="gl-selected gl-active"></span>
                                  </span>
                                </span>
                                @endif
                                            </div>
                                        </div>
                                    </div>


                                    <div class="my-appointments-person__complete-process">
                                        <div class="my-appointments-person__complete-process-time">{{$InCompleteVal->duration}} Mins Consultation</div>
                                        @php
                                            $CheckStatusProtocol = $StatusProtocol->where('user_id','=',$InCompleteVal->user_id)->where('service_id','=',$InCompleteVal->service_id);
                                        @endphp

                                        @if((count($CheckStatusProtocol)>0))
                                            <button
                                                class="my-appointments-person__complete-process-button procces-button btn bg-yellow">
                                                <a href="{{route('view-protocol-customer',[
                                     app()->getLocale(),
                                    'user_id'=>$InCompleteVal->user_id,
                                    'practitioner_id'=>$InCompleteVal->practitioner_id,
                                    'service_id'=>$InCompleteVal->service_id,
                                    'meeting_id'=>$InCompleteVal->id
                                    ])}}
                                                    ">View Protocol</a>
                                            </button>
                                        @else
                                            <button
                                                class="my-appointments-person__complete-process-button procces-button btn bg-yellow">
                                                <a href="">No Protocol</a>
                                            </button>
                                        @endif

                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif


                @if($id == 2 and count($Complete)>0)
                    {{ $Complete->links() }}
                @endif

                <div class="my-appointments__pagination">
                    <div class="py-5 d-flex justify-content-end">
                        @if($id == 1 and count($InProcess)>0)
                            {{ $InProcess->links("pagination::bootstrap-4") }}
                        @endif
                    </div>
                    {{--                    <a class="page-item-sign" href="#">&lt;</a>--}}
                    {{--                    <a class="page-item page-item-first" href="#">1</a>--}}
                    {{--                    <a class="page-item" href="#">2</a>--}}
                    {{--                    <a class="page-item" href="#">3</a>--}}
                    {{--                    <a class="page-item" href="#">...</a>--}}
                    {{--                    <a class="page-item page-item-last" href="#">7</a>--}}
                    {{--                    <a class="page-item-sign" href="#">&gt;</a>--}}
                </div>
            </div>
        </div>
    </section>


    @include('modal-list')
@endsection

@section('style')


    <script type="text/javascript" src="{{ asset('web_sayt/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/bootstrap/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/my-appointments.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/script.js') }}"></script>
    <script src="{{ asset('web_sayt/js/star-rating.js') }}"></script>
    <script src="{{ asset('web_sayt/js/star-run.js') }}"></script>



    <script>
        $(document).ready(function() {

            // Add Star
            $('.gl-active').click(function () {

                var practitioner_id = $(this).parent().prev().parent().prev().val();
                var meeting_id = $(this).parent().prev().parent().prev().prev().val();

                var star = $(this).attr('data-value');
                var _token = $('input[name="_token"]').val();
                // alert(practitioner_id)
                $.ajax({
                    url: "{{route('add-star',[app()->getLocale()])}}",
                    type: "POST",
                    data: {
                        star: star,
                        practitioner_id: practitioner_id,
                        meeting_id:meeting_id,
                        _token:_token
                    },
                    success: function (data) {
                        console.log(data)

                        if(data.success)
                        {
                            $("#add_star").modal("show");
                        }

                        if(data.error)
                        {

                            $("#no_add_star").modal("show");
                        }

                    },
                    error: function(returnval) {
                      //  alert('The tag you selected has not been added to your list, or it has already been added.');
                        $("#has_already_been_added").modal("show");
                    }
                });
            })

            $('input[type="radio"],input[type="checkbox"],#state').on('change', function () {
                $(this).closest("form").submit();
            });
            $('.find__form-settings').click(function () {
                $(".filter__content").toggleClass("active")
            })
        });

    </script>
@endsection
