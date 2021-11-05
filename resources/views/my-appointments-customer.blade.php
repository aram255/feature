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
            height: 128px;
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
                                            <img class="my-appointments-person__info-img info_imgg" src="{{ asset('web_sayt/img_practitioners/'.$InProcessVal->img) }}" alt="" style="width: 100%;">
                                        </div>
                                        <div class="my-appointments-person__info-cont2">
                                            <div class="my-appointments-person__info-name">{{$InProcessVal->first_name}} {{$InProcessVal->last_name}}</div>
                                            <div class="my-appointments-person__info-specialist">
                                                @foreach($SpecialitiesInProcess[$keyP] as $ValSpecialitiesComplete)
                                                    {{$ValSpecialitiesComplete->title}}
                                                @endforeach
                                            </div>
                                            <div class="my-appointments-person__info-data">{{date('M-jS, Y  h:i A', strtotime($InProcessVal->start)) }}</div>
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
                @if($id == 2  and count($Complete)>0)

                    @foreach($Complete as $keyInComplete  => $InCompleteVal)
                        <div class="modal fade LeaveReview" id="LeaveReview{{$InCompleteVal->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="position-relative text-center pt-4">
                                        <button type="button" class="close abs" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h5 class="modal-title mx-auto" id="exampleModalLongTitle{{$InCompleteVal->id}}">Leave Review</h5>
                                    </div>
                                    <div class="modal-body text-center pb-5 px-5">
                                        <div class="small-title">Rating</div>
                                        <div class="rate mb-4">
                                            <input type="radio" class="starrr" id="star1" name="rate" value="1" checked />
                                            <label for="star1" title="text">1 star</label>
                                            <input type="radio" class="starrr" id="star2" name="rate" value="2" required />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" class="starrr" id="star3" name="rate" value="3" required />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" class="starrr" id="star4" name="rate" value="4" required />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" class="starrr" id="star5" name="rate" value="5" required />
                                            <label for="star5" title="text">5 stars</label>
                                        </div>

                                        <form method="post" action="{{route('add-review',[app()->getLocale()])}}" class="px-lg-5">
                                            @csrf
                                            <div class="form-group">

                                                <input type="hidden" value="{{$InCompleteVal->id}}" name="meeting_id">
                                                <input type="hidden" class="add_rate" name="add_rate">
                                                <input type="hidden"  value="{{$InCompleteVal->practitioner_id}}" name="practitioner_id">
                                                <textarea class="form-control" id="Textarea" name="add_review" rows="6" required></textarea>
                                            </div>

                                            <div class="d-flex justify-content-center mt-5">
                                                <button type="submit" class="btn-yellow px-4 py-2">
                                                    Submit
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Rewiu -->

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
                                                <div class="my-appointments-person__info-specialist">
                                                   @foreach($SpecialitiesComplete[$keyInComplete] as $ValSpecialitiesComplete)
                                                       {{$ValSpecialitiesComplete->title}}
                                                   @endforeach
                                                </div>
                                                <div class="my-appointments-person__info-data">{{date('M-jS, Y  h:i A', strtotime($InCompleteVal->start)) }}</div>
                                            </div>
                                            <div class="person__info-rating qew">

                              <input type="hidden" class="meeting_id" value="{{$InCompleteVal->id}}">
                              <input type="hidden" class="practitioner_id" value="{{$InCompleteVal->practitioner_id}}">
                                 @if(isset($ReviewRate[$keyInComplete]->rate))
                                    <span class="gl-star-rating gl-star-rating--ltr " data-star-rating="">
                                       <select class="star-rating">
                                       @for($ReviewRate[$keyInComplete]->rate; $ReviewRate[$keyInComplete]->rate >=1 ; $ReviewRate[$keyInComplete]->rate--)
                                               <option value="{{$ReviewRate[$keyInComplete]->rate}}">{{$ReviewRate[$keyInComplete]->rate}}.0</option>
                                           @endfor
                                       </select>
                                       <span class="gl-star-rating--stars s{{$ReviewRate[$keyInComplete]->rate}}0" role="tooltip" aria-label="{{$ReviewRate[$keyInComplete]->rate}}">
                                             @for($r = 1; $r <= $ReviewRate[$keyInComplete]->rate; $r++)
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
                                        @if(!isset($ReviewRate[$keyInComplete]->rate))
                                        <button type="button" class="btn-light-blue px-3 mx-auto" data-toggle="modal" data-target="#LeaveReview{{$InCompleteVal->id}}">
                                            Leave Review
                                        </button>
                                        @endif

                                        @if((count($CheckStatusProtocol)>0))
                                            <button
                                                class="my-appointments-person__complete-process-button procces-button btn bg-yellow mt-4">
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

            $('.starrr').click(function(){
             // alert($(this).val());
             $('.add_rate').val($(this).val())
            });

            $('input[type="radio"],input[type="checkbox"],#state').on('change', function () {
                $(this).closest("form").submit();
            });
            $('.find__form-settings').click(function () {
                $(".filter__content").toggleClass("active")
            })
        });

    </script>
@endsection
