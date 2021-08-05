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
                {{--                                <div class="person__info-skin">--}}
                {{--                                    @foreach($Result->tags as $Tag)--}}
                {{--                                        <span class="person__info-skin-tag">{{ $Tag->name }}</span>--}}
                {{--                                    @endforeach--}}
                {{--                                </div>--}}

            </div>
            <div class="person__info-heart"></div>
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

            {{--                            <div class="person__content-calendar ds-none">--}}
            {{--                                <div class="container-calendar">--}}
            {{--                                    <h3 id="monthAndYear">March</h3>--}}
            {{--                                    <table class="table-calendar" id="calendar" data-lang="en">--}}
            {{--                                        <thead id="thead-month">--}}
            {{--                                        <tr>--}}
            {{--                                            <th data-days="S">S</th>--}}
            {{--                                            <th data-days="M">M</th>--}}
            {{--                                            <th data-days="T">T</th>--}}
            {{--                                            <th data-days="W">W</th>--}}
            {{--                                            <th data-days="T">T</th>--}}
            {{--                                            <th data-days="F">F</th>--}}
            {{--                                            <th data-days="S">S</th>--}}
            {{--                                        </tr>--}}
            {{--                                        </thead>--}}
            {{--                                        <tbody id="calendar-body">--}}
            {{--                                        <tr>--}}
            {{--                                            <td></td>--}}
            {{--                                            <td data-date="1" data-month="3" data-year="2021" data-month_name="March"--}}
            {{--                                                class="date-picker"><span>1</span></td>--}}
            {{--                                            <td data-date="2" data-month="3" data-year="2021" data-month_name="March"--}}
            {{--                                                class="date-picker"><span>2</span></td>--}}
            {{--                                            <td data-date="3" data-month="3" data-year="2021" data-month_name="March"--}}
            {{--                                                class="date-picker"><span>3</span></td>--}}
            {{--                                            <td data-date="4" data-month="3" data-year="2021" data-month_name="March"--}}
            {{--                                                class="date-picker"><span>4</span></td>--}}
            {{--                                            <td data-date="5" data-month="3" data-year="2021" data-month_name="March"--}}
            {{--                                                class="date-picker"><span>5</span></td>--}}
            {{--                                            <td data-date="6" data-month="3" data-year="2021" data-month_name="March"--}}
            {{--                                                class="date-picker"><span>6</span></td>--}}
            {{--                                        </tr>--}}
            {{--                                        <tr>--}}
            {{--                                            <td data-date="7" data-month="3" data-year="2021" data-month_name="March"--}}
            {{--                                                class="date-picker"><span>7</span></td>--}}
            {{--                                            <td data-date="8" data-month="3" data-year="2021" data-month_name="March"--}}
            {{--                                                class="date-picker"><span>8</span></td>--}}
            {{--                                            <td data-date="9" data-month="3" data-year="2021" data-month_name="March"--}}
            {{--                                                class="date-picker"><span>9</span></td>--}}
            {{--                                            <td data-date="10" data-month="3" data-year="2021" data-month_name="March"--}}
            {{--                                                class="date-picker"><span>10</span></td>--}}
            {{--                                            <td data-date="11" data-month="3" data-year="2021" data-month_name="March"--}}
            {{--                                                class="date-picker"><span>11</span></td>--}}
            {{--                                            <td data-date="12" data-month="3" data-year="2021" data-month_name="March"--}}
            {{--                                                class="date-picker"><span>12</span></td>--}}
            {{--                                            <td data-date="13" data-month="3" data-year="2021" data-month_name="March"--}}
            {{--                                                class="date-picker"><span>13</span></td>--}}
            {{--                                        </tr>--}}
            {{--                                        <tr>--}}
            {{--                                            <td data-date="14" data-month="3" data-year="2021" data-month_name="March"--}}
            {{--                                                class="date-picker"><span>14</span></td>--}}
            {{--                                            <td data-date="15" data-month="3" data-year="2021" data-month_name="March"--}}
            {{--                                                class="date-picker"><span>15</span></td>--}}
            {{--                                            <td data-date="16" data-month="3" data-year="2021" data-month_name="March"--}}
            {{--                                                class="date-picker"><span>16</span></td>--}}
            {{--                                            <td data-date="17" data-month="3" data-year="2021" data-month_name="March"--}}
            {{--                                                class="date-picker"><span>17</span></td>--}}
            {{--                                            <td data-date="18" data-month="3" data-year="2021" data-month_name="March"--}}
            {{--                                                class="date-picker"><span>18</span></td>--}}
            {{--                                            <td data-date="19" data-month="3" data-year="2021" data-month_name="March"--}}
            {{--                                                class="date-picker"><span>19</span></td>--}}
            {{--                                            <td data-date="20" data-month="3" data-year="2021" data-month_name="March"--}}
            {{--                                                class="date-picker"><span>20</span></td>--}}
            {{--                                        </tr>--}}
            {{--                                        <tr>--}}
            {{--                                            <td data-date="21" data-month="3" data-year="2021" data-month_name="March"--}}
            {{--                                                class="date-picker"><span>21</span></td>--}}
            {{--                                            <td data-date="22" data-month="3" data-year="2021" data-month_name="March"--}}
            {{--                                                class="date-picker"><span>22</span></td>--}}
            {{--                                            <td data-date="23" data-month="3" data-year="2021" data-month_name="March"--}}
            {{--                                                class="date-picker"><span>23</span></td>--}}
            {{--                                            <td data-date="24" data-month="3" data-year="2021" data-month_name="March"--}}
            {{--                                                class="date-picker selected"><span>24</span></td>--}}
            {{--                                            <td data-date="25" data-month="3" data-year="2021" data-month_name="March"--}}
            {{--                                                class="date-picker"><span>25</span></td>--}}
            {{--                                            <td data-date="26" data-month="3" data-year="2021" data-month_name="March"--}}
            {{--                                                class="date-picker"><span>26</span></td>--}}
            {{--                                            <td data-date="27" data-month="3" data-year="2021" data-month_name="March"--}}
            {{--                                                class="date-picker"><span>27</span></td>--}}
            {{--                                        </tr>--}}
            {{--                                        <tr>--}}
            {{--                                            <td data-date="28" data-month="3" data-year="2021" data-month_name="March"--}}
            {{--                                                class="date-picker"><span>28</span></td>--}}
            {{--                                            <td data-date="29" data-month="3" data-year="2021" data-month_name="March"--}}
            {{--                                                class="date-picker"><span>29</span></td>--}}
            {{--                                            <td data-date="30" data-month="3" data-year="2021" data-month_name="March"--}}
            {{--                                                class="date-picker"><span>30</span></td>--}}
            {{--                                            <td data-date="31" data-month="3" data-year="2021" data-month_name="March"--}}
            {{--                                                class="date-picker"><span>31</span></td>--}}
            {{--                                        </tr>--}}
            {{--                                        <tr></tr>--}}
            {{--                                        </tbody>--}}
            {{--                                    </table>--}}

            {{--                                    <div class="button-container-calendar">--}}
            {{--                                        <button id="previous" onclick="previous()">⟵</button>--}}
            {{--                                        <button id="next" onclick="next()">⟶</button>--}}
            {{--                                    </div>--}}
            {{--                                    <div class="footer-container-calendar" style="display: none;">--}}
            {{--                                        <label for="month">Jump To: </label>--}}
            {{--                                        <select id="month" onchange="jump()">--}}
            {{--                                            <option value="0">Jan</option>--}}
            {{--                                            <option value="1">Feb</option>--}}
            {{--                                            <option value="2">Mar</option>--}}
            {{--                                            <option value="3">Apr</option>--}}
            {{--                                            <option value="4">May</option>--}}
            {{--                                            <option value="5">Jun</option>--}}
            {{--                                            <option value="6">Jul</option>--}}
            {{--                                            <option value="7">Aug</option>--}}
            {{--                                            <option value="8">Sep</option>--}}
            {{--                                            <option value="9">Oct</option>--}}
            {{--                                            <option value="10">Nov</option>--}}
            {{--                                            <option value="11">Dec</option>--}}
            {{--                                        </select>--}}
            {{--                                        <select id="year" onchange="jump()">--}}
            {{--                                            <option value="1970">1970</option>--}}
            {{--                                            <option value="1971">1971</option>--}}
            {{--                                            <option value="1972">1972</option>--}}
            {{--                                            <option value="1973">1973</option>--}}
            {{--                                            <option value="1974">1974</option>--}}
            {{--                                            <option value="1975">1975</option>--}}
            {{--                                            <option value="1976">1976</option>--}}
            {{--                                            <option value="1977">1977</option>--}}
            {{--                                            <option value="1978">1978</option>--}}
            {{--                                            <option value="1979">1979</option>--}}
            {{--                                            <option value="1980">1980</option>--}}
            {{--                                            <option value="1981">1981</option>--}}
            {{--                                            <option value="1982">1982</option>--}}
            {{--                                            <option value="1983">1983</option>--}}
            {{--                                            <option value="1984">1984</option>--}}
            {{--                                            <option value="1985">1985</option>--}}
            {{--                                            <option value="1986">1986</option>--}}
            {{--                                            <option value="1987">1987</option>--}}
            {{--                                            <option value="1988">1988</option>--}}
            {{--                                            <option value="1989">1989</option>--}}
            {{--                                            <option value="1990">1990</option>--}}
            {{--                                            <option value="1991">1991</option>--}}
            {{--                                            <option value="1992">1992</option>--}}
            {{--                                            <option value="1993">1993</option>--}}
            {{--                                            <option value="1994">1994</option>--}}
            {{--                                            <option value="1995">1995</option>--}}
            {{--                                            <option value="1996">1996</option>--}}
            {{--                                            <option value="1997">1997</option>--}}
            {{--                                            <option value="1998">1998</option>--}}
            {{--                                            <option value="1999">1999</option>--}}
            {{--                                            <option value="2000">2000</option>--}}
            {{--                                            <option value="2001">2001</option>--}}
            {{--                                            <option value="2002">2002</option>--}}
            {{--                                            <option value="2003">2003</option>--}}
            {{--                                            <option value="2004">2004</option>--}}
            {{--                                            <option value="2005">2005</option>--}}
            {{--                                            <option value="2006">2006</option>--}}
            {{--                                            <option value="2007">2007</option>--}}
            {{--                                            <option value="2008">2008</option>--}}
            {{--                                            <option value="2009">2009</option>--}}
            {{--                                            <option value="2010">2010</option>--}}
            {{--                                            <option value="2011">2011</option>--}}
            {{--                                            <option value="2012">2012</option>--}}
            {{--                                            <option value="2013">2013</option>--}}
            {{--                                            <option value="2014">2014</option>--}}
            {{--                                            <option value="2015">2015</option>--}}
            {{--                                            <option value="2016">2016</option>--}}
            {{--                                            <option value="2017">2017</option>--}}
            {{--                                            <option value="2018">2018</option>--}}
            {{--                                            <option value="2019">2019</option>--}}
            {{--                                            <option value="2020">2020</option>--}}
            {{--                                            <option value="2021">2021</option>--}}
            {{--                                            <option value="2022">2022</option>--}}
            {{--                                            <option value="2023">2023</option>--}}
            {{--                                            <option value="2024">2024</option>--}}
            {{--                                            <option value="2025">2025</option>--}}
            {{--                                            <option value="2026">2026</option>--}}
            {{--                                            <option value="2027">2027</option>--}}
            {{--                                            <option value="2028">2028</option>--}}
            {{--                                            <option value="2029">2029</option>--}}
            {{--                                            <option value="2030">2030</option>--}}
            {{--                                            <option value="2031">2031</option>--}}
            {{--                                            <option value="2032">2032</option>--}}
            {{--                                            <option value="2033">2033</option>--}}
            {{--                                            <option value="2034">2034</option>--}}
            {{--                                            <option value="2035">2035</option>--}}
            {{--                                            <option value="2036">2036</option>--}}
            {{--                                            <option value="2037">2037</option>--}}
            {{--                                            <option value="2038">2038</option>--}}
            {{--                                            <option value="2039">2039</option>--}}
            {{--                                            <option value="2040">2040</option>--}}
            {{--                                            <option value="2041">2041</option>--}}
            {{--                                            <option value="2042">2042</option>--}}
            {{--                                            <option value="2043">2043</option>--}}
            {{--                                            <option value="2044">2044</option>--}}
            {{--                                            <option value="2045">2045</option>--}}
            {{--                                            <option value="2046">2046</option>--}}
            {{--                                            <option value="2047">2047</option>--}}
            {{--                                            <option value="2048">2048</option>--}}
            {{--                                            <option value="2049">2049</option>--}}
            {{--                                            <option value="2050">2050</option>--}}
            {{--                                        </select>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}


            {{--      Map--}}


        </div>
    </div>
</div>
