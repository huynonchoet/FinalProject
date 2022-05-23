@extends('user.layouts.app')
@section('content')
    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="main-banner header-text">
        <div class="container-fluid">
            <div class="owl-banner owl-carousel">
                <div class="item">
                    <img style="width: 544px; height: 368px;" src="{{ asset('assets/user/images/c3.jpg') }}" alt="">
                    <div class="item-content">

                        

                    </div>
                </div>
                <div class="item">
                    <img style="width: 544px; height: 368px;" src="{{ asset('assets/user/images/ccc.jpg') }}" alt="">
                    <div class="item-content">


                    </div>
                </div>
                <div class="item">
                    <img style="width: 544px; height: 368px;" src="{{ asset('assets/user/images/cccc.jpg') }}" alt="">
                    <div class="item-content">


                    </div>
                </div>
                <div class="item">
                    <img style="width: 544px; height: 368px;" src="{{ asset('assets/user/images/c.jpg') }}" alt="">
                    <div class="item-content">


                    </div>
                </div>
                <div class="item">
                    <img style="width: 544px; height: 368px;" src="{{ asset('assets/user/images/c1.jpg') }}" alt="">
                    <div class="item-content">


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
                @if(empty($homestays->toArray()['data']))
                    <p class="text-secondary text-uppercase h3">--- Not Found ---</p>
                @else
                    @foreach ($homestays as $homestay)
                        @php
                            $images = json_decode($homestay->images);
                        @endphp
                        <div class="col-md-4 col-sm-6">
                            <div class="blog-post">
                                <div class="blog-thumb">
                                    <img style="width: 352px; height: 233px;"
                                        src="{{ asset('storage/homestays/' . $images['0']) }}" alt="">
                                </div>
                                <div class="down-content" style="width: 352px; height: 358px;">
                                    <div style="width: 300px; height: 70px;">
                                        <span > {{ $homestay->name }} </span>
                                        <h4>{{ $homestay->phone }}</h4>
                                    </div>
                                    <p style="width: 300px; height: 145px;">{{ $homestay->address }}</p>
                                    <div class="post-options mb-0">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <ul class="post-tags">
                                                    <li><i class="fa fa-bullseye"></i></li>
                                                    <li><a
                                                            href="{{ route('booking.index', ['homestayId' => $homestay->id]) }}">View
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
                @endif
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
