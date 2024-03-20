@extends('frontend.layouts.main')

@section('main-container')
    <!-- ==========Window-Warning-Section========== -->
    <section class="window-warning inActive">
        <div class="lay"></div>
        <div class="warning-item">
            <h6 class="subtitle">Welcome! </h6>
            <h4 class="title">Your Tickets</h4>
            <div class="thumb">
                 <img src="{{url('public/frontend/images/movie/seat-plan.png')}}" alt="movie">
            </div>
            <a class="custom-button seatPlanButton" screen_id="" show_id="" onclick="viewseat()">Seat Plans<i class="fas fa-angle-right"></i></a>
        </div>
    </section>
    <!-- ==========Window-Warning-Section========== -->

    <!-- ==========Movie-Section========== -->
    <div class="ticket-plan-section padding-bottom padding-top">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 mb-5 mb-lg-0">
                    <h3> Your Tickets </h3><br>
                    <table class="table table-responsive text-white table-stripped">
                        <thead>
                            <tr>
                                <th scope="col">Movie Name</th>
                                <th scope="col">Show Date</th>
                                <th scope="col">Show Time</th>
                                <th scope="col">Seat No</th>
                                <th scope="col">Total Amount</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($tickets))
                                @foreach($tickets as $ticket)
                                    <tr>
                                        <td>{{$ticket->title}}</td>
                                        <td>{{$ticket->show_date}}</td>
                                        <td>{{\Carbon\Carbon::parse($ticket->start_time)->format('h:i a')}}</td>
                                        <td>{{$ticket->seat_number}}</td>
                                        <td>₹{{$ticket->price}}</td>
                                        <td>
                                            <a href="{{route('movie.ticket.print',$ticket->id)}}" class="btn btn-primary"><i class="fa fa-print"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center">No Tickets Found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- ==========Movie-Section========== -->
    @endsection
    @section('script')
    <script>
    </script>
    @endsection