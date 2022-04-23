@extends('user.layouts.app')
@section('content')
    <div class="heading-page header-text">
        <section class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-content">
                            <h4>Your Homestay</h4>
                            <h2>My Booking</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="blog-posts">
        <div class="container">
            <div class="sidebar-item comments">
                <div class="content">
                    <div class="sidebar-heading">
                        <div>
                            <div class="table100 ver1 m-b-110">
                                <div class="table table-hover table-center js-pscroll">
                                    <table>
                                        <tbody id="value-booking">
                                            <?php
                                            krsort($rooms);
                                            krsort($bookings);
                                            krsort($bookingDetails);
                                            ?>
                                            <tr>
                                                <th>
                                                    Booking ID
                                                    <br>
                                                    @foreach ($bookings as $booking)
                                                        <p class="text-center">{{ $booking->id }}</p>
                                                        <br>
                                                    @endforeach
                                                </th>
                                                <th>
                                                    Room Name
                                                    <br>
                                                    @foreach ($rooms as $room)
                                                        <p>{{ $room->name }}</p>
                                                        <br>
                                                    @endforeach
                                                </th>
                                                <th>
                                                    Room Type
                                                    <br>
                                                    @foreach ($rooms as $room)
                                                        <p>{{ $room->typeRoom->name }}</p>
                                                        <br>
                                                    @endforeach
                                                </th>
                                                <th>
                                                    From
                                                    <br>
                                                    @foreach ($bookings as $booking)
                                                        <p class="text-center">{{ $booking->day_start }}</p>
                                                        <br>
                                                    @endforeach
                                                </th>
                                                <th>
                                                    To
                                                    <br>
                                                    @foreach ($bookings as $booking)
                                                        <p class="text-center">{{ $booking->day_end }}</p>
                                                        <br>
                                                    @endforeach
                                                </th>
                                                <th>
                                                    Quantity Room
                                                    <br>
                                                    @foreach ($bookingDetails as $bookingDetail)
                                                        <p class="text-center">{{ $bookingDetail->quantity_room }}</p>
                                                        <br>
                                                    @endforeach
                                                </th>
                                                <th>
                                                    Total Price
                                                    <br>
                                                    @foreach ($bookingDetails as $bookingDetail)
                                                        <p class="text-center">{{ $bookingDetail->price }}</p>
                                                        <br>
                                                    @endforeach
                                                </th>
                                                <th>
                                                    Action
                                                    <br>
                                                    @foreach ($rooms as $room)
                                                        <p><a class="text-warning h6" 
                                                            href="{{ Route('booking.room-detail', ['roomId' => $room->id]) }}">View Room</a></p>
                                                        <br>
                                                    @endforeach
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
@endsection
