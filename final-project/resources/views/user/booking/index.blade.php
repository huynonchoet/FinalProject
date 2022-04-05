@extends('user.layouts.app')
@section('content')
    <div class="heading-page header-text">
        <section class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-content">
                            <h4>Your Homestay</h4>
                            <h2>Manage Your Homestay</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="blog-posts">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="all-blog-posts">
                        <div class="row">
                            @php
                                $images = json_decode($homestay->images);
                            @endphp
                            @foreach ($images as $item)
                                <div class="col-lg-6">
                                    <div class="blog-post">
                                        <div class="blog-thumb">
                                            <img src="{{ asset('storage/homestays/' . $item) }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
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
                        @foreach ($rooms as $key => $item)
                            @php
                                $images = json_decode($rooms[$key]->images);
                            @endphp
                            <li>
                                <div class="author-thumb">
                                    <img src="{{ asset('storage/rooms/' . $images[0]) }}" alt="">
                                </div>
                                <div class="right-content">
                                    <h4>{{ $item->name }}<span>{{ $item->created_at }}<span>({{ $item->typeRoom->name }})</span>
                                    </h4>
                                    <p>Real Price : {{ $item->price }} VND</p>
                                    <p>Discount : {{ $item->discount }}%</p>
                                     <p>Available : {{ $item->quantity_room }}</p>
                                    <p>{{ $item->description }}.</p>
                                    <a type="button" href="{{ Route('booking.room-detail', ['roomId' => $item->id]) }}"
                                        class="btn btn-info">Detail</a>
                                </div>
                                <br>
                            </li>
                            <br>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="sidebar-item comments">
                    <div class="sidebar-heading">
                        <h2>1 comments</h2>
                    </div>
                    <div class="content">
                        <ul>
                            <li>
                                <div class="author-thumb">
                                    <img src="assets/images/comment-author-01.jpg" alt="">
                                </div>
                                <div class="right-content">
                                    <h4>Charles Kate<span>May 16, 2020</span></h4>
                                    <p>Fusce ornare mollis eros. Duis et diam vitae justo fringilla
                                        condimentum eu quis leo. Vestibulum id turpis porttitor
                                        sapien facilisis scelerisque. Curabitur a nisl eu lacus
                                        convallis eleifend posuere id tellus.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="sidebar-item submit-comment">
                    <div class="sidebar-heading">
                        <h2>Your comment</h2>
                    </div>
                    <div class="content">
                        <form id="comment" action="#" method="post">
                            <div class="row">
                                <div class="col-lg-12">
                                    <fieldset>
                                        <textarea name="message" rows="6" id="message" placeholder="Type your comment" required=""></textarea>
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <button type="submit" id="form-submit" class="main-button">Submit</button>
                                    </fieldset>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
@endsection
