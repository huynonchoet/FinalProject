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
            <div class="sidebar-item comments">
                <div class="content">
                    <div class="sidebar-heading">
                        <div>
                            <div class="table100 ver1 m-b-110">
                                <div class="table table-center js-pscroll">
                                    <table style="width: 100%">
                                        <tbody id="value-bookin">
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
                                                            <p style="font-size: 13px">
                                                                Pending</p>
                                                            <br>
                                                        @elseif($booking->status == 1)
                                                            <p style="font-size: 13px">
                                                                Accept</p>
                                                            <br>
                                                        @else
                                                            <p style="font-size: 13px">
                                                                Cancel</p>
                                                            <br>
                                                        @endif
                                                    @endforeach
                                                </th>
                                                <th style="font-size: 13px">
                                                    Action
                                                    <br>
                                                    @foreach ($rooms as $room)
                                                        <p class="text-center" style="margin-bottom: 0.56em"><a
                                                                class="text-warning" style="font-size: 13px"
                                                                href="{{ Route('booking.room-detail', ['roomId' => $room->id]) }}">VIEW
                                                            </a>
                                                            <button data-toggle="modal" data-target="#ModalHomestay"
                                                                data-id="1"
                                                                route="{{ route('user.homestays.report', ['id' => $room->homestay_id]) }}"
                                                                class="li-delete reportDetail"><a style="font-size: 13px"
                                                                    class="text-warning">Report</a></button>
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
