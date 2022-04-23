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
                    <ul>
                        @if (Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="sidebar-heading">
                            @if (!empty($homestay))
                                <h2>Homestay Is Currently Selected</h2>
                                <br>
                                <h2>{{ $homestay->name }} - {{ $homestay->address }}</h2>
                            @endif
                        </div>
                        <div>
                            <div class="table100 ver1 m-b-110">
                                <div class="table table-hover table-center js-pscroll">
                                    <table>
                                        <tbody id="value-booking">
                                            <tr class="row100 head">
                                                <th class="cell100 column1">Room</th>
                                                <th class="cell100 column1">Type</th>
                                                <th class="cell100 column2">Day Start</th>
                                                <th class="cell100 column3">Day End</th>
                                                <th class="cell100 column3">Quantity</th>
                                                <th class="cell100 column3">Total Price</th>
                                                <th class="cell100 column3">Action</th>
                                            </tr>
                                            @foreach ($cart as $key => $booking)
                                                <tr>
                                                    <td>{{ $booking['roomName'] }}</td>
                                                    <td>{{ $booking['roomType'] }}</td>
                                                    <td>{{ $booking['from'] }}</td>
                                                    <td>{{ $booking['to'] }} </td>
                                                    <td>{{ $booking['qty'] }}</td>
                                                    <td>{{ $booking['price'] }} VND</td>
                                                    <td>
                                                        <?php
                                                        $key = $booking['roomId'] . '' . $booking['from'] . '' . $booking['to'];
                                                        ?>
                                                        <a
                                                            href="{{ Route('booking.room-detail', ['roomId' => $booking['roomId']]) }}">Detail</a>
                                                        <a
                                                            href="{{ Route('booking.cancel', ['key' => $key]) }}">Cancel</a>
                                                    </td>
                                            @endforeach
                                            <td>
                                                @if (!empty($homestay))
                                                    <a href="{{ Route('booking.checkout') }}">Booking</a>
                                                @endif
                                            </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
@endsection
