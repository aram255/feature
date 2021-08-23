<div class="modal fade" id="service-modal{{$PractitionerFavoriteVal->partit_id}}">
    <div class="modal-dialog mx-auto " style="max-width: max-content; width: 100%">
        <div class="modal-content">

            <button type="button" class="close ml-auto pt-4 pr-4" data-dismiss="modal">&times;</button>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="service pb-5 container">

                    <?php
                    $count =  count($Service->where('practitioner_id',$PractitionerFavoriteVal->partit_id));

                    if(!empty(count($Service->where('practitioner_id',$PractitionerFavoriteVal->partit_id))))
                    {
                        echo   '<h2 class="text-center" >My Services</h2>
                            <h4 class="text-uppercase text-center" >ONE ON ONE PROGRAMS</h4>';
                    }
                    else{
                        echo '<h2 class="text-center" >No services yet</h2>';
                    }

                    ?>

                    <div class="col-lg-12">
                        <div class="">

                            <!-- 1 -->

                            <div class="profile-practitioner__consultation-carusel-block">
                                <div id="customer-testimonals1" class="service_carousel owl-carousel owl-theme owl-loaded owl-drag ">
                                    @foreach($Service->where('practitioner_id',$PractitionerFavoriteVal->partit_id) as $Value)
                                        @php
                                            $array = array("item light-green","item light-yellow");
                                            $k = array_rand($array);
                                            $color = $array[$k];
                                        @endphp
                                        <div class="@php  echo $color; @endphp flex-1 mx-1" >
                                            <div class="d-flex flex-column align-items-center">
                                                <h4  class="mb-3">{{$Value->title}}</h4>

                                                <div class="d-flex flex-column mx-auto align-items-center mb-3 italic-text">
                                                    @foreach($ServiceSession as $valS)
                                                        @foreach($valS->where('services_id',$Value->id) as $valSS)
                                                            @if($valSS->services_id == $Value->id)
                                                                <span>{{$valSS->sessions}}</span>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="price d-flex flex-column align-items-center mb-3">
                                                <div class="d-flex">
                                                    <span class="">$</span> <span >{{ $Value->price }}</span>
                                                </div>
                                                <small>USD plus HST</small>
                                            </div>
                                            <ul class="list-unstyled px-5 overflow-auto">
                                                @foreach($ServiceDescription as $valD)
                                                    @foreach($valD->where('services_id',$Value->id) as $valDD)
                                                        @if($valDD->services_id == $Value->id)
                                                            <li style="margin-bottom: 4px !important;"><i class="fas fa-angle-right mr-2"  ></i> <span>{{$valDD->description}}</span></li>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </ul>

{{--                                            <input type="hidden" name="join_url" value="{{$PractitionerFavoriteVal->join_url}}">--}}
{{--                                            <input type="hidden" name="password" value="{{$PractitionerFavoriteVal->password}}">--}}
{{--                                            <input type="hidden" name="duration" value="{{$PractitionerFavoriteVal->duration}}">--}}
                                            <input type="hidden" name="service_id" value="{{$Value->id}}">
                                            <input type="hidden" name="email" value="{{$PractitionerFavoriteVal->email}}">
                                            <input type="hidden" name="first_name" value="{{$PractitionerFavoriteVal->first_name}}">
                                            <input type="hidden" name="last_name" value="{{$PractitionerFavoriteVal->last_name}}">
                                            <input type="hidden" name="phone_number" value="{{$PractitionerFavoriteVal->phone_number}}">
                                            <input type="hidden" name="practitioner_id" value="{{$PractitionerFavoriteVal->partit_id}}">
{{--                                            @if($PractitionerFavoriteVal->service_id != $Value->id)--}}
                                                <button class="bg-yellow br-10 px-4 py-2 mt-4 fs-16 view-more detail-btn" data-toggle="modal" @if(isset(Auth::user()->id))data-target="#myModal" @else data-target="#loginn" @endif" data-id="{{ $PractitionerFavoriteVal->partit_id }}" >Book</button>
{{--                                            @else--}}
{{--                                                <button class="bg-yellow br-10 px-4 py-2 mt-4 fs-16 view-more detail-btn" data-toggle="modal" @if(isset(Auth::user()->id))data-target="#myModal" @else data-target="#loginn" @endif" data-id="{{ $PractitionerFavoriteVal->partit_id }}">Service Reserved</button>--}}
{{--                                            @endif--}}
                                        </div>


                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
