@section('style header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
          crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('web_sayt/css/owl-carousel-min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/star-rating.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/css/main.css') }}">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('web_sayt/maps/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('web_sayt/css/service.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/css/responsive.css') }}">
    <style>
        .create__checkbox input.lg-sg__checkin + label::before {
            border: solid 1px #8BA9EE;
            background: white;
            border-radius: 3px;
        }
    </style>
    <script src="{{ asset('web_sayt/maps/index.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title', __('site.Home') )

@extends('app.layouts.app_home')


@section('content')
    <script>var body = document.body; body.classList.add("body");</script>

    <section>

        <div class="filter-area" style="display: flex;justify-content: space-between; width: 100%;">
            <div class="filter__content p-5">
                <div class="filter__header d-flex flex-row-reverse justify-content-between w-100">
                    <div class="find__form-settings">
                        <button class="settings-button ml-3" data-toggle="modal" data-target="#find__filter"><i
                                class="fas fa-sliders-h"></i></button>
                    </div>
                    <p class="filter__title">Filters</p>
                </div>
                <form id="filter-form" method="POST" action="{{route('search',[app()->getLocale()])}}">
                    @csrf
                    <div class="create__checkbox">
                        <p>Mode of delivery</p>

                        <input  type="checkbox" name="vir" value="virtual" id="virtual1" class="lg-sg__checkin delivery" @if(!empty($Virtual)) @if($Virtual == 'virtual') checked="checked"  @endif @endif /><label
                            for="virtual1">Virtual</label>
                        <input  type="checkbox" name="per" value="in_persion" id="person1" class="lg-sg__checkin delivery" @if(!empty($Person)) @if($Person == 'in_persion') checked="checked"  @endif @endif  /><label for="person1">
                            In Person</label>

                    </div>
                    <div class="user-info">
                        <p class="create-p">Language</p>
                        <select class="fadeIn" name="state" id="state">
                            <option value="">Select Language</option>
                            @foreach($Languages as $lang)
                                <option value="{{ $lang->id }}"  @if(!empty($Lang)) @if($Lang == $lang->id) selected="selected"  @endif @endif >{{ $lang->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="create__checkbox">
                        <p>Preferred Practitioner Gender</p>
                        <input  type="radio" name="gender" id="male" value="Male" class="lg-sg__checkin"  @if(!empty($Gender)) @if($Gender == 'Male') checked="checked"  @endif @endif  />
                        <label for="male" class="ml-2">Male</label>
                        <input  type="radio" name="gender"  id="female" value="Famale" class="lg-sg__checkin" @if(!empty($Gender)) @if($Gender == 'Famale') checked="checked"  @endif @endif />
                        <label for="female" class="ml-2">Female</label>
                    </div>
                    <div class="create__checkbox">
                        <p>Avalible appointments this week</p>

                        <input type="radio" name="yesNo" value="Yes" id="yes" class="lg-sg__checkin">
                        <label for="yes" class="ml-2">Yes</label>
                        <input type="radio" name="yesNo" value="No"  id="no" class="lg-sg__checkin">
                        <label for="no" class="ml-2">No</label>

{{--                    @foreach($TegManagements as $key=>$TegManagement)--}}
{{--                            <input  type="checkbox" name="teg_management[{{$TegManagement->id}}]" @if(!empty($Tag)) @if(in_array($TegManagement->id, $Tag)) checked="checked"  @endif @endif value="{{$TegManagement->id}}" class="lg-sg__checkin">--}}
{{--                            <label for="remember">{{$TegManagement->name}}</label>--}}
{{--                    @endforeach--}}
                </form>
            </div>
            {{-- Reset fild--}}
            <form  method="post" action="{{route('search',[app()->getLocale()])}}">
                @csrf
                <button type="submit" class="btn btn-warning" style="color: #212529;background-color: #FED638">Reset All Fields</button>
            </form><br>
        </div>


        <div class="container-filter mt-5 mt-md-0 pt-5 pt-md-0" style="display: flex;flex-direction: column;justify-content: space-around;">
            <!-- content -->


            @foreach($Practitioners as $Result)

                <div class="find-result mt-4">

                    <div class="person">
                        <div class="person__info">
                            <div class="person__info-cont1">
                                <img class="person__info-img" src="{{ asset('web_sayt/img/person-foto.png') }}" alt="">
                                <div class="person__info-rating">
                        <span class="gl-star-rating gl-star-rating--ltr" data-star-rating="">
                            <select class="star-rating">
                              <option value="5">5.0</option>
                              <option value="4">4.0</option>
                              <option value="3">3.0</option>
                              <option value="2">2.0</option>
                              <option value="1">1.0</option>
                           </select>
                            <span class="gl-star-rating--stars s50" role="tooltip" aria-label="5.0">
                                <span data-index="0" data-value="1" class="gl-active"></span>
                                <span data-index="1" data-value="2" class="gl-active"></span>
                                <span data-index="2" data-value="3" class="gl-active"></span>
                                <span data-index="3" data-value="4" class="gl-active"></span>
                                <span data-index="4" data-value="5" class="gl-active gl-selected"></span>
                            </span>
                        </span>
                                </div>
                                <p class="perion__info-session">256<span> Sessions</span></p>
                                <a href="" class="btn bg-yellow" data-toggle="modal" data-target="#service-modal{{$Result->id}}">View Services</a>
                            </div>
                            <div class="person__info-cont2">
                                <div class="person__info-name"><a href="{{route('profile-view-customer',[app()->getLocale()])}}">{{$Result->first_name}} {{$Result->last_name}}</a></div>
                                <div class="person__info-specialist">Acne Specialist &amp; Holistic nutritionist (CNP)</div>
                                <div class="person__info-skin">
                                    @foreach($Result->tags as $Tag)
                                        <span class="person__info-skin-tag">{{ $Tag->name }}</span>
                                    @endforeach
                                </div>

                            </div>
                            <div class="person__info-heart"></div>
                        </div>
                        <div class="person__content">
                            <ul class="person__content-nav">
                                <li class="borderbg"><a class="person__content-nav-category active">Video</a></li>
                                <li class="borderbg"><a class="person__content-nav-category">Intro</a></li>
                                <li class="borderbg"><a class="person__content-nav-category">Calendar</a></li>
                                                            <li class="borderbg"><a class="person__content-nav-category">Map</a></li>
                            </ul>

                            <div class="person__content-video">
                                <div class="video_wrapper video_wrapper_full js-videoWrapper">
                                    <iframe class="videoIframe js-videoIframe" src="" frameborder="0" allowtransparency="true"
                                            allowfullscreen="" data-src="{{ asset('web_sayt/img/video.mp4') }}"></iframe>
                                    <button class="videoPoster js-videoPoster"></button>
                                </div>
                            </div>
                            <div class="person__content-intro ds-none">
                                <form method="post" action="{{route('add-zoom-meeting',[app()->getLocale()])}}">
                                    {{csrf_field()}}

                                    <input type="hidden" name="email" value="{{$Result->email}}">
                                    <input type="hidden" name="first_name" value="{{$Result->first_name}}">
                                    <input type="hidden" name="last_name" value="{{$Result->last_name}}">
                                    <input type="hidden" name="phone_number" value="{{$Result->phone_number}}">
                                    <input type="hidden" name="practitioner_id" value="{{$Result->id}}">

                                    <input type="text" name="m_name" placeholder="Meeting Name">
                                    <input type="text" name="password" placeholder="Password"><br>
                                    <input type="datetime-local" id="birthdaytime" name="birthdaytime">
                                    <input type="number" name="time" placeholder="Duration"><br>
                                    {{--                                <input type="number" name="type" placeholder="Type"><br>--}}

                                    <input type="submit">
                                </form>
                                {{--                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been--}}
                                {{--                                the industry's--}}
                                {{--                                standard--}}
                                {{--                                dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it--}}
                                {{--                                to.</p>--}}
                            </div>
                            <div class="person__content-calendar ds-none">
                                <div class="container-calendar">
                                    <h3 id="monthAndYear">March</h3>
                                    <table class="table-calendar" id="calendar" data-lang="en">
                                        <thead id="thead-month">
                                        <tr>
                                            <th data-days="S">S</th>
                                            <th data-days="M">M</th>
                                            <th data-days="T">T</th>
                                            <th data-days="W">W</th>
                                            <th data-days="T">T</th>
                                            <th data-days="F">F</th>
                                            <th data-days="S">S</th>
                                        </tr>
                                        </thead>
                                        <tbody id="calendar-body">
                                        <tr>
                                            <td></td>
                                            <td data-date="1" data-month="3" data-year="2021" data-month_name="March"
                                                class="date-picker"><span>1</span></td>
                                            <td data-date="2" data-month="3" data-year="2021" data-month_name="March"
                                                class="date-picker"><span>2</span></td>
                                            <td data-date="3" data-month="3" data-year="2021" data-month_name="March"
                                                class="date-picker"><span>3</span></td>
                                            <td data-date="4" data-month="3" data-year="2021" data-month_name="March"
                                                class="date-picker"><span>4</span></td>
                                            <td data-date="5" data-month="3" data-year="2021" data-month_name="March"
                                                class="date-picker"><span>5</span></td>
                                            <td data-date="6" data-month="3" data-year="2021" data-month_name="March"
                                                class="date-picker"><span>6</span></td>
                                        </tr>
                                        <tr>
                                            <td data-date="7" data-month="3" data-year="2021" data-month_name="March"
                                                class="date-picker"><span>7</span></td>
                                            <td data-date="8" data-month="3" data-year="2021" data-month_name="March"
                                                class="date-picker"><span>8</span></td>
                                            <td data-date="9" data-month="3" data-year="2021" data-month_name="March"
                                                class="date-picker"><span>9</span></td>
                                            <td data-date="10" data-month="3" data-year="2021" data-month_name="March"
                                                class="date-picker"><span>10</span></td>
                                            <td data-date="11" data-month="3" data-year="2021" data-month_name="March"
                                                class="date-picker"><span>11</span></td>
                                            <td data-date="12" data-month="3" data-year="2021" data-month_name="March"
                                                class="date-picker"><span>12</span></td>
                                            <td data-date="13" data-month="3" data-year="2021" data-month_name="March"
                                                class="date-picker"><span>13</span></td>
                                        </tr>
                                        <tr>
                                            <td data-date="14" data-month="3" data-year="2021" data-month_name="March"
                                                class="date-picker"><span>14</span></td>
                                            <td data-date="15" data-month="3" data-year="2021" data-month_name="March"
                                                class="date-picker"><span>15</span></td>
                                            <td data-date="16" data-month="3" data-year="2021" data-month_name="March"
                                                class="date-picker"><span>16</span></td>
                                            <td data-date="17" data-month="3" data-year="2021" data-month_name="March"
                                                class="date-picker"><span>17</span></td>
                                            <td data-date="18" data-month="3" data-year="2021" data-month_name="March"
                                                class="date-picker"><span>18</span></td>
                                            <td data-date="19" data-month="3" data-year="2021" data-month_name="March"
                                                class="date-picker"><span>19</span></td>
                                            <td data-date="20" data-month="3" data-year="2021" data-month_name="March"
                                                class="date-picker"><span>20</span></td>
                                        </tr>
                                        <tr>
                                            <td data-date="21" data-month="3" data-year="2021" data-month_name="March"
                                                class="date-picker"><span>21</span></td>
                                            <td data-date="22" data-month="3" data-year="2021" data-month_name="March"
                                                class="date-picker"><span>22</span></td>
                                            <td data-date="23" data-month="3" data-year="2021" data-month_name="March"
                                                class="date-picker"><span>23</span></td>
                                            <td data-date="24" data-month="3" data-year="2021" data-month_name="March"
                                                class="date-picker selected"><span>24</span></td>
                                            <td data-date="25" data-month="3" data-year="2021" data-month_name="March"
                                                class="date-picker"><span>25</span></td>
                                            <td data-date="26" data-month="3" data-year="2021" data-month_name="March"
                                                class="date-picker"><span>26</span></td>
                                            <td data-date="27" data-month="3" data-year="2021" data-month_name="March"
                                                class="date-picker"><span>27</span></td>
                                        </tr>
                                        <tr>
                                            <td data-date="28" data-month="3" data-year="2021" data-month_name="March"
                                                class="date-picker"><span>28</span></td>
                                            <td data-date="29" data-month="3" data-year="2021" data-month_name="March"
                                                class="date-picker"><span>29</span></td>
                                            <td data-date="30" data-month="3" data-year="2021" data-month_name="March"
                                                class="date-picker"><span>30</span></td>
                                            <td data-date="31" data-month="3" data-year="2021" data-month_name="March"
                                                class="date-picker"><span>31</span></td>
                                        </tr>
                                        <tr></tr>
                                        </tbody>
                                    </table>

                                    <div class="button-container-calendar">
                                        <button id="previous" onclick="previous()">⟵</button>
                                        <button id="next" onclick="next()">⟶</button>
                                    </div>
                                    <div class="footer-container-calendar" style="display: none;">
                                        <label for="month">Jump To: </label>
                                        <select id="month" onchange="jump()">
                                            <option value="0">Jan</option>
                                            <option value="1">Feb</option>
                                            <option value="2">Mar</option>
                                            <option value="3">Apr</option>
                                            <option value="4">May</option>
                                            <option value="5">Jun</option>
                                            <option value="6">Jul</option>
                                            <option value="7">Aug</option>
                                            <option value="8">Sep</option>
                                            <option value="9">Oct</option>
                                            <option value="10">Nov</option>
                                            <option value="11">Dec</option>
                                        </select>
                                        <select id="year" onchange="jump()">
                                            <option value="1970">1970</option>
                                            <option value="1971">1971</option>
                                            <option value="1972">1972</option>
                                            <option value="1973">1973</option>
                                            <option value="1974">1974</option>
                                            <option value="1975">1975</option>
                                            <option value="1976">1976</option>
                                            <option value="1977">1977</option>
                                            <option value="1978">1978</option>
                                            <option value="1979">1979</option>
                                            <option value="1980">1980</option>
                                            <option value="1981">1981</option>
                                            <option value="1982">1982</option>
                                            <option value="1983">1983</option>
                                            <option value="1984">1984</option>
                                            <option value="1985">1985</option>
                                            <option value="1986">1986</option>
                                            <option value="1987">1987</option>
                                            <option value="1988">1988</option>
                                            <option value="1989">1989</option>
                                            <option value="1990">1990</option>
                                            <option value="1991">1991</option>
                                            <option value="1992">1992</option>
                                            <option value="1993">1993</option>
                                            <option value="1994">1994</option>
                                            <option value="1995">1995</option>
                                            <option value="1996">1996</option>
                                            <option value="1997">1997</option>
                                            <option value="1998">1998</option>
                                            <option value="1999">1999</option>
                                            <option value="2000">2000</option>
                                            <option value="2001">2001</option>
                                            <option value="2002">2002</option>
                                            <option value="2003">2003</option>
                                            <option value="2004">2004</option>
                                            <option value="2005">2005</option>
                                            <option value="2006">2006</option>
                                            <option value="2007">2007</option>
                                            <option value="2008">2008</option>
                                            <option value="2009">2009</option>
                                            <option value="2010">2010</option>
                                            <option value="2011">2011</option>
                                            <option value="2012">2012</option>
                                            <option value="2013">2013</option>
                                            <option value="2014">2014</option>
                                            <option value="2015">2015</option>
                                            <option value="2016">2016</option>
                                            <option value="2017">2017</option>
                                            <option value="2018">2018</option>
                                            <option value="2019">2019</option>
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                            <option value="2030">2030</option>
                                            <option value="2031">2031</option>
                                            <option value="2032">2032</option>
                                            <option value="2033">2033</option>
                                            <option value="2034">2034</option>
                                            <option value="2035">2035</option>
                                            <option value="2036">2036</option>
                                            <option value="2037">2037</option>
                                            <option value="2038">2038</option>
                                            <option value="2039">2039</option>
                                            <option value="2040">2040</option>
                                            <option value="2041">2041</option>
                                            <option value="2042">2042</option>
                                            <option value="2043">2043</option>
                                            <option value="2044">2044</option>
                                            <option value="2045">2045</option>
                                            <option value="2046">2046</option>
                                            <option value="2047">2047</option>
                                            <option value="2048">2048</option>
                                            <option value="2049">2049</option>
                                            <option value="2050">2050</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{--                        Map--}}
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


            @endforeach
        <!-- content -->
            @if(!empty($Result))

                <div class="pagination-filter mt-5" >
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="{{ url()->current().$Practitioners->previousPageUrl() }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>

                            <li class="page-item"><a class="page-link" href="{{ url()->current().'?page='.$Practitioners->hasPages() }}">{{ $Practitioners->hasPages() }}</a></li>

                            <li class="page-item"><a class="page-link" href="{{ url()->current().'?page='.$Practitioners->currentPage() }}">{{ $Practitioners->currentPage() }}</a></li>

                            <li class="page-item"><a class="page-link" href="{{ url()->current().'?page='.$Practitioners->lastPage() }}">{{ $Practitioners->lastPage() }}</a></li>

                            <li class="page-item">
                                <a class="page-link" href="{{ url()->current().$Practitioners->nextPageUrl() }}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            @endif
        </div>
    </section>

    // Service Modal
    @foreach($Practitioners as $Result)
    <!-- The Modal service -->
    <div class="modal fade" id="service-modal{{$Result->id}}">
        <div class="modal-dialog mx-auto " style="max-width: max-content; width: 100%">
            <div class="modal-content">

                <button type="button" class="close ml-auto pt-4 pr-4" data-dismiss="modal">&times;</button>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="service py-5 container">

                        <?php
                         $count =  count($Service->where('practitioner_id',$Result->id));

                        if(!empty(count($Service->where('practitioner_id',$Result->id))))
                        {
                            echo   '<h2 class="text-center" >My Services</h2>
                            <h4 class="text-uppercase text-center" >ONE ON ONE PROGRAMS</h4>';
                        }else{
                            echo '<h2 class="text-center" >No services yet</h2>';
                        }
                        ?>

                        <div class="col-lg-12">
                            <div class="">

                                <!-- 1 -->

                                <div class="profile-practitioner__consultation-carusel-block">
                                    <div id="customer-testimonals1" class="owl-carousel owl-theme owl-loaded owl-drag ">
                                        @foreach($Service->where('practitioner_id',$Result->id) as $Value)
                                            @php
                                                $array = array("item light-green","item light-yellow");
                                                $k = array_rand($array);
                                                $color = $array[$k];
                                            @endphp
                                            <div class="@php echo $color; @endphp flex-1 mx-1" >
                                                <div class="d-flex flex-column align-items-center">
                                                    <h4  class="mb-3">{{ $Value->title }}</h4>

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
                                                        <span class="">$</span> <span >{{$Value->price}}</span>
                                                    </div>
                                                    <small>USD plus HST</small>
                                                </div>
                                                <ul class="list-unstyled px-5 overflow-auto">
                                                    @foreach($ServiceDescription as $valD)
                                                        @foreach($valD->where('services_id',$Value->id) as $valDD)
                                                            @if($valDD->services_id == $Value->id)
                                                                <li><i class="fas fa-angle-right mr-2" ></i> <span>{{$valDD->description}}</span></li>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </ul>
                                                <button class="bg-yellow br-10 px-4 py-2 mt-4 fs-16 view-more">Book</button>
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
    @endforeach

@endsection

@section('style')
    <script type="text/javascript" src="{{ asset('web_sayt/js/jquery.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('input[type="radio"],input[type="checkbox"],#state').on('change', function () {
                $(this).closest("form").submit();
            });
            $('.find__form-settings').click(function () {
                $(".filter__content").toggleClass("active")
            })
        });



        // $(document).ready(function() {
        //     $('input[type="checkbox"]').click(function() {
        //         var formData = $('#filter-form').serialize();
        //
        //
        //         $.ajax({
        //             url: '/en/ok',
        //             data: formData,
        //             type: 'post',
        //             dataType: 'json',
        //             success: function(data) {
        //                 console.log(data);
        //                 //alert('dcdc');
        //                 //$(this).closest("form").submit();
        //             }
        //         });
        //     });
        // });
    </script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('web_sayt/js/star-rating.js') }}"></script>
    <script src="{{ asset('web_sayt/js/star-run.js') }}"></script>
    <script src="{{ asset('web_sayt/js/filter.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('web_sayt/js/carusel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/script.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/readMoreJS.min.js') }}"></script>
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtOVd66AerMgd0A-mwKEFqdBQTrKGfngc&callback=initMap&libraries=places&v=weekly"
        async
    ></script>
@endsection
