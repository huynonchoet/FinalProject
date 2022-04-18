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
                                            @foreach ($bookingDetails as $key => $bookingDetail)
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <a
                                                            href="">Detail</a>
                                                        <a
                                                            href="">Cancel</a>
                                                    </td>
                                            @endforeach
                                            <td>
                                                <a href="">Booking</a>
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
