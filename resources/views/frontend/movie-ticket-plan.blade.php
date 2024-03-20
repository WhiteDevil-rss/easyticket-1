@extends('frontend.layouts.main')

@section('main-container')
    <!-- ==========Window-Warning-Section========== -->
    <section class="window-warning inActive">
        <div class="lay"></div>
        <div class="warning-item">
            <h6 class="subtitle">Welcome! </h6>
            <h4 class="title">Select Your Seats</h4>
            <div class="thumb">
                 <img src="{{url('public/frontend/images/movie/seat-plan.png')}}" alt="movie">
            </div>
            <a class="custom-button seatPlanButton" screen_id="" show_id="" onclick="viewseat()">Seat Plans<i class="fas fa-angle-right"></i></a>
        </div>
    </section>
    <!-- ==========Window-Warning-Section========== -->

    <!-- ==========Banner-Section========== -->
    <section class="details-banner hero-area bg_img" data-background="{{url('public/frontend/images/banner/banner02.jpg')}}">
        <div class="container">
            <div class="details-banner-wrapper">
                <div class="details-banner-content">
                    <h3 class="title">{{$movie->title}}</h3>
                    <div class="tags">
                        @foreach(explode(',',$movie->language) as $language)
                        <a href="#">{{$language}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Banner-Section========== -->

    <!-- ==========Book-Section========== -->
    <section class="book-section bg-one">
        <div class="container">
            <form class="ticket-search-form two">
                <div class="form-group">
                    <div class="thumb">
                         <img src="{{url('public/frontend/images/ticket/city.png')}}" alt="ticket">
                        </div>
                        <span class="type">city</span>
                        <select class="select-bar" id="city" name="cityname">
                            <option value="">Select City</option>
                            @foreach($city as $citydata)
                                @if(isset($cityid) && ($cityid == $citydata->id))
                                <option value="{{$citydata->id}}" selected>{{$citydata->city_name}}</option>
                                @else
                                <option value="{{$citydata->id}}">{{$citydata->city_name}}</option>
                                @endif

                            @endforeach 
                        </select>
                </div>
                <div class="form-group">
                    <div class="thumb">
                         <img src="{{url('public/frontend/images/ticket/date.png')}}" alt="ticket">
                    </div>
                    <span class="type">date</span>
                    <select class="select-bar" id="booking_date">
                        {{-- Date from current to next 3 days --}}
                        @for($i=0;$i<4;$i++)
                            <option value="{{date('d-m-Y',strtotime('+'.$i.' days'))}}" {{ Request::get('date') == date('d-m-Y',strtotime('+'.$i.' days')) ? 'selected':''}}>{{date('d-m-Y',strtotime('+'.$i.' days'))}}</option>
                        @endfor
                    </select>
                </div>
            </form>
        </div>
    </section>
    <!-- ==========Book-Section========== -->

    <!-- ==========Movie-Section========== -->
    <div class="ticket-plan-section padding-bottom padding-top">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 mb-5 mb-lg-0">
                    <ul class="seat-plan-wrapper bg-five">
                        @foreach($theatre as $tdata)
                        <li>
                            <div class="movie-name">
                                <a href="#0" class="name">{{$tdata->name}}</a>
                                <div class="location-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                            </div>
                            <div class="movie-schedule">
                                @if(isset($theatredata[$tdata->id]))
                                        @if(count($theatredata[$tdata->id])>0)
                                            @foreach ($theatredata[$tdata->id] as $screentimedata)
                                                {{-- Show only show which is greater then 2 hours todays time and date --}}
                                                @if(Carbon\Carbon::parse(Request::get('date').' '.Carbon\Carbon::parse($screentimedata->start_time)->format('h:i A'))->gt(Carbon\Carbon::now()->addHours(2)))
                                                    <div class="item" onclick="setScreenId({{$screentimedata->screen_id}},{{$screentimedata->show_id}})">
                                                        {{Carbon\Carbon::parse($screentimedata->start_time)->format('h:i A')}}
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            <div class="item">
                                                No Show
                                            </div>
                                        @endif
                                @else
                                    <div class="Noshow">
                                        No Show
                                    </div>
                                @endif
                            </div>
                        </li>   
                        @endforeach                     
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-10">
                    <div class="widget-1 widget-banner">
                        <div class="widget-1-body">
                            <a href="#0">
                                 <img src="{{url('public/frontend/images/sidebar/banner/banner03.jpg')}}" alt="banner">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ==========Movie-Section========== -->
    @endsection
    @section('script')
    <script>
        $(document).ready(function(){
            //get theatre list by city id from database 
            $('#city').change(function(){
                //redirect to another page with city id
                window.location.href = "{{route('movie.book',[$movie->id])}}?city_id="+$('#city').val()+"&date="+$('#booking_date').val();
            });

            $('#booking_date').change(function(){
                //redirect to another page with city id
                window.location.href = "{{route('movie.book',[$movie->id])}}?city_id="+$('#city').val()+"&date="+$('#booking_date').val();
            });
        });
        function viewseat(){
                window.location.href = "{{route('movie.seatlayout',[$movie->id])}}?screen_id="+$('.seatPlanButton').attr('screen_id')+"&show_id="+$('.seatPlanButton').attr('show_id')+"&date="+$('#booking_date').val();
        }

        function setScreenId(screen,show_id){
            $('.seatPlanButton').attr('screen_id',screen);
            $('.seatPlanButton').attr('show_id',show_id)
        }
    </script>
    @endsection