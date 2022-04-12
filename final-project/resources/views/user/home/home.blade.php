@extends('user.layouts.app')
@section('content')
    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="main-banner header-text">
        <div class="container-fluid">
            <div class="owl-banner owl-carousel">
                <div class="item">
                    <img src="{{ asset('assets/user/images/product-1-720x480.jpg') }}" alt="">
                    <div class="item-content">

                        <div class="main-content">
                            <div class="meta-category">
                                <span> $500.00 - $700.00 </span>
                            </div>

                            <a href="vacation-details.html">
                                <h4>Lorem ipsum dolor sit amet.</h4>
                            </a>

                            <ul class="post-info">
                                <li><i class="fa fa-map-marker"></i> 6 Regeneration Road, SE16 2NX</li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="item">
                    <img src="{{ asset('assets/user/images/product-2-720x480.jpg') }}" alt="">
                    <div class="item-content">

                        <div class="main-content">
                            <div class="meta-category">
                                <span> $500.00 - $700.00 </span>
                            </div>

                            <a href="vacation-details.html">
                                <h4>Lorem ipsum dolor sit amet.</h4>
                            </a>

                            <ul class="post-info">
                                <li><i class="fa fa-map-marker"></i> 6 Regeneration Road, SE16 2NX</li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="item">
                    <img src="{{ asset('assets/user/images/product-3-720x480.jpg') }}" alt="">
                    <div class="item-content">

                        <div class="main-content">
                            <div class="meta-category">
                                <span> $500.00 - $700.00 </span>
                            </div>

                            <a href="vacation-details.html">
                                <h4>Lorem ipsum dolor sit amet.</h4>
                            </a>

                            <ul class="post-info">
                                <li><i class="fa fa-map-marker"></i> 6 Regeneration Road, SE16 2NX</li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="item">
                    <img src="{{ asset('assets/user/images/product-4-720x480.jpg') }}" alt="">
                    <div class="item-content">

                        <div class="main-content">
                            <div class="meta-category">
                                <span> $500.00 - $700.00 </span>
                            </div>

                            <a href="vacation-details.html">
                                <h4>Lorem ipsum dolor sit amet.</h4>
                            </a>

                            <ul class="post-info">
                                <li><i class="fa fa-map-marker"></i> 6 Regeneration Road, SE16 2NX</li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="item">
                    <img src="{{ asset('assets/user/images/product-5-720x480.jpg') }}" alt="">
                    <div class="item-content">

                        <div class="main-content">
                            <div class="meta-category">
                                <span> $500.00 - $700.00 </span>
                            </div>

                            <a href="vacation-details.html">
                                <h4>Lorem ipsum dolor sit amet.</h4>
                            </a>

                            <ul class="post-info">
                                <li><i class="fa fa-map-marker"></i> 6 Regeneration Road, SE16 2NX</li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="item">
                    <img src="{{ asset('assets/user/images/product-6-720x480.jpg') }}" alt="">
                    <div class="item-content">
                        <div class="main-content">
                            <div class="meta-category">
                                <span> $500.00 - $700.00 </span>
                            </div>

                            <a href="vacation-details.html">
                                <h4>Lorem ipsum dolor sit amet.</h4>
                            </a>

                            <ul class="post-info">
                                <li><i class="fa fa-map-marker"></i> 6 Regeneration Road, SE16 2NX</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Ends Here -->

    <section class="blog-posts grid-system">
        <div class="container">
            <div class="all-blog-posts">
                <h2 class="text-center">Featured Vacations</h2>
                <br>
                <div class="row">
                    @foreach ($homestays as $homestay)
                        @php
                            $images = json_decode($homestay->images);
                        @endphp
                        <div class="col-md-4 col-sm-6">
                            <div class="blog-post">
                                <div class="blog-thumb">
                                    <img src="{{ asset('storage/homestays/' . $images['0']) }}" alt="">
                                </div>
                                <div class="down-content">
                                    <span> {{ $homestay->name }} </span>
                                    <a href="vacations.html">
                                        <h4>{{ $homestay->phone }}</h4>
                                    </a>
                                    <p>{{ $homestay->address }}</p>
                                    <div class="post-options">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <ul class="post-tags">
                                                    <li><i class="fa fa-bullseye"></i></li>
                                                    <li><a href="{{ route('booking.index', ['homestayId' => $homestay->id]) }}">View
                                                            Homestay
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{ $homestays->appends(Request::except('page'))->links() }}
                </div>
            </div>
        </div>
    </section>

    <section class="call-to-action">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-content">
                        <div class="row">
                            <div class="col-lg-8">
                                <span>Lorem ipsum dolor sit amet.</span>
                                <h4>Sed doloribus accusantium reiciendis et officiis.</h4>
                            </div>
                            <div class="col-lg-4">
                                <div class="main-button">
                                    <a href="contact.html">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="blog-posts">
        <div class="container">
            <div class="sidebar-item comments">
                <h2 class="text-center">Comments</h2>
                <br>
                <br>
                <div class="content">
                    <ul>
                        <li>
                            <div class="author-thumb">
                                <img src="{{ asset('assets/user/images/comment-author-01.jpg') }}" alt="">
                            </div>
                            <div class="right-content">
                                <h4>John Doe<span>10.07.2020</span></h4>
                                <p>Fusce ornare mollis eros. Duis et diam vitae justo fringilla condimentum eu quis leo.
                                    Vestibulum id turpis porttitor sapien facilisis scelerisque. Curabitur a nisl eu
                                    lacus convallis eleifend posuere id tellus.</p>
                            </div>
                        </li>
                        <li>
                            <div class="author-thumb">
                                <img src="{{ asset('assets/user/images/comment-author-02.jpg') }}" alt="">
                            </div>
                            <div class="right-content">
                                <h4>Jane Smith<span>10.07.2020</span></h4>
                                <p>Nullam nec pharetra nibh. Cras tortor nulla, faucibus id tincidunt in, ultrices eget
                                    ligula. Sed vitae suscipit ligula. Vestibulum id turpis volutpat, lobortis turpis
                                    ac, molestie nibh.</p>
                            </div>
                        </li>
                        <li>
                            <div class="author-thumb">
                                <img src="{{ asset('assets/user/images/comment-author-03.jpg') }}" alt="">
                            </div>
                            <div class="right-content">
                                <h4>Kate Blue<span>10.07.2020</span></h4>
                                <p>Nullam nec pharetra nibh. Cras tortor nulla, faucibus id tincidunt in, ultrices eget
                                    ligula. Sed vitae suscipit ligula. Vestibulum id turpis volutpat, lobortis turpis
                                    ac, molestie nibh.</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <br>
                <br>

                <div class="row justify-content-md-center">
                    <div class="col-md-3">
                        <div class="main-button">
                            <a href="testimonials.html">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
@endsection
