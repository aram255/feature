@section('style header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/owl-carousel-min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/star-rating.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('web_sayt/css/service.css') }}">
@endsection

@section('title', __('site.Home') )

@extends('app.layouts.app_home')


@section('content')
    <script>var body = document.body; body.classList.add("body");</script>

{{--    <h2>Added Teg List</h2><br>--}}

{{--    <form method="post" action="{{route('add-tag-my-list-management',[app()->getLocale()])}}">--}}
{{--        @csrf--}}

{{--            @foreach($TagManagements as $index => $TagManagement)--}}

{{--                    @if($TagManagement->published == 1)--}}
{{--                        <input type="checkbox" name="teg_management[{{$index}}]" value="{{$TagManagement->id}}">--}}
{{--                    @endif--}}
{{--                <span @if($TagManagement->published == 0)style="color: red;" @endif>{{$TagManagement->name}}</span><br>--}}

{{--            @endforeach--}}
{{--            <input type="submit" value="Add Teg To my list">--}}


{{--    </form> <br>--}}
{{--    <section>--}}


{{--        <div class="form-group">--}}
{{--            <form method="post" action="{{route('add-tag-management',[app()->getLocale()])}}">--}}
{{--                @csrf--}}
{{--            <p>Add Tag</p>--}}
{{--            <input style="border: 1px solid black" type="text" name="add_teg">--}}
{{--            <button type="submit" class="btn btn-gradient-primary mr-2" style="background-color: #28a745; color: white;">Add</button>--}}
{{--            </form><br>--}}

{{--            <h1>Delete</h1>--}}
{{--            <form method="post" action="{{route('delete-tag-management',[app()->getLocale()])}}">--}}
{{--                @csrf--}}
{{--                                <p>Add Tag</p>--}}

{{--                @foreach($MyTagManagements as $ind => $GetTagManagements)--}}
{{--                    <input style="border: 1px solid black" type="checkbox" value="{{$GetTagManagements->teg_managements_id}}" name="teg_management[{{$ind}}]">{{$GetTagManagements->name}}<br>--}}
{{--                @endforeach<br>--}}
{{--                <button type="submit" class="btn btn-gradient-primary mr-2" style="background-color: #28a745; color: white;">Delete</button>--}}
{{--            </form>--}}
{{--        </div><br>--}}







{{--        <div class="container">--}}
{{--            <div class="profile-practitioner">--}}
{{--                <div class="profile-practitioner__user nl">--}}
{{--                    <div class="person__info">--}}
{{--                        <div class="person__info-cont1">--}}
{{--                            <img class="person__info-img" src="@if(session()->get('UserImg')){{asset('web_sayt/img/'.session()->get('UserImg'))}}@else{{asset('web_sayt/img/person-foto.png')}}@endif" alt="">--}}
{{--                            <div class="person__info-name">--}}
{{--                                <span class="profile-practitioner-name">{{session()->get('UserName')}}  {{session()->get('UserLastName')}}</span>--}}
{{--                                <span class="edit-pen"><a href="{{route('edit-profile-practitioner',[app()->getLocale()])}}"><img src="{{ asset('web_sayt/img/edit-pen.svg') }}" alt=""></a></span>--}}


{{--                            </div>--}}
{{--                            <div class="person__info-specialist">Acne Specialist &amp; Holistic nutritionist (CNP)</div>--}}
{{--                            <div class="person__info-skin">--}}
{{--                                @foreach($MyTagManagements as $GetTagManagements)--}}
{{--                                <span class="person__info-skin-tag">{{$GetTagManagements->name}}</span>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                            <div class="person__info-my">--}}
{{--                                <p><a href="{{route('my-appointments-practitioners',[app()->getLocale()])}}">My Appointments</a></p>--}}
{{--                                <p>My Protocols</p>--}}
{{--                                <p><a href="{{route('type-form-practitioner',[app()->getLocale()])}}">My Intake Forms</a></p>--}}
{{--                                <p><a target="_blank" href="https://typeform.com/">Create Intake Forms</a></p>--}}

{{--                            </div>--}}
{{--                            <div class="person__info-rating qew">--}}
{{--                        <span class="gl-star-rating gl-star-rating--ltr " data-star-rating="">--}}
{{--                           <select class="star-rating">--}}

{{--                              <option value="5">5.0</option>--}}
{{--                              <option value="4">4.0</option>--}}
{{--                              <option value="3">3.0</option>--}}
{{--                              <option value="2">2.0</option>--}}
{{--                              <option value="1">1.0</option>--}}
{{--                           </select>--}}
{{--                           <span class="gl-star-rating--stars s50" role="tooltip" aria-label="5.0">--}}
{{--                              <span data-index="0" data-value="1" class="" style="font-size: -28px;"></span>--}}
{{--                              <span data-index="1" data-value="2" class=""></span>--}}
{{--                              <span data-index="2" data-value="3" class=""></span>--}}
{{--                              <span data-index="3" data-value="4" class=""></span>--}}
{{--                              <span data-index="4" data-value="5" class="gl-selected gl-active"></span>--}}
{{--                           </span>--}}
{{--                        </span>--}}
{{--                            </div>--}}
{{--                            <p class="perion__info-session">256<span> Sessions</span></p>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                    <div class="profile__reviews">--}}
{{--                        <p class="profile__reviews-title">REVIEWS</p>--}}
{{--                        <div class="profile__reviews-block">--}}
{{--                            <p class="profile__reviews-border"></p>--}}
{{--                            <div class="profile__reviews-person">--}}

{{--                                <img src="{{ asset('web_sayt/img/reviews-person.png') }}" alt="" srcset="">--}}
{{--                                <div class="profile__reviews-content">--}}
{{--                                    <div class="person__info-rating">--}}
{{--                              <span class="gl-star-rating gl-star-rating--ltr " data-star-rating="">--}}
{{--                                 <select class="star-rating">--}}

{{--                                    <option value="5"></option>--}}
{{--                                    <option value="4"></option>--}}
{{--                                    <option value="3"></option>--}}
{{--                                    <option value="2"></option>--}}
{{--                                    <option value="1"></option>--}}
{{--                                 </select>--}}
{{--                                 <span class="gl-star-rating--stars s50" role="tooltip" aria-label="">--}}
{{--                                    <span data-index="0" data-value="1" class="gl-active"--}}
{{--                                          style="font-size: -28px;"></span>--}}
{{--                                    <span data-index="1" data-value="2" class="gl-active"></span>--}}
{{--                                    <span data-index="2" data-value="3" class="gl-active"></span>--}}
{{--                                    <span data-index="3" data-value="4" class="gl-active"></span>--}}
{{--                                    <span data-index="4" data-value="5" class="gl-selected gl-active"></span>--}}
{{--                                 </span>--}}
{{--                              </span>--}}
{{--                                    </div>--}}

{{--                                    <div class="profile__reviews-content-clock">--}}
{{--                                        <img src="{{ asset('web_sayt/img/clock.svg') }}" alt="" srcset="">--}}
{{--                                        <span class="reviews-clock-data">January 02</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="reviews-cooment">--}}
{{--                                        Morbi commodo sagittis euismod. Donec non facilisis dolor, sed facilisis risus. Praesent--}}
{{--                                        vitae posuere ante.--}}
{{--                                        Donec--}}
{{--                                        risus--}}
{{--                                        dui, feugiat pretium--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="profile__reviews-block">--}}
{{--                            <p class="profile__reviews-border"></p>--}}
{{--                            <div class="profile__reviews-person">--}}

{{--                                <img src="{{ asset('web_sayt/img/reviews-person-second.png') }}" alt="" srcset="">--}}
{{--                                <div class="profile__reviews-content">--}}
{{--                                    <div class="person__info-rating">--}}
{{--                              <span class="gl-star-rating gl-star-rating--ltr " data-star-rating="">--}}
{{--                                 <select class="star-rating">--}}

{{--                                    <option value="5"></option>--}}
{{--                                    <option value="4"></option>--}}
{{--                                    <option value="3"></option>--}}
{{--                                    <option value="2"></option>--}}
{{--                                    <option value="1"></option>--}}
{{--                                 </select>--}}
{{--                                 <span class="gl-star-rating--stars s50" role="tooltip" aria-label="">--}}
{{--                                    <span data-index="0" data-value="1" class="gl-active"--}}
{{--                                          style="font-size: -28px;"></span>--}}
{{--                                    <span data-index="1" data-value="2" class="gl-active"></span>--}}
{{--                                    <span data-index="2" data-value="3" class="gl-active"></span>--}}
{{--                                    <span data-index="3" data-value="4" class="gl-active"></span>--}}
{{--                                    <span data-index="4" data-value="5" class="gl-selected gl-active"></span>--}}
{{--                                 </span>--}}
{{--                              </span>--}}
{{--                                    </div>--}}

{{--                                    <div class="profile__reviews-content-clock">--}}
{{--                                        <img src="{{ asset('web_sayt/img/clock.svg') }}" alt="" srcset="">--}}
{{--                                        <span class="reviews-clock-data">January 02</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="reviews-cooment">--}}
{{--                                        Morbi commodo sagittis euismod. Donec non facilisis dolor, sed facilisis risus. Praesent--}}
{{--                                        vitae posuere ante.--}}
{{--                                        Donec--}}
{{--                                        risus--}}
{{--                                        dui, feugiat pretium--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- Calendar -->--}}
{{--                <div class="person__content-calendar ds-none">--}}
{{--                    <div class="container-calendar">--}}
{{--                        <h3 id="monthAndYear">March</h3>--}}
{{--                        <table class="table-calendar" id="calendar" data-lang="en">--}}
{{--                            <thead id="thead-month">--}}
{{--                            <tr>--}}
{{--                                <th data-days="S">S</th>--}}
{{--                                <th data-days="M">M</th>--}}
{{--                                <th data-days="T">T</th>--}}
{{--                                <th data-days="W">W</th>--}}
{{--                                <th data-days="T">T</th>--}}
{{--                                <th data-days="F">F</th>--}}
{{--                                <th data-days="S">S</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody id="calendar-body">--}}
{{--                            <tr>--}}
{{--                                <td></td>--}}
{{--                                <td data-date="1" data-month="3" data-year="2021" data-month_name="March"--}}
{{--                                    class="date-picker"><span>1</span></td>--}}
{{--                                <td data-date="2" data-month="3" data-year="2021" data-month_name="March"--}}
{{--                                    class="date-picker"><span>2</span></td>--}}
{{--                                <td data-date="3" data-month="3" data-year="2021" data-month_name="March"--}}
{{--                                    class="date-picker"><span>3</span></td>--}}
{{--                                <td data-date="4" data-month="3" data-year="2021" data-month_name="March"--}}
{{--                                    class="date-picker"><span>4</span></td>--}}
{{--                                <td data-date="5" data-month="3" data-year="2021" data-month_name="March"--}}
{{--                                    class="date-picker"><span>5</span></td>--}}
{{--                                <td data-date="6" data-month="3" data-year="2021" data-month_name="March"--}}
{{--                                    class="date-picker"><span>6</span></td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td data-date="7" data-month="3" data-year="2021" data-month_name="March"--}}
{{--                                    class="date-picker"><span>7</span></td>--}}
{{--                                <td data-date="8" data-month="3" data-year="2021" data-month_name="March"--}}
{{--                                    class="date-picker"><span>8</span></td>--}}
{{--                                <td data-date="9" data-month="3" data-year="2021" data-month_name="March"--}}
{{--                                    class="date-picker"><span>9</span></td>--}}
{{--                                <td data-date="10" data-month="3" data-year="2021" data-month_name="March"--}}
{{--                                    class="date-picker"><span>10</span></td>--}}
{{--                                <td data-date="11" data-month="3" data-year="2021" data-month_name="March"--}}
{{--                                    class="date-picker"><span>11</span></td>--}}
{{--                                <td data-date="12" data-month="3" data-year="2021" data-month_name="March"--}}
{{--                                    class="date-picker"><span>12</span></td>--}}
{{--                                <td data-date="13" data-month="3" data-year="2021" data-month_name="March"--}}
{{--                                    class="date-picker"><span>13</span></td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td data-date="14" data-month="3" data-year="2021" data-month_name="March"--}}
{{--                                    class="date-picker"><span>14</span></td>--}}
{{--                                <td data-date="15" data-month="3" data-year="2021" data-month_name="March"--}}
{{--                                    class="date-picker"><span>15</span></td>--}}
{{--                                <td data-date="16" data-month="3" data-year="2021" data-month_name="March"--}}
{{--                                    class="date-picker"><span>16</span></td>--}}
{{--                                <td data-date="17" data-month="3" data-year="2021" data-month_name="March"--}}
{{--                                    class="date-picker"><span>17</span></td>--}}
{{--                                <td data-date="18" data-month="3" data-year="2021" data-month_name="March"--}}
{{--                                    class="date-picker"><span>18</span></td>--}}
{{--                                <td data-date="19" data-month="3" data-year="2021" data-month_name="March"--}}
{{--                                    class="date-picker"><span>19</span></td>--}}
{{--                                <td data-date="20" data-month="3" data-year="2021" data-month_name="March"--}}
{{--                                    class="date-picker"><span>20</span></td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td data-date="21" data-month="3" data-year="2021" data-month_name="March"--}}
{{--                                    class="date-picker"><span>21</span></td>--}}
{{--                                <td data-date="22" data-month="3" data-year="2021" data-month_name="March"--}}
{{--                                    class="date-picker"><span>22</span></td>--}}
{{--                                <td data-date="23" data-month="3" data-year="2021" data-month_name="March"--}}
{{--                                    class="date-picker"><span>23</span></td>--}}
{{--                                <td data-date="24" data-month="3" data-year="2021" data-month_name="March"--}}
{{--                                    class="date-picker selected"><span>24</span></td>--}}
{{--                                <td data-date="25" data-month="3" data-year="2021" data-month_name="March"--}}
{{--                                    class="date-picker"><span>25</span></td>--}}
{{--                                <td data-date="26" data-month="3" data-year="2021" data-month_name="March"--}}
{{--                                    class="date-picker"><span>26</span></td>--}}
{{--                                <td data-date="27" data-month="3" data-year="2021" data-month_name="March"--}}
{{--                                    class="date-picker"><span>27</span></td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td data-date="28" data-month="3" data-year="2021" data-month_name="March"--}}
{{--                                    class="date-picker"><span>28</span></td>--}}
{{--                                <td data-date="29" data-month="3" data-year="2021" data-month_name="March"--}}
{{--                                    class="date-picker"><span>29</span></td>--}}
{{--                                <td data-date="30" data-month="3" data-year="2021" data-month_name="March"--}}
{{--                                    class="date-picker"><span>30</span></td>--}}
{{--                                <td data-date="31" data-month="3" data-year="2021" data-month_name="March"--}}
{{--                                    class="date-picker"><span>31</span></td>--}}
{{--                            </tr>--}}
{{--                            <tr></tr>--}}
{{--                            </tbody>--}}
{{--                        </table>--}}

{{--                        <div class="button-container-calendar">--}}
{{--                            <button id="previous" onclick="previous()">⟵</button>--}}
{{--                            <button id="next" onclick="next()">⟶</button>--}}
{{--                        </div>--}}
{{--                        <div class="footer-container-calendar" style="display: none;">--}}
{{--                            <label for="month">Jump To: </label>--}}
{{--                            <select id="month" onchange="jump()">--}}
{{--                                <option value="0">Jan</option>--}}
{{--                                <option value="1">Feb</option>--}}
{{--                                <option value="2">Mar</option>--}}
{{--                                <option value="3">Apr</option>--}}
{{--                                <option value="4">May</option>--}}
{{--                                <option value="5">Jun</option>--}}
{{--                                <option value="6">Jul</option>--}}
{{--                                <option value="7">Aug</option>--}}
{{--                                <option value="8">Sep</option>--}}
{{--                                <option value="9">Oct</option>--}}
{{--                                <option value="10">Nov</option>--}}
{{--                                <option value="11">Dec</option>--}}
{{--                            </select>--}}
{{--                            <select id="year" onchange="jump()">--}}
{{--                                <option value="1970">1970</option>--}}
{{--                                <option value="1971">1971</option>--}}
{{--                                <option value="1972">1972</option>--}}
{{--                                <option value="1973">1973</option>--}}
{{--                                <option value="1974">1974</option>--}}
{{--                                <option value="1975">1975</option>--}}
{{--                                <option value="1976">1976</option>--}}
{{--                                <option value="1977">1977</option>--}}
{{--                                <option value="1978">1978</option>--}}
{{--                                <option value="1979">1979</option>--}}
{{--                                <option value="1980">1980</option>--}}
{{--                                <option value="1981">1981</option>--}}
{{--                                <option value="1982">1982</option>--}}
{{--                                <option value="1983">1983</option>--}}
{{--                                <option value="1984">1984</option>--}}
{{--                                <option value="1985">1985</option>--}}
{{--                                <option value="1986">1986</option>--}}
{{--                                <option value="1987">1987</option>--}}
{{--                                <option value="1988">1988</option>--}}
{{--                                <option value="1989">1989</option>--}}
{{--                                <option value="1990">1990</option>--}}
{{--                                <option value="1991">1991</option>--}}
{{--                                <option value="1992">1992</option>--}}
{{--                                <option value="1993">1993</option>--}}
{{--                                <option value="1994">1994</option>--}}
{{--                                <option value="1995">1995</option>--}}
{{--                                <option value="1996">1996</option>--}}
{{--                                <option value="1997">1997</option>--}}
{{--                                <option value="1998">1998</option>--}}
{{--                                <option value="1999">1999</option>--}}
{{--                                <option value="2000">2000</option>--}}
{{--                                <option value="2001">2001</option>--}}
{{--                                <option value="2002">2002</option>--}}
{{--                                <option value="2003">2003</option>--}}
{{--                                <option value="2004">2004</option>--}}
{{--                                <option value="2005">2005</option>--}}
{{--                                <option value="2006">2006</option>--}}
{{--                                <option value="2007">2007</option>--}}
{{--                                <option value="2008">2008</option>--}}
{{--                                <option value="2009">2009</option>--}}
{{--                                <option value="2010">2010</option>--}}
{{--                                <option value="2011">2011</option>--}}
{{--                                <option value="2012">2012</option>--}}
{{--                                <option value="2013">2013</option>--}}
{{--                                <option value="2014">2014</option>--}}
{{--                                <option value="2015">2015</option>--}}
{{--                                <option value="2016">2016</option>--}}
{{--                                <option value="2017">2017</option>--}}
{{--                                <option value="2018">2018</option>--}}
{{--                                <option value="2019">2019</option>--}}
{{--                                <option value="2020">2020</option>--}}
{{--                                <option value="2021">2021</option>--}}
{{--                                <option value="2022">2022</option>--}}
{{--                                <option value="2023">2023</option>--}}
{{--                                <option value="2024">2024</option>--}}
{{--                                <option value="2025">2025</option>--}}
{{--                                <option value="2026">2026</option>--}}
{{--                                <option value="2027">2027</option>--}}
{{--                                <option value="2028">2028</option>--}}
{{--                                <option value="2029">2029</option>--}}
{{--                                <option value="2030">2030</option>--}}
{{--                                <option value="2031">2031</option>--}}
{{--                                <option value="2032">2032</option>--}}
{{--                                <option value="2033">2033</option>--}}
{{--                                <option value="2034">2034</option>--}}
{{--                                <option value="2035">2035</option>--}}
{{--                                <option value="2036">2036</option>--}}
{{--                                <option value="2037">2037</option>--}}
{{--                                <option value="2038">2038</option>--}}
{{--                                <option value="2039">2039</option>--}}
{{--                                <option value="2040">2040</option>--}}
{{--                                <option value="2041">2041</option>--}}
{{--                                <option value="2042">2042</option>--}}
{{--                                <option value="2043">2043</option>--}}
{{--                                <option value="2044">2044</option>--}}
{{--                                <option value="2045">2045</option>--}}
{{--                                <option value="2046">2046</option>--}}
{{--                                <option value="2047">2047</option>--}}
{{--                                <option value="2048">2048</option>--}}
{{--                                <option value="2049">2049</option>--}}
{{--                                <option value="2050">2050</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- Calendar -->--}}
{{--                <div class="profile-practitioner__consultation nl">--}}
{{--                    <div class="profile-practitioner__consultation-video">--}}
{{--                        <input type="file" id="video-file" name="video-file">--}}
{{--                        <label for="video-file"><img class="upload" src="{{ asset('web_sayt/img/video-file.svg') }}" alt=""></label>--}}
{{--                    </div>--}}
{{--                    <div class="profile-practitioner__consultation-time">--}}
{{--                        <div class="profile-practitioner__consultation-time-content">--}}
{{--                            <p class="time-content-title">VIDEO CONSULTATION <img src="{{ asset('web_sayt/img/zoom-icon-logo.png') }}" alt=""></p>--}}
{{--                            <button class="btn bg-yellow">03:00 PM <span class="x" aria-hidden="true">×</span></button>--}}
{{--                            <button class="btn bg-yellow">04:00 PM <span class="x" aria-hidden="true">×</span></button>--}}
{{--                            <button class="btn bg-yellow">ADD</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="profile-practitioner__consultation-carusel">--}}
{{--                        <div class="profile-practitioner__consultation-carusel-block">--}}
{{--                            <p>SERVICES</p>--}}
{{--                            <div id="customer-testimonals" class="owl-carousel owl-theme owl-loaded owl-drag">--}}
{{--                                <div class="owl-stage-outer">--}}
{{--                                    <div class="owl-stage"--}}
{{--                                         style="transition: all 0s ease 0s; width: 1963px; transform: translate3d(-367px, 0px, 0px);">--}}
{{--                                        <div class="owl-item cloned" style="width: 210.297px; margin-right: 35px;">--}}
{{--                                            <div class="item">--}}
{{--                                                <div class="services__content">--}}
{{--                                                    <div class="services__content-title">--}}
{{--                                                        First Consultation <span class="x" aria-hidden="true">×</span>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="services__content-text">--}}
{{--                                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.--}}
{{--                                                        Lorem Ipsum has been the--}}
{{--                                                    </div>--}}
{{--                                                    <div class="services__content-aed">--}}
{{--                                                        <p>1 hour <span>AED</span> <span>42.24</span></p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="services__content-book">--}}
{{--                                                        <a href="#" class="btn bg-yellow"> Book This Service</a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="owl-item cloned" style="width: 210.297px; margin-right: 35px;">--}}
{{--                                            <div class="item">--}}
{{--                                                <div class="services__content">--}}
{{--                                                    <div class="services__content-title">--}}
{{--                                                        First Consultation <span class="x" aria-hidden="true">×</span>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="services__content-text">--}}
{{--                                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.--}}
{{--                                                        Lorem Ipsum has been the--}}
{{--                                                    </div>--}}
{{--                                                    <div class="services__content-aed">--}}
{{--                                                        <p>1 hour <span>AED</span> <span>42.24</span></p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="services__content-book">--}}
{{--                                                        <a href="#" class="btn bg-yellow"> Book This Service</a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="owl-item active center" style="width: 210.297px; margin-right: 35px;">--}}
{{--                                            <div class="item">--}}
{{--                                                <div class="services__content">--}}
{{--                                                    <div class="services__content-title">--}}
{{--                                                        First Consultation <span class="x" aria-hidden="true">×</span>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="services__content-text">--}}
{{--                                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.--}}
{{--                                                        Lorem Ipsum has been the--}}
{{--                                                    </div>--}}
{{--                                                    <div class="services__content-aed">--}}
{{--                                                        <p>1 hour <span>AED</span> <span>42.24</span></p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="services__content-book">--}}
{{--                                                        <a href="#" class="btn bg-yellow"> Book This Service</a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="owl-item active" style="width: 210.297px; margin-right: 35px;">--}}
{{--                                            <div class="item">--}}
{{--                                                <div class="services__content">--}}
{{--                                                    <div class="services__content-title">--}}
{{--                                                        First Consultation <span class="x" aria-hidden="true">×</span>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="services__content-text">--}}
{{--                                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.--}}
{{--                                                        Lorem Ipsum has been the--}}
{{--                                                    </div>--}}
{{--                                                    <div class="services__content-aed">--}}
{{--                                                        <p>1 hour <span>AED</span> <span>42.24</span></p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="services__content-book">--}}
{{--                                                        <a href="#" class="btn bg-yellow"> Book This Service</a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="owl-item" style="width: 210.297px; margin-right: 35px;">--}}
{{--                                            <div class="item">--}}
{{--                                                <div class="services__content">--}}
{{--                                                    <div class="services__content-title">--}}
{{--                                                        First Consultation <span class="x" aria-hidden="true">×</span>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="services__content-text">--}}
{{--                                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.--}}
{{--                                                        Lorem Ipsum has been the--}}
{{--                                                    </div>--}}
{{--                                                    <div class="services__content-aed">--}}
{{--                                                        <p>1 hour <span>AED</span> <span>42.24</span></p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="services__content-book">--}}
{{--                                                        <a href="#" class="btn bg-yellow"> Book This Service</a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="owl-item" style="width: 210.297px; margin-right: 35px;">--}}
{{--                                            <div class="item">--}}
{{--                                                <div class="services__content">--}}
{{--                                                    <div class="services__content-title">--}}
{{--                                                        First Consultation <span class="x" aria-hidden="true">×</span>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="services__content-text">--}}
{{--                                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.--}}
{{--                                                        Lorem Ipsum has been the--}}
{{--                                                    </div>--}}
{{--                                                    <div class="services__content-aed">--}}
{{--                                                        <p>1 hour <span>AED</span> <span>42.24</span></p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="services__content-book">--}}
{{--                                                        <a href="#" class="btn bg-yellow"> Book This Service</a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="owl-item cloned" style="width: 210.297px; margin-right: 35px;">--}}
{{--                                            <div class="item">--}}
{{--                                                <div class="services__content">--}}
{{--                                                    <div class="services__content-title">--}}
{{--                                                        First Consultation <span class="x" aria-hidden="true">×</span>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="services__content-text">--}}
{{--                                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.--}}
{{--                                                        Lorem Ipsum has been the--}}
{{--                                                    </div>--}}
{{--                                                    <div class="services__content-aed">--}}
{{--                                                        <p>1 hour <span>AED</span> <span>42.24</span></p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="services__content-book">--}}
{{--                                                        <a href="#" class="btn bg-yellow"> Book This Service</a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="owl-item cloned" style="width: 210.297px; margin-right: 35px;">--}}
{{--                                            <div class="item">--}}
{{--                                                <div class="services__content">--}}
{{--                                                    <div class="services__content-title">--}}
{{--                                                        First Consultation <span class="x" aria-hidden="true">×</span>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="services__content-text">--}}
{{--                                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.--}}
{{--                                                        Lorem Ipsum has been the--}}
{{--                                                    </div>--}}
{{--                                                    <div class="services__content-aed">--}}
{{--                                                        <p>1 hour <span>AED</span> <span>42.24</span></p>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="services__content-book">--}}
{{--                                                        <a href="#" class="btn bg-yellow"> Book This Service</a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span--}}
{{--                                            aria-label="Previous">‹</span></button><button type="button" role="presentation"--}}
{{--                                                                                           class="owl-next"><span aria-label="Next">›</span></button></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

    <!---  0000000  ---->
    <main>
        <div class="container">
            <div class="profile-practitioner">
                <div class="profile-practitioner__user nl">
                    <div class="person__info">
                        <div class="person__info-cont1">
                            <img class="person__info-img" src="@if($PractitionerInfo->img){{asset('web_sayt/img/'.$PractitionerInfo->img)}}@else{{asset('web_sayt/img/person-foto.png')}}@endif" alt="">
                            <div class="person__info-name">
                                <span class="profile-practitioner-name">{{$PractitionerInfo->first_name}} {{$PractitionerInfo->last_name}}</span>
                                <span class="edit-pen"><a href="{{route('edit-profile-practitioner',[app()->getLocale()])}}"><img src="{{ asset('web_sayt/img/edit-pen.svg') }}" alt=""></a></span>


                            </div>
                            <div class="person__info-specialist">Acne Specialist &amp; Holistic nutritionist (CNP)</div>
                            <div class="person__info-skin">
                                @foreach($MyTagManagements as $GetTagManagements)
                                  <span class="person__info-skin-tag">{{$GetTagManagements->name}}</span>
                                @endforeach
                            </div>
                            <div class="person__info-my">
                                <a href="{{route('my-appointments-practitioners',[app()->getLocale()])}}" class="mb-4 text-black d-block">My Appointments</a>
                                <a href="{{route('type-form-practitioner',[app()->getLocale()])}}" class="mb-4 text-black d-block">My Intake Forms</a>
                                <a target="_blank" href="https://typeform.com/" class="mb-4 text-black d-block">Create Intake Forms</a>
                                <div role="button" class="mb-3 cursor-pointer bg-yellow px-3 py-2 br-5 text-center" data-toggle="modal" data-target="#myProtocolsModal">My Protocols</div>
                            </div>
                            <div class="person__info-rating qew">
                        <span class="gl-star-rating gl-star-rating--ltr " data-star-rating="">
                           <select class="star-rating">

                              <option value="5">5.0</option>
                              <option value="4">4.0</option>
                              <option value="3">3.0</option>
                              <option value="2">2.0</option>
                              <option value="1">1.0</option>
                           </select>
                           <span class="gl-star-rating--stars s50" role="tooltip" aria-label="5.0">
                              <span data-index="0" data-value="1" class="" style="font-size: -28px;"></span>
                              <span data-index="1" data-value="2" class=""></span>
                              <span data-index="2" data-value="3" class=""></span>
                              <span data-index="3" data-value="4" class=""></span>
                              <span data-index="4" data-value="5" class="gl-selected gl-active"></span>
                           </span>
                        </span>
                            </div>
                            <p class="perion__info-session">256<span> Sessions</span></p>
                        </div>

                    </div>
                </div>
                <div class="profile-practitioner__consultation nl">
                    <div class="d-flex flex-md-row flex-column">
                        <div class="profile-practitioner__consultation-video flex-1 mr-md-3">
                            <input type="file" id="video-file" name="video-file">
                            <label for="video-file"><img class="upload" src="{{ asset('web_sayt/img/video-file.svg') }}" alt=""></label>
                        </div>
                        <div class="person__content-calendar ds-none flex-1">
                            <div class="container-calendar  w-75 mx-auto">
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
                    </div>
                    <div class="profile-practitioner__consultation-time">
                        <div class="profile-practitioner__consultation-time-content">
                            <p class="time-content-title">VIDEO CONSULTATION <img src="{{ asset('web_sayt/img/zoom-icon-logo.png') }}" alt=""></p>
                            @foreach($ThisWeekMeetingsList as $Value)
                            <button class="btn bg-yellow">{{date('H:i:s', strtotime($Value->start_date_time)) }}</button>
                            @endforeach
                        </div>
                    </div>
                    <div class="profile__reviews">
                        <p class="profile__reviews-title">REVIEWS</p>
                        <div class="d-flex flex-lg-row flex-column">
                            <div class="profile__reviews-block">
                                <div class="profile__reviews-person flex-xl-row flex-column">
                                    <img src="{{ asset('web_sayt/img/reviews-person.png') }}" alt="" srcset="">
                                    <div class="profile__reviews-content">
                                        <div class="person__info-rating">
                              <span class="gl-star-rating gl-star-rating--ltr " data-star-rating="">
                                 <select class="star-rating">

                                    <option value="5"></option>
                                    <option value="4"></option>
                                    <option value="3"></option>
                                    <option value="2"></option>
                                    <option value="1"></option>
                                 </select>
                                 <span class="gl-star-rating--stars s50" role="tooltip" aria-label="">
                                    <span data-index="0" data-value="1" class="gl-active"
                                          style="font-size: -28px;"></span>
                                    <span data-index="1" data-value="2" class="gl-active"></span>
                                    <span data-index="2" data-value="3" class="gl-active"></span>
                                    <span data-index="3" data-value="4" class="gl-active"></span>
                                    <span data-index="4" data-value="5" class="gl-selected gl-active"></span>
                                 </span>
                              </span>
                                        </div>

                                        <div class="profile__reviews-content-clock">
                                            <img src="{{ asset('web_sayt/img/clock.svg') }}" alt="" srcset="">
                                            <span class="reviews-clock-data">January 02</span>
                                        </div>
                                        <div class="reviews-cooment">
                                            Morbi commodo sagittis euismod. Donec non facilisis dolor, sed facilisis risus. Praesent
                                            vitae posuere ante.
                                            Donec
                                            risus
                                            dui, feugiat pretium
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile__reviews-block">
                                <div class="profile__reviews-person flex-xl-row flex-column">
                                    <img src="{{ asset('web_sayt/img/reviews-person-second.png') }}" alt="" srcset="">
                                    <div class="profile__reviews-content">
                                        <div class="person__info-rating">
                              <span class="gl-star-rating gl-star-rating--ltr " data-star-rating="">
                                 <select class="star-rating">
                                    <option value="5"></option>
                                    <option value="4"></option>
                                    <option value="3"></option>
                                    <option value="2"></option>
                                    <option value="1"></option>
                                 </select>
                                 <span class="gl-star-rating--stars s50" role="tooltip" aria-label="">
                                    <span data-index="0" data-value="1" class="gl-active"
                                          style="font-size: -28px;"></span>
                                    <span data-index="1" data-value="2" class="gl-active"></span>
                                    <span data-index="2" data-value="3" class="gl-active"></span>
                                    <span data-index="3" data-value="4" class="gl-active"></span>
                                    <span data-index="4" data-value="5" class="gl-selected gl-active"></span>
                                 </span>
                              </span>
                                        </div>

                                        <div class="profile__reviews-content-clock">
                                            <img src="{{ asset('web_sayt/img/clock.svg') }}" alt="" srcset="">
                                            <span class="reviews-clock-data">January 02</span>
                                        </div>
                                        <div class="reviews-cooment">
                                            Morbi commodo sagittis euismod. Donec non facilisis dolor, sed facilisis risus. Praesent
                                            vitae posuere ante.
                                            Donec
                                            risus
                                            dui, feugiat pretium
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="service mt-5 py-5">
                <h2 class="text-center">My Services</h2>
                <h4 class="text-uppercase text-center">ONE ON ONE PROGRAMS</h4>
                <div class=" flex-column flex-lg-row mt-5 d-flex ">
                    <div class="col-lg-4 px-lg-5 mb-4">
                        <div class="bg-light p-5 br-10">
                            <h4 class="text-center mb-5">Add New Plan</h4>
                            <form action="#" class="mb-5">
                                <div class="form-group">
                                    <label for="ConsultationName">Consultation Name</label>
                                    <input type="text" class="form-control" id="ConsultationName">
                                </div>
                                <div class="form-group">
                                    <label for="Price">Price</label>
                                    <input type="number" class="form-control" id="Price">
                                </div>
                                <div class="form-group" id="Description">
                                    <label for="Description">Add Description</label>
                                    <input type="text" class="form-control" name="description[]">
                                </div>
                                <div class="form-group" >
                                    <div class="" role="button">
                                        <img src="{{ asset('web_sayt/img/add.svg') }}" alt="" width="28" height="28" class="mr-2" id="Bdescription">Add Description
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <div class="" role="button">
                                        <img src="{{ asset('web_sayt/img/add.svg') }}" alt="" width="28" height="28" class="mr-2" id="Bsessions">Add Sessions
                                    </div>
                                </div>
                                <div class="form-group" id="SSession">
                                    <label for="SessionTitle">Session Title</label>
                                    <input type="number" class="form-control" name="sessiont_title[]" id="SessionTitle">
                                </div>
                                <button class="bg-yellow br-10 px-4 py-2 fs-16">Save Plan</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="">
                            <div class="profile-practitioner__consultation-carusel-block">
                                <div id="customer-testimonals" class="owl-carousel owl-theme owl-loaded owl-drag">
                                    <div class="item light-green">
                                        <div class="abs">
                                            <i class="fas fa-pen mr-3"></i>
                                            <i class="fas fa-times"></i>
                                        </div>
                                        <div class="d-flex flex-column align-items-center">
                                            <h4 class="mb-3">Get Glow <br> Complete</h4>
                                            <div class="d-flex flex-column mx-auto align-items-center mb-3 italic-text">
                                                <span>60 minute consult +</span>
                                                <span>30 minute follow up</span>
                                                <span>Customized acne healing plan</span>
                                            </div>
                                        </div>
                                        <div class="price d-flex flex-column align-items-center mb-3">
                                <span>
                                   <sup>$</sup> 2100
                                </span>
                                            <small>USD plus HST</small>
                                        </div>
                                        <ul class="list-unstyled px-5 overflow-hidden">
                                            <li><i class="fas fa-angle-right mr-2"></i> <span> 1 hour intimate consult (in person or video)</span></li>
                                            <li><i class="fas fa-angle-right mr-2"></i> <span> One 30 minute follow-up to make any necessary adjustments and track progress</span></li>
                                            <li><i class="fas fa-angle-right mr-2"></i> <span> Unlimited email correspondence during working hours</span></li>
                                            <li><i class="fas fa-angle-right mr-2"></i> <span> Bi-weekly check-ins and progress pictures</span></li>
                                            <li><i class="fas fa-angle-right mr-2"></i> <span> Customized acne healing plan for your specific needs</span></li>
                                            <li><i class="fas fa-angle-right mr-2"></i> <span> Tailored supplement and diet recommendations</span></li>
                                            <li><i class="fas fa-angle-right mr-2"></i> <span> Customized skin care recommendations</span></li>
                                            <li><i class="fas fa-angle-right mr-2"></i> <span> Holistic lifestyle recommendations</span></li>
                                            <li><i class="fas fa-angle-right mr-2"></i> <span> 2 week acne-friendly meal plan</span></li>
                                            <li><i class="fas fa-angle-right mr-2"></i> <span> Emotional support and trauma work</span></li>
                                        </ul>
                                    </div>
                                    <div class="item light-yellow">
                                        <div class="abs">
                                            <i class="fas fa-pen mr-3"></i>
                                            <i class="fas fa-times"></i>
                                        </div>
                                        <div class="d-flex flex-column align-items-center">
                                            <h4 class="mb-3">Get Glow <br> Complete</h4>
                                            <div class="d-flex flex-column mx-auto align-items-center mb-3 italic-text">
                                                <span>60 minute consult +</span>
                                                <span>30 minute follow up</span>
                                                <span>Customized acne healing plan</span>
                                            </div>
                                        </div>
                                        <div class="price d-flex flex-column align-items-center mb-3">
                                            <span>
                                               <sup>$</sup> 175
                                            </span>
                                            <small>USD plus HST</small>
                                        </div>
                                        <ul class="list-unstyled px-5 overflow-hidden">
                                            <li><i class="fas fa-angle-right mr-2"></i> <span> 1 hour intimate consult (in person or video)</span></li>
                                            <li><i class="fas fa-angle-right mr-2"></i> <span> One 30 minute follow-up to make any necessary adjustments and track progress</span></li>
                                            <li><i class="fas fa-angle-right mr-2"></i> <span> Unlimited email correspondence during working hours</span></li>
                                            <li><i class="fas fa-angle-right mr-2"></i> <span> Bi-weekly check-ins and progress pictures</span></li>
                                        </ul>
                                    </div>
                                    <div class="item light-green">
                                        <div class="abs">
                                            <i class="fas fa-pen mr-3"></i>
                                            <i class="fas fa-times"></i>
                                        </div>
                                        <div class="d-flex flex-column align-items-center">
                                            <h4 class="mb-3">Get Glow <br> Complete</h4>
                                            <div class="d-flex flex-column mx-auto align-items-center mb-3 italic-text">
                                                <span>60 minute consult +</span>
                                                <span>30 minute follow up</span>
                                                <span>Customized acne healing plan</span>
                                            </div>
                                        </div>
                                        <div class="price d-flex flex-column align-items-center mb-3">
                                <span>
                                   <sup>$</sup> 2100
                                </span>
                                            <small>USD plus HST</small>
                                        </div>
                                        <ul class="list-unstyled px-5 overflow-hidden">
                                            <li><i class="fas fa-angle-right mr-2"></i> <span> 1 hour intimate consult (in person or video)</span></li>
                                            <li><i class="fas fa-angle-right mr-2"></i> <span> One 30 minute follow-up to make any necessary adjustments and track progress</span></li>
                                            <li><i class="fas fa-angle-right mr-2"></i> <span> Unlimited email correspondence during working hours</span></li>
                                            <li><i class="fas fa-angle-right mr-2"></i> <span> Bi-weekly check-ins and progress pictures</span></li>
                                            <li><i class="fas fa-angle-right mr-2"></i> <span> Customized acne healing plan for your specific needs</span></li>
                                            <li><i class="fas fa-angle-right mr-2"></i> <span> Tailored supplement and diet recommendations</span></li>
                                            <li><i class="fas fa-angle-right mr-2"></i> <span> Customized skin care recommendations</span></li>
                                            <li><i class="fas fa-angle-right mr-2"></i> <span> Holistic lifestyle recommendations</span></li>
                                            <li><i class="fas fa-angle-right mr-2"></i> <span> 2 week acne-friendly meal plan</span></li>
                                            <li><i class="fas fa-angle-right mr-2"></i> <span> Emotional support and trauma work</span></li>
                                        </ul>
                                    </div>
                                    <div class="item light-yellow">
                                        <div class="abs">
                                            <i class="fas fa-pen mr-3"></i>
                                            <i class="fas fa-times"></i>
                                        </div>
                                        <div class="d-flex flex-column align-items-center">
                                            <h4 class="mb-3">Get Glow <br> Complete</h4>
                                            <div class="d-flex flex-column mx-auto align-items-center mb-3 italic-text">
                                                <span>60 minute consult +</span>
                                                <span>30 minute follow up</span>
                                                <span>Customized acne healing plan</span>
                                            </div>
                                        </div>
                                        <div class="price d-flex flex-column align-items-center mb-3">
                                            <span>
                                               <sup>$</sup> 175
                                            </span>
                                            <small>USD plus HST</small>
                                        </div>
                                        <ul class="list-unstyled px-5 overflow-hidden">
                                            <li><i class="fas fa-angle-right mr-2"></i> <span> 1 hour intimate consult (in person or video)</span></li>
                                            <li><i class="fas fa-angle-right mr-2"></i> <span> One 30 minute follow-up to make any necessary adjustments and track progress</span></li>
                                            <li><i class="fas fa-angle-right mr-2"></i> <span> Unlimited email correspondence during working hours</span></li>
                                            <li><i class="fas fa-angle-right mr-2"></i> <span> Bi-weekly check-ins and progress pictures</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!---  0000000 ----->



@endsection

@section('style')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="{{ asset('web_sayt/js/star-rating.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/bootstrap/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/carusel.js') }}"></script>
    <script src="{{ asset('web_sayt/js/filter.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web_sayt/js/script.js') }}"></script>
{{--    <script type="text/javascript" src="{{ asset('web_sayt/js/slidebar.js') }}"></script>--}}

    <script>
        $(document).ready(function(){
            $("#rightMenu").click(function(){
                $(".right-sidebar").addClass("active");
            });

            $("#close-right-sidebar").click(function() {
                $(".right-sidebar").removeClass("active");
            });
        });

        $('[data-toggle="popover"]').popover();


        // Clone Add New Plan

        $("#Bdescription").click(function() {
            var x = $("#Description"),
                y = x.clone();
            x.attr("id", "fileOld");
            y.insertAfter("#Bdescription");
        });

        $("#Bsessions").click(function() {
            var a = $("#SSession"),
                b = a.clone();
            a.attr("id", "fileOld");
            b.insertAfter("#Bsessions");
        });

    </script>
    </script>
@endsection
