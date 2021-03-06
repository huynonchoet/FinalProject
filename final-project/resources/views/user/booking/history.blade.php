@extends('user.layouts.app')
@section('content')
    <script>
        $(document).ready(function() {
            $(".reportDetail")
                .unbind("click")
                .click(function(e) {
                    const id = $(this).attr("data-id");
                    var route = $(this).attr("route");
                    $.ajax({
                        url: route,
                        type: "GET",
                        data: {
                            id: id,
                        },
                        success: function(data) {
                            console.log(data);
                            $(".details").html(data);
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        },
                    });
                });
            $(".rateDetail")
                .unbind("click")
                .click(function(e) {
                    const id = $(this).attr("data-id");
                    var route = $(this).attr("route");
                    $.ajax({
                        url: route,
                        type: "GET",
                        data: {
                            id: id,
                        },
                        success: function(data) {
                            console.log(data);
                            $(".details").html(data);
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        },
                    });
                });
        });
    </script>
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
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
            <div class="sidebar-item comments">
                <div class="content">
                    <div class="sidebar-heading">
                        <div>
                            <div class="table100 ver1 m-b-110">
                                <div class="table table-center js-pscroll" style="margin-left: -90px">
                                    <table style="width: 1250px" class="text-center">
                                        <tbody id="value-booking">
                                            <?php
                                            krsort($rooms);
                                            krsort($bookings);
                                            krsort($bookingDetails);
                                            ?>
                                            <tr>
                                                <th style="font-size: 13px">
                                                    Booking ID
                                                    <br>
                                                    @foreach ($bookings as $booking)
                                                        <p style="font-size: 13px" class="text-center">
                                                            {{ $booking->id }}</p>
                                                        <br>
                                                    @endforeach
                                                </th>
                                                <th style="font-size: 13px">
                                                    Room Name
                                                    <br>
                                                    @foreach ($rooms as $room)
                                                        <p style="font-size: 13px">{{ $room->name }}</p>
                                                        <br>
                                                    @endforeach
                                                </th>
                                                <th style="font-size: 13px">
                                                    Room Type
                                                    <br>
                                                    @foreach ($rooms as $room)
                                                        <p style="font-size: 13px">{{ $room->typeRoom->name }}</p>
                                                        <br>
                                                    @endforeach
                                                </th>
                                                <th style="font-size: 13px">
                                                    From
                                                    <br>
                                                    @foreach ($bookings as $booking)
                                                        <p style="font-size: 13px" class="text-center">
                                                            {{ $booking->day_start }}</p>
                                                        <br>
                                                    @endforeach
                                                </th>
                                                <th style="font-size: 13px">
                                                    To
                                                    <br>
                                                    @foreach ($bookings as $booking)
                                                        <p style="font-size: 13px" class="text-center">
                                                            {{ $booking->day_end }}</p>
                                                        <br>
                                                    @endforeach
                                                </th>
                                                <th style="font-size: 13px">
                                                    Quantity Room
                                                    <br>
                                                    @foreach ($bookingDetails as $bookingDetail)
                                                        <p style="font-size: 13px" class="text-center">
                                                            {{ $bookingDetail->quantity_room }}</p>
                                                        <br>
                                                    @endforeach
                                                </th>
                                                <th style="font-size: 13px">
                                                    Total Price
                                                    <br>
                                                    @foreach ($bookingDetails as $bookingDetail)
                                                        <p style="font-size: 13px" class="text-center">
                                                            {{ number_format($bookingDetail->price, 0, '', ',') }}</p>
                                                        <br>
                                                    @endforeach
                                                </th>
                                                <th style="font-size: 13px">
                                                    Status
                                                    <br>
                                                    @foreach ($bookings as $booking)
                                                        @if ($booking->status == 0)
                                                            <p class="text-warning" style="font-size: 13px">
                                                                Pending</p>
                                                            <br>
                                                        @elseif($booking->status == 1)
                                                            <p class="text-success" style="font-size: 13px">
                                                                Accept</p>
                                                            <br>
                                                        @else
                                                            <p class="text-danger" style="font-size: 13px">
                                                                Cancel</p>
                                                            <br>
                                                        @endif
                                                    @endforeach
                                                </th>
                                                <th style="font-size: 13px">
                                                    Action
                                                    <br>
                                                    @foreach ($rooms as $key1 => $room)
                                                        <p style="margin-bottom: 0.56em"><a class="text-warning"
                                                                style="font-size: 13px"
                                                                href="{{ Route('booking.room-detail', ['roomId' => $room->id]) }}">VIEW
                                                            </a>
                                                            @foreach ($bookings as $key2 => $booking)
                                                                @if ($key1 == $key2)
                                                                    @php
                                                                        $today = date('Y-m-d');
                                                                        $day_end = $booking->day_end;
                                                                    @endphp
                                                                    @if ($day_end < $today)
                                                                        <button data-toggle="modal"
                                                                            data-target="#ModalHomestay" data-id="1"
                                                                            route="{{ route('user.homestays.report', ['id' => $room->homestay_id]) }}"
                                                                            class="li-delete reportDetail"><a
                                                                                style="font-size: 13px"
                                                                                class="text-warning">Report</a></button>
                                                                        @foreach ($bookingDetails as $key3 => $bookingDetail)
                                                                            @if ($key3 == $key1)
                                                                                @if (!in_array($bookingDetail->id, $rates))
                                                                                    <button data-toggle="modal"
                                                                                        data-target="#ModalRateHomestay"
                                                                                        data-id="1"
                                                                                        route="{{ route('user.homestays.rate', ['id' => $bookingDetail->id]) }}"
                                                                                        class="li-delete rateDetail"><a
                                                                                            style="font-size: 13px"
                                                                                            class="text-warning">Rate</a></button>
                                                                                @else
                                                                                    <button data-toggle="modal"
                                                                                        data-target="#ModalRateHomestay"
                                                                                        data-id="1"
                                                                                        route="{{ route('user.homestays.rate', ['id' => $room->homestay_id]) }}"
                                                                                        class="li-delete rateDetail"><a
                                                                                            style="font-size: 13px"
                                                                                            class="text-white">Rate</a></button>
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                    @else
                                                                        <button data-toggle="modal"
                                                                            data-target="#ModalRateHomestay" data-id="1"
                                                                            route="{{ route('user.homestays.rate', ['id' => $room->homestay_id]) }}"
                                                                            class="li-delete rateDetail"><a
                                                                                style="font-size: 13px"
                                                                                class="text-white">Rate</a></button>
                                                                        <button data-toggle="modal"
                                                                            data-target="#ModalHomestay" data-id="1"
                                                                            route="{{ route('user.homestays.report', ['id' => $room->homestay_id]) }}"
                                                                            class="li-delete reportDetail"><a
                                                                                style="font-size: 13px"
                                                                                class="text-white">Report</a></button>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </p>
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
    <div class="modal fade" id="ModalRateHomestay" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <h3 class="title-order">Rate Homestay</h3>
                <div class="modal-header">
                    <button type="button" class="close button-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body body">
                    <div class="details"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ModalHomestay" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <h3 class="title-order">Report Homestay</h3>
                <div class="modal-header">
                    <button type="button" class="close button-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body body">
                    <div class="details"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection
