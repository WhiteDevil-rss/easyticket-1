@extends('frontend.layouts.main')

@section('main-container')
    <!-- ==========Banner-Section========== -->
    <section class="details-banner hero-area bg_img seat-plan-banner" data-background="assets/images/banner/banner04.jpg">
        <div class="container">
            <div class="details-banner-wrapper">
                <div class="details-banner-content style-two">
                    <h3 class="title">{{$movie_name}}</h3>
                    <div class="tags">
                        <a href="#0">{{$theatre_name}}</a>
                        <a href="#0">{{$language}}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <form action="{{route('movie.book.movie')}}" method="POST">
        @csrf
    <input type="hidden" name="showtime_id" value="{{$showtime_id}}">
    <input type="hidden" name="movie_name" value="{{$movie_name}}">
    <input type="hidden" name="theatre_name" value="{{$theatre_name}}">
    <input type="hidden" name="theatre_id" value="{{$theatre_id}}">
    <input type="hidden" name="showtime" value="{{$showtime}}">
    <input type="hidden" name="date" value="{{$date}}">
    <input type="hidden" name="language" value="{{$language}}">
    <input type="hidden" name="movie_id" value="{{$movie_id}}">
    <input type="hidden" name="date" value="{{$date}}">
    <input type="hidden" name="seat" id="selected_seats" value="{{$seat}}">
    <input type="hidden" name="price" id="price" value="{{$price}}">
    <input type="hidden" name="totalprice" id="totalprice" value="{{$totalprice}}">
    <!-- ==========Banner-Section========== -->

    <!-- ==========Page-Title========== -->
    <section class="page-title bg-one">
        <div class="container">
            <div class="page-title-area">
                <div class="item md-order-1">
                    <a href="movie-ticket-plan.html" class="custom-button back-button">
                        <i class="flaticon-double-right-arrows-angles"></i>back
                    </a>
                </div>
                <div class="item date-item">
                    <span class="date">{{\Carbon\Carbon::parse($date)->format('D d-M-Y')}}</span>
                    <select class="select-bar">
                        <option value="sc1">{{$showtime}}</option>
                    </select>
                </div>
                {{-- <div class="item">
                    <h5 class="title">05:00</h5>
                    <p>Mins Left</p>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- ==========Page-Title========== -->

    <!-- ==========Movie-Section========== -->
    <div class="movie-facility padding-bottom padding-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    @if(!isset(Auth::user()->id))
                    <div class="checkout-widget d-flex flex-wrap align-items-center justify-cotent-between">
                        <div class="title-area">
                            <h5 class="title">Already a {{ env('APP_NAME') }}  Member?</h5>
                            <p>Sign in to earn points and make booking easier!</p>
                        </div>
                        <a href="#0" class="sign-in-area">
                            <i class="fas fa-user"></i><span>Sign in</span>
                        </a>
                    </div>
                    @endif
                    <div class="checkout-widget checkout-contact">
                        <h5 class="title">Share your Contact  Details </h5>
                        <form class="checkout-contact-form">
                            <div class="form-group">
                                <input type="text" placeholder="Full Name">
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Enter your Mail">
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Enter your Phone Number ">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Continue" class="custom-button">
                            </div>
                        </form>
                    </div>
                    {{-- <div class="checkout-widget checkout-contact">
                        <h5 class="title">Promo Code </h5>
                        <form class="checkout-contact-form">
                            <div class="form-group">
                                <input type="text" placeholder="Please enter promo code">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Verify" class="custom-button">
                            </div>
                        </form>
                    </div> --}}
                    <div class="checkout-widget checkout-card mb-0">
                        <h5 class="title">Payment Option </h5>
                        <ul class="payment-option">
                            <li class="active">
                                <a href="#0">
                                     <img src="{{url('public/frontend/images/payment/card.png')}}" alt="payment">
                                    <span>Credit Card</span>
                                </a>
                            </li>
                            <li>
                                <a href="#0">
                                     <img src="{{url('public/frontend/images/payment/card.png')}}" alt="payment">
                                    <span>Debit Card</span>
                                </a>
                            </li>
                        </ul>
                        <h6 class="subtitle">Enter Your Card Details </h6>
                        <form class="payment-card-form">
                            <div class="form-group w-100">
                                <label for="card1">Card Details</label>
                                <input type="text" id="card1">
                                <div class="right-icon">
                                    <i class="flaticon-lock"></i>
                                </div>
                            </div>
                            <div class="form-group w-100">
                                <label for="card2"> Name on the Card</label>
                                <input type="text" id="card2">
                            </div>
                            <div class="form-group">
                                <label for="card3">Expiration</label>
                                <input type="text" id="card3" placeholder="MM/YY">
                            </div>
                            <div class="form-group">
                                <label for="card4">CVV</label>
                                <input type="text" id="card4" placeholder="CVV">
                            </div>
                            <div class="form-group check-group">
                                <input id="card5" type="checkbox" checked>
                                <label for="card5">
                                    <span class="title">QuickPay</span>
                                    <span class="info">Save this card information to my {{ env('APP_NAME') }}  account and make faster payments.</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="custom-button" value="make payment">
                            </div>
                        </form>
                        <p class="notice">
                            By Clicking "Make Payment" you agree to the <a href="#0">terms and conditions</a>
                        </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="booking-summery bg-one">
                        <h4 class="title">booking summery</h4>
                        <ul>
                            <li>
                                <h6 class="subtitle">{{$movie_name}}</h6>
                                <span class="info">{{$language}}</span>
                            </li>
                            <li>
                                <h6 class="subtitle"><span>{{$theatre_name}}</span><span>{{count(explode(',',$seat))}}</span></h6>
                                <div class="info"><span>{{\Carbon\Carbon::parse($date)->format('D d-M-Y')}}, {{$showtime}}</span> <span>Tickets</span></div>
                            </li>
                            <li>
                                <h6 class="subtitle"><span>Seats</span><span>{{$seat}}</span></h6>
                                <h6 class="subtitle mb-0"><span>Tickets  Price</span><span>₹{{$totalprice}}</span></h6>
                            </li>
                        </ul>
                        <ul class="side-shape">
                            <li>
                                <span class="info"><span>price</span><span>₹{{$totalprice}}</span></span>
                                {{-- Calculate vat 18% from total price --}}
                                <span class="info"><span>vat</span><span>₹{{($totalprice*18)/100}}</span></span>
                            </li>
                        </ul>
                    </div>
                    <div class="proceed-area  text-center">
                        <h6 class="subtitle"><span>Amount Payable</span><span>₹{{round($totalprice+($totalprice*18)/100,0)}}</span></h6>
                        <input type="hidden" name="amount_payable" value="{{round($totalprice+($totalprice*18)/100,0)}}">
                        <button type="submit" class="custom-button back-button">proceed</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    <!-- ==========Movie-Section========== -->
    @endsection