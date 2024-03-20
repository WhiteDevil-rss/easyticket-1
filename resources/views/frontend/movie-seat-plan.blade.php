@extends('frontend.layouts.main')

@section('main-container')
    <!-- ==========Banner-Section========== -->
    <section class="details-banner hero-area bg_img seat-plan-banner" data-background="assets/images/banner/banner04.jpg">
        <div class="container">
            <div class="details-banner-wrapper">
                <div class="details-banner-content style-two">
                    <h3 class="title">{{$movie->title}}</h3>
                    <div class="tags">
                        <a href="#0">{{$theatre[0]->name}}</a>
                        <a href="#0">{{$movie->language}}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Banner-Section========== -->

    <!-- ==========Page-Title========== -->
    <section class="page-title bg-one">
        <div class="container">
            <div class="page-title-area">
                <div class="item md-order-1">
                    <a href="javascript:history.back()" class="custom-button back-button">
                        <i class="flaticon-double-right-arrows-angles"></i>Back
                    </a>
                </div>
                <div class="item date-item">
                    <span class="date">{{Carbon\Carbon::parse(Request::get('date'))->format('d-m-Y')}} {{Carbon\Carbon::parse($showtime[0]->start_time)->format('h:i A')}}</span>
                </div>
                @if(!empty($seatdata))
                <div class="item">
                    <h5 class="title" id="timer"></h5>
                    <p>Mins Left</p>
                </div>
                @endif
            </div>
        </div>
    </section>
    <!-- ==========Page-Title========== -->

    <!-- ==========Movie-Section========== -->
    @if(!empty($seatdata))
    <form action="{{route('movie.checkout')}}" method="POST">
        @csrf
    <input type="hidden" name="showtime_id" value="{{$showtime[0]->id}}">
    <input type="hidden" name="movie_name" value="{{$movie->title}}">
    <input type="hidden" name="theatre_name" value="{{$theatre[0]->name}}">
    <input type="hidden" name="theatre_id" value="{{$theatre[0]->id}}">
    <input type="hidden" name="showtime" value="{{Carbon\Carbon::parse($showtime[0]->start_time)->format('h:i A')}}">
    <input type="hidden" name="date" value="{{Carbon\Carbon::parse(Request::get('date'))->format('d-m-Y')}}">
    <input type="hidden" name="language" value="{{$movie->language}}">
    <input type="hidden" name="movie_id" value="{{$movie->id}}">
    <input type="hidden" name="date" value="{{Request::get('date')}}">
    <input type="hidden" name="seat" id="selected_seats" value="">
    <input type="hidden" name="price" id="price" value="">
    <input type="hidden" name="totalprice" id="totalprice" value="">

    <div class="seat-plan-section padding-bottom padding-top">
        <div class="container">
            <div class="proceed-book bg_img" data-background="assets/images/movie/movie-bg-proceed.jpg">
                <div class="proceed-to-book">
                    <div class="book-item">
                        <span>You have Choosed Seat</span>
                        <h3 class="title choosed_seat"></h3>
                    </div>
                    <div class="book-item">
                        <span>total price</span>
                        <h3 class="title totalprice">₹0</h3>
                    </div>
                    <div class="book-item">
                        <button type="submit" class="custom-button">proceed</button>
                    </div>
                </div>
            </div>
            <div class="screen-area">
                <h4 class="screen">screen</h4>
                <div class="screen-thumb">
                     <img src="{{url('public/frontend/images/movie/screen-thumb.png')}}" alt="movie">
                </div>
                @if(!empty($seatdata))
                    @foreach($seatdata as $seattype=>$seatrowsdata)
                    <h5 class="subtitle">{{$seattype}}</h5>
                        @foreach($seatrowsdata as $seatrow=>$seat)
                        <div class="screen-wrapper">
                            <ul class="seat-area">
                                <li class="seat-line">
                                    <span>{{$seatrow}}</span>
                                    <ul class="seat--area">
                                        @foreach($seat as $seatpostion=>$seatchairs)
                                            <li class="front-seat">
                                                <ul>
                                                    @foreach($seatchairs as $key=>$value)
                                                    <li class="single-seat {{ !isset($booked_seats[$seatrow.$value->seat_no]) ? 'seat-free' : 'booked' }}">
                                                        <img src="{{url('public/frontend/images/movie/')}}{{!isset($booked_seats[$seatrow.$value->seat_no]) ? '/seat01-free.png' : '/seat01.png'}}" booked="" alt="seat" seatno="{{$seatrow.$value->seat_no}}" seat_id="{{$seatrow.'_'.$value->seat_id}}" price="{{$value->price+ $showtime[0]->price_factor}}">
                                                        <span class="sit-num">{{!isset($booked_seats[$seatrow.$value->seat_no]) ? $value->seat_no : ''}}</span>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <span>{{$seatrow}}</span>
                                </li>
                            </ul>
                        </div>
                        @endforeach
                    @endforeach
                @endif
            </div>
            <div class="proceed-book bg_img" data-background="assets/images/movie/movie-bg-proceed.jpg">
                <div class="proceed-to-book">
                    <div class="book-item">
                        <span>You have Choosed Seat</span>
                        <h3 class="title choosed_seat"></h3>
                    </div>
                    <div class="book-item">
                        <span>total price</span>
                        <h3 class="title totalprice">₹0</h3>
                    </div>
                    <div class="book-item">
                        <button type="submit" class="custom-button">proceed</button>
                    </div>
                </div>
            </div>
            </form>
        @else
            <div class="alert alert-danger">No Seat Available</div>

        @endif
        </div>
    </div>
    <!-- ==========Movie-Section========== -->
    @endsection

    @section('script')
    <script>
    //five minutes timer for refresh page
    setTimeout(function(){
        window.location.reload(1);
    }, 300000);
    //display time remaining from 5 minutes for booking ticket
    var countDownDate = new Date().getTime() + 300000;
    var x = setInterval(function() {
        var now = new Date().getTime();
        var distance = countDownDate - now;
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        document.getElementById("timer").innerHTML = minutes + "m " + seconds + "s ";
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("timer").innerHTML = "EXPIRED";
        }
    }, 1000);
    </script
    @endsection