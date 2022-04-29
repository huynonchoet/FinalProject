@extends('user.layouts.app')
@section('content')
    <script type="text/javascript">
        $(document).ready(function() {
            //button accept click
            $(document).on('click', '#accept', function() {
                var id = $(this).closest("tr").find('input#id-booking').val()
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'PATCH',
                    url: '/booking-landlords/' + id,
                    data: {
                        action: 1,
                        id: id
                    },
                    success: function(data) {
                        document.getElementById("action-" + id).hidden = true;
                        $('td#status-' + id).text('Accepted');
                    }
                });
            });

            //button cancel click
            $(document).on('click', '#cancel', function() {
                var id = $(this).closest("tr").find('input#id-booking').val()
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'PATCH',
                    url: '/booking-landlords/' + id,
                    data: {
                        action: 2,
                        id: id
                    },
                    success: function(data) {
                        document.getElementById("action-" + id).hidden = true;
                        $('td#status-' + id).text('Cancelled');
                    }
                });
            });

            //start day change 
            $('input#start_day').on('change', function() {
                bookingSearch();
            })

            //end day change 
            $('input#end_day').on('change', function() {
                bookingSearch();
            })

            //change select status
            $('select#status-select').on('click', function() {
                bookingSearch();
            })
        });

        function bookingSearch() {
            var status = $('select#status-select').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                url: '/booking-landlords/search',
                data: {
                    status: status,
                    start_day: $('input#start_day').val(),
                    end_day: $('input#end_day').val(),
                },
                success: function(data) {
                    $('tbody#value-booking').empty();
                    var html = "<tr class='row100 head'>" +
                        "<th class='cell100 column1'>Tenant's Name</th>" +
                        "<th class='cell100 column2'>Day Start</th>" +
                        "<th class='cell100 column3'>Day End</th>" +
                        "<th class='cell100 column3'>Total Price</th>" +
                        "<th class='cell100 column3'>Status</th>" +
                        "<th class='cell100 column3'>Action</th>" +
                        "</tr>";
                    data.forEach((element) => {
                        html +=
                            "<tr><td><a href='http://localhost:8000/booking-landlords/" + element.id +
                            "'>" +
                            element.name +
                            "</a></td><td>" + element.day_start +
                            "</td><td>" + element.day_end +
                            "</td><td>" + element.total_price + " VNĐ" +
                            "</td><td id='status-" + element.id + "'>";
                        if (element.status == 0) {
                            html += "Pending"
                        }
                        if (element.status == 1) {
                            html += "Accepted"
                        }
                        if (element.status == 2) {
                            html += "Cancelled"
                        }
                        html += "</td><td id='action-" + element.id + "'>" +
                            "<input id='id-booking' type='hidden' value='" + element.id + "'>";
                        if (status == 0) {
                            html +=
                                "<button type='button' id='accept' class='btn btn-success'>" +
                                "<i class='bi bi-check-circle-fill'></i>Accept</button>" +
                                "<button type='button' id='cancel' class='btn btn-danger'>" +
                                "<i class='bi bi-check-circle-fill'></i>Cancel</button></td></tr>"
                        }
                        if (status == 1) {
                            html +=
                                "<button type='button' id='cancel' class='btn btn-danger'>" +
                                "<i class='bi bi-check-circle-fill'></i>Cancel</button></td></tr>"
                        }
                    })
                    $('tbody#value-booking').append(html);
                }
            });
        }
    </script>
    <div class="heading-page header-text">
    </div>
    <?php
    use Carbon\Carbon;
    ?>
    <section class="contact-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="down-contact">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="sidebar-item contact-form">
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
                                        <h2>Request Your Homestay</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="form-row" style="margin-top: -25px;">
                                <div class="form-group col-md-4">
                                    <select class="form-control div-action" id="status-select">
                                        <option value="0">Pending</option>
                                        <option value="1">Accepted</option>
                                        <option value="2">Cancelled</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <p class="font-weight-bold">From</p>
                                    <input type="date" id="start_day" value="{{ Carbon::yesterday()->format('Y-m-d') }}">
                                </div>
                                <div class="form-group col-md-2">
                                    <p class="font-weight-bold">To</p>
                                    <input type="date" id="end_day" value="{{ Carbon::tomorrow()->format('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="table100 ver1 m-b-110">
                                <div class="table table-hover table-center js-pscroll">
                                    <table>
                                        <tbody id="value-booking">
                                            <tr class="row100 head">
                                                <th class="cell100 column1">Tenant's Name</th>
                                                <th class="cell100 column2">Day Start</th>
                                                <th class="cell100 column3">Day End</th>
                                                <th class="cell100 column3">Total Price</th>
                                                <th class="cell100 column3">Status</th>
                                                <th class="cell100 column3">Action</th>
                                            </tr>
                                            @foreach ($bookinglandlords as $item)
                                                <tr>
                                                    <td><a
                                                            href="{{ route('user.booking-landlords.show', ['id' => $item->id]) }}">{{ $item->name }}
                                                        </a></td>
                                                    <td>{{ $item->day_start }}</td>
                                                    <td>{{ $item->day_end }}</td>
                                                    <td>{{ number_format($item->total_price) }} VNĐ</td>
                                                    <td id="status-{{ $item->id }}">
                                                        {{ $item->statusLabel }}</td>
                                                    <td id="action-{{ $item->id }}">
                                                        <input id="id-booking" type="hidden" value="{{ $item->id }}">
                                                        <button type="button" id="accept" class="btn btn-success">
                                                            <i class="bi bi-check-circle-fill"></i>Accept
                                                        </button>
                                                        <button type="button" id="cancel" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this request?');">
                                                            <i class="bi bi-check-circle-fill"></i>Cancel
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
@section('css')
@endsection
