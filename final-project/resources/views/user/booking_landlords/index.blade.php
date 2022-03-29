@extends('user.layouts.app')
@section('content')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#accept').on('click', function() {
                var id = $(this).closest("tr").find('input#id-booking').val();
                $(this).attr(style, 'display: value');
                console.log(id);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'PATCH',
                    url: '/booking-landlords/' + id,
                    action: 1,
                    success: function(data) {

                    }
                });
            })
        });
    </script>
    <div class="heading-page header-text">
    </div>
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
                            <ul class="nav nav-tabs">
                                <li class="active option-statistic"><a data-toggle="tab" href="#home">Pending</a></li>
                                <li class="option-statistic"><a data-toggle="tab" href="#menu1">Accepted</a></li>
                                <li class="option-statistic"><a data-toggle="tab" href="#menu2">Cancelled</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="home" class="tab-pane fade in active">
                                    <div class="table100 ver1 m-b-110">
                                        <div class="table table-hover table-center js-pscroll">
                                            <table>
                                                <tbody>
                                                    <tr class="row100 head">
                                                        <th class="cell100 column1">Tenant's Name</th>
                                                        <th class="cell100 column2">Day Start</th>
                                                        <th class="cell100 column3">Day End</th>
                                                        <th class="cell100 column3">Action</th>
                                                    </tr>
                                                    @foreach ($bookinglandlords as $item)
                                                        @if ($item->status == 0)
                                                            <tr>
                                                                <td>{{ $item->name }}</td>
                                                                <td>{{ $item->day_start }}</td>
                                                                <td>{{ $item->day_end }}</td>
                                                                <td>{{ $item->day_end }}</td>
                                                                <td>
                                                                    <input id="id-booking" type="hidden"
                                                                        value="{{ $item->id }}">
                                                                    <button type="button" id="accept"
                                                                        class="btn btn-success">
                                                                        <i class="bi bi-check-circle-fill"></i>Accept
                                                                    </button>
                                                                    <button type="button" id="cancel"
                                                                        class="btn btn-danger">
                                                                        <i class="bi bi-check-circle-fill"></i>Cancel
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="menu1" class="tab-pane fade">
                                    <div class="table100 ver1 m-b-110">
                                        <div class="table table-hover table-center js-pscroll">
                                            <table>
                                                <tbody>
                                                    <tr class="row100 head">
                                                        <th class="cell100 column1">Tenant's Name</th>
                                                        <th class="cell100 column2">Day Start</th>
                                                        <th class="cell100 column3">Day End</th>
                                                        <th class="cell100 column3">Action</th>
                                                    </tr>
                                                    <tr>
                                                        <td>John</td>
                                                        <td>Doe</td>
                                                        <td>john@example.com</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mary</td>
                                                        <td>Moe</td>
                                                        <td>mary@example.com</td>
                                                    </tr>
                                                    <tr>
                                                        <td>July</td>
                                                        <td>Dooley</td>
                                                        <td>july@example.com</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="menu2" class="tab-pane fade">
                                    <div class="table100 ver1 m-b-110">
                                        <div class="table table-hover table-center js-pscroll">
                                            <table>
                                                <tbody>
                                                    <tr class="row100 head">
                                                        <th class="cell100 column1">Tenant's Name</th>
                                                        <th class="cell100 column2">Day Start</th>
                                                        <th class="cell100 column3">Day End</th>
                                                        <th class="cell100 column3">Action</th>
                                                    </tr>
                                                    <tr>
                                                        <td>John</td>
                                                        <td>Doe</td>
                                                        <td>john@example.com</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mary</td>
                                                        <td>Moe</td>
                                                        <td>mary@example.com</td>
                                                    </tr>
                                                    <tr>
                                                        <td>July</td>
                                                        <td>Dooley</td>
                                                        <td>july@example.com</td>
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
    </section>
@endsection
@section('css')
@endsection
