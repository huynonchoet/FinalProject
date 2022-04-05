@extends('user.layouts.app')
@section('content')
    <div class="heading-page header-text">
        <section class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-content">
                            <h4>{{ $homestay->name }}</h4>
                            <h2>{{ $homestay->address }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Banner Ends Here -->

    <section class="blog-posts grid-system">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    @php
                        $images = json_decode($room->images);
                    @endphp
                    <div>
                        <img src="{{ asset('storage/rooms/' . $images[0]) }}" alt="" class="img-fluid wc-image">
                    </div>
                    <br>
                    <div class="row">
                        @foreach ($images as $item)
                            <div class="col-sm-4 col-6">
                                <div>
                                    <img src="{{ asset('storage/rooms/' . $item) }}" alt="" class="img-fluid">
                                </div>
                                <br>
                            </div>
                        @endforeach
                    </div>
                    <br>
                </div>
                <div class="col-md-5">
                    <div class="sidebar-item recent-posts">
                        <div class="sidebar-heading">
                            <h2>Room Information</h2>
                        </div>
                        <div class="content">
                            <p>Name Room: {{ $room->name }}</P>
                            <p>Type: {{ $room->typeRoom->name }}</P>
                            <p>Available: {{ $room->quantity_room }}</P>
                            <p>Price: {{ $room->price }} VND per night</P>
                            <p>Discount: {{ $room->discount }}%</P>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="sidebar-item recent-posts">
                        <div class="sidebar-heading">
                            <h2>Contact Details</h2>
                        </div>
                        <div class="content">
                            <p>
                                <span>Name</span>
                                <br>
                                <strong>{{ $user->name }}</strong>
                            </p>
                            <p>
                                <span>Phone</span>
                                <br>
                                <strong>{{ $user->phone }}</strong>
                            </p>
                            <p>
                                <span>Email</span>
                                <br>
                                <strong>{{ $user->email }}</strong>
                            </p>
                        </div>
                    </div>
                    <br>
                    <div class="main-button">
                        <a href="#" data-toggle="modal" data-target="#exampleModal">Booking</a>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </section>
    <div class="section contact-us">
        <div class="container">
            <div class="sidebar-item recent-posts">
                <div class="sidebar-heading">
                    <h2>Description</h2>
                </div>
                <div class="content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia doloremque sit, enim sint odio
                        corporis illum perferendis, unde repellendus aut dolore doloribus minima qui ullam vel possimus
                        magnam ipsa deleniti.</p>
                    <br>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus ducimus ab numquam magnam
                        aliquid, odit provident consectetur corporis eius blanditiis alias nulla commodi qui voluptatibus
                        laudantium quaerat tempore possimus esse nam sed accusantium inventore? Sapiente minima dicta sed
                        quia sunt?</p>
                    <br>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum qui, corrupti consequuntur. Officia
                        consectetur error amet debitis esse minus quasi, dicta suscipit tempora, natus, vitae voluptatem
                        quae libero. Sunt nulla culpa impedit! Aliquid cupiditate, impedit reiciendis dolores, illo
                        adipisci, omnis dolor distinctio voluptas expedita maxime officiis maiores cumque sequi quaerat
                        culpa blanditiis. Quia tenetur distinctio rem, quibusdam officiis voluptatum neque!</p>
                </div>
                <br>
                <br>
            </div>
            <div class="sidebar-item recent-posts">
                <div class="sidebar-heading">
                    <h2>Availability &amp; Prices</h2>
                </div>
                <div class="content">
                    <div class="table-responsive">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
                            <thead>
                                <tr>
                                    <th>From Date: <input type="text" id="datepicker" class="form-control"></th>
                                    <th>To Date: <input type="text" id="datepicker2" class="form-control"></th>

                                </tr>
                            </thead>
                            <tbody>
                                <div class="row">
                                    <div class="col-12">
                                        <!-- Total Amount -->
                                        <div class="total-amount">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-7 col-12">
                                                    <div class="right">
                                                        <ul>
                                                            <li>Status Room: </li>
                                                            <li>Total Price: VND</li>
                                                            <li>Discount: %</li>
                                                            <li>You Pay: </li>
                                                        </ul>
                                                        <div>
                                                            <a type="button" href="" class="btn btn-info">Check Room</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Booking</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="contact-us">
                        <div class="contact-form">
                            <form action="#" id="contact">
                                <div class="row">
                                    <div class="col-md-6">
                                        <fieldset>
                                            <input type="text" class="form-control" placeholder="Enter full name"
                                                required="">
                                        </fieldset>
                                    </div>

                                    <div class="col-md-6">
                                        <fieldset>
                                            <input type="text" class="form-control" placeholder="Enter email address"
                                                required="">
                                        </fieldset>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <fieldset>
                                            <input type="text" class="form-control" placeholder="Enter phone" required="">
                                        </fieldset>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <fieldset>
                                                    <input type="text" class="form-control" placeholder="From date"
                                                        required="">
                                                </fieldset>
                                            </div>

                                            <div class="col-md-6">
                                                <fieldset>
                                                    <input type="text" class="form-control" placeholder="To date"
                                                        required="">
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Send Request</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/accordions.js"></script>

    <script language="text/Javascript">
        cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
        function clearField(t) { //declaring the array outside of the
            if (!cleared[t.id]) { // function makes it static and global
                cleared[t.id] = 1; // you could use true and false, but that's more typing
                t.value = ''; // with more chance of typos
                t.style.color = '#fff';
            }
        }
    </script>
    <script>
        $(function() {
            $("#datepicker").datepicker();
            $("#datepicker2 ").datepicker();
        });
    </script>
@endsection
@section('css')
@endsection
