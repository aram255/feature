<div class="find-result mt-4">
    <div class="person">
        <div class="person__info">
            <div class="person__info-cont1">
                <img class="person__info-img" style="width: 150px;" src="{{ asset('web_sayt/img_practitioners/'.$Result->img) }}" alt="">
                @php $rt = floor($Rate[$k]);  @endphp
                @if(isset($rt) and $rt>0)
                <div class="person__info-rating">

                        <span class="gl-star-rating gl-star-rating--ltr" data-star-rating="">
                            <select class="star-rating">
                                @for($rt; $rt >=1 ; $rt--)
                                    <option value="{{$rt}}">{{$rt}}.0</option>
                                @endfor
                           </select>
                            <span class="gl-star-rating--stars s{{$rt}}0" role="tooltip" aria-label="{{$rt}}.0">
                               @for($r = 1; $r <= $rt; $r++)
                                    <span  data-value="{{$r}}" class="gl-selected"></span>
                               @endfor
                            </span>
                        </span>
                </div>
                @endif
                <p class="perion__info-session">{{$SessionCount[$k]}}<span> Sessions</span></p>
                <a href="" class="btn bg-yellow" data-toggle="modal" data-target="#service-modal{{$Result->id}}">Book</a>
            </div>
            <div class="person__info-cont2">
                <div class="person__info-name"><a href="{{route('profile-view-customer',[app()->getLocale(),$Result->id])}}">{{$Result->first_name}} {{$Result->last_name}}</a></div>
                <div class="person__info-specialist">

                    @foreach($SpecialitiesPractitioner[$k] as $ValSpecialitiesPractitioner)
                        {{$ValSpecialitiesPractitioner->title}}
                    @endforeach
                </div>
                {{--                                <div class="person__info-skin">--}}
                {{--                                    @foreach($Result->tags as $Tag)--}}
                {{--                                        <span class="person__info-skin-tag">{{ $Tag->name }}</span>--}}
                {{--                                    @endforeach--}}
                {{--                                </div>--}}

            </div>
            @if(count($Favorite->where('practitioner_id',$Result->id))>0)
                <div class="person__info-heart favorit active" id="{{$Result->id}}"></div>
            @else
                <div class="person__info-heart favorit" id="{{$Result->id}}"></div>
            @endif
        </div>

        <div class="person__content">
            <ul class="person__content-nav">
                <li class="borderbg"><a class="person__content-nav-category active">Video</a></li>
                <li class="borderbg"><a class="person__content-nav-category">Intro</a></li>
                <li class="borderbg"><a class="person__content-nav-category">Map</a></li>
                {{--                                                <li class="borderbg"><a class="person__content-nav-category">Calendar</a></li>--}}
            </ul>

            <div class="person__content-video">
                <div class="video_wrapper video_wrapper_full js-videoWrapper">
                    <iframe class="videoIframe js-videoIframe" src="" frameborder="0" allowtransparency="true"
                            allowfullscreen="" data-src="{{ asset('web_sayt/video_practitioners/'.$Result->video) }}"></iframe>
                    <button class="videoPoster js-videoPoster"></button>
                </div>
            </div>
            <div class="person__content-intro ds-none">
                {{$Result->description}}
{{--                <form method="post" action="{{route('add-zoom-meeting',[app()->getLocale()])}}">--}}
{{--                    {{csrf_field()}}--}}


                    <input type="hidden" name="email" value="{{$Result->email}}">
                    <input type="hidden" name="first_name" value="{{$Result->first_name}}">
                    <input type="hidden" name="last_name" value="{{$Result->last_name}}">
                    <input type="hidden" name="phone_number" value="{{$Result->phone_number}}">
                    <input type="hidden" name="practitioner_id" value="{{$Result->id}}">

{{--                    <input type="text" name="m_name" placeholder="Meeting Name">--}}
{{--                    <input type="text" name="password" placeholder="Password"><br>--}}
{{--                    <input type="datetime-local" id="birthdaytime" name="birthdaytime">--}}
{{--                    <input type="number" name="time" placeholder="Duration"><br>--}}
{{--                    --}}{{--                                <input type="number" name="type" placeholder="Type"><br>--}}

{{--                    <input type="submit">--}}
                </form>
                {{--                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been--}}
                {{--                                the industry's--}}
                {{--                                standard--}}
                {{--                                dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it--}}
                {{--                                to.</p>--}}
            </div>
            <div class="person__content-maps ds-none">
                <form method="post" style="position: relative" action="{{route('add-zoom-meeting',[app()->getLocale()])}}">
                    {{csrf_field()}}

                    <div class="pac-card map-pac-card"  >
                        <div id="pac-container">
                            <input id="pac-input" type="text" placeholder="Enter a location" />
                        </div>
                        <div>
                            <div id="title" style="display: none">Autocomplete search</div>
                            <div style="display: none;" id="type-selector" class="pac-controls">
                                <input style="display: none;"
                                       type="radio"
                                       name="type"
                                       id="changetype-all"
                                       checked="checked"
                                />
                                <label for="changetype-all">All</label>


                            </div>
                            <br />

                        </div>

                    </div>
                    <div id="map"></div>
                    <div id="infowindow-content">
                        <span id="place-name" class="title"></span><br />
                        <span id="place-address"></span>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
