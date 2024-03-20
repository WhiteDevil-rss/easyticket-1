@extends('frontend.layouts.main')

@section('main-container')
  
  <!-- ==========Banner-Section========== -->
    <section class="banner-section">
        <div class="banner-bg bg_img bg-fixed" data-background="{{url('public/frontend/images/banner/banner01.jpg')}}"></div>
        <div class="container">
            <div class="banner-content">
                <h1 class="title  cd-headline clip"><span class="d-block">book your</span> tickets for 
                    <span class="color-theme cd-words-wrapper p-0 m-0">
                        <b class="is-visible">Movie</b>
                    </span>
                </h1>
                <p>Safe, secure, reliable ticketing.Your ticket to live entertainment!</p>
            </div>
        </div>
    </section>
    <!-- ==========Banner-Section========== -->

    <!-- ==========Ticket-Search========== -->
    <section class="search-ticket-section padding-top pt-lg-0">
        <div class="container">
            <div class="search-tab bg_img" data-background="{{url('public/frontend/images/ticket/ticket-bg01')}}.jpg">
                <div class="row align-items-center mb--20">
                    <div class="col-lg-6 mb-20">
                        <div class="search-ticket-header">
                            <h6 class="category">welcome to {{ env('APP_NAME') }} </h6>
                            <h3 class="title">what are you looking for</h3>
                        </div>
                    </div>

                </div>
                <div class="tab-area">
                    <div class="tab-item active">
                        <form class="ticket-search-form">
                            <div class="form-group large">
                                <input type="text" placeholder="Search fo Movies">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </div>
                            <div class="form-group">
                                <div class="thumb">
                                     <img src="{{url('public/frontend/images/ticket/city.png')}}" alt="ticket">
                                </div>
                                <span class="type">city</span>
                                @php 
                                    $cities = DB::table('city')->get();

                                @endphp 
                                <select class="select-bar">
                                    @foreach($cities as $city)
                                    <option value="{{$city->id}}">{{$city->city_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="thumb">
                                     <img src="{{url('public/frontend/images/ticket/date.png')}}" alt="ticket">
                                </div>
                                <span class="type">date</span>
                                <select class="select-bar">

                                </select>
                            </div>
                            <div class="form-group">
                                <div class="thumb">
                                     <img src="{{url('public/frontend/images/ticket/cinema.png')}}" alt="ticket">
                                </div>
                                <span class="type">cinema</span>
                                <select class="select-bar">
                                    <option value="">Select Cinema</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>    
    <!-- ==========Ticket-Search========== -->

    <!-- ==========Movie-Section========== -->
    <section class="movie-section padding-top padding-bottom">
        <div class="container">
            <div class="tab">
                <div class="section-header-2">
                    <div class="left">
                        <h2 class="title">movies</h2>
                        <p>Be sure not to miss these Movies today.</p>
                    </div>
                    <ul class="tab-menu">
                        <li class="active">
                            now showing 
                        </li>
                        <li>
                            coming soon
                        </li>
                        <li>
                            exclusive
                        </li>
                    </ul>
                </div>
                <div class="tab-area mb-30-none">
                    <div class="tab-item active">
                        <div class="owl-carousel owl-theme tab-slider">
                            @foreach($movies as $movie)
                            <div class="item">
                                <div class="movie-grid">
                                    <div class="movie-thumb c-thumb">
                                        <a href="{{route('movie.show',[$movie->title])}}">
                                             <img src="{{url('public/frontend/images/movie/'.$movie->image)}}" alt="movie">
                                        </a>
                                    </div>
                                    <div class="movie-content bg-one">
                                        <h5 class="title m-0">
                                            <a href="{{route('movie.show',[$movie->title])}}">{{ $movie->title}}</a>
                                        </h5>
                                        <ul class="movie-rating-percent">
                                            <li>
                                                <div class="thumb">
                                                </div>
                                                <span class="content"><i class="fa fa-star mr-2"></i>{{$movie->rating}}/10</span>
                                            </li>
                                            <li>
                                                <div class="thumb">
                                                </div>
                                                <span class="content">{{$movie->genre}}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div> 
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-item">
                        <div class="owl-carousel owl-theme tab-slider">

                        </div>
                    </div>
                    <div class="tab-item">
                        <div class="owl-carousel owl-theme tab-slider">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Movie-Section========== -->
@endsection
@section('script')
    {{-- <script>
        $(document).ready(function(){
            //city select fetch cinema 
            $('select[name="city"]').on('change',function(){
                var city_id = $(this).val();
                if(city_id){
                    $.ajax({
                        url: "{{url('/get-cinema-list')}}/"+city_id,
                        type:"GET",
                        dataType:"json",
                        success:function(data){
                            $('select[name="cinema"]').empty();
                            $.each(data,function(key,value){
                                $('select[name="cinema"]').append('<option value="'+key+'">'+value+'</option>');
                            });
                        }
                    });
                }else{
                    alert('danger');
                }
            });
        });
    </script> --}}
@endsection
