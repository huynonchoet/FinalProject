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
                                    <p>{{ $item->description }}.</p>
                                    <a type="button" href="{{ Route('user.homestays.rooms.edit', ['id' => $item->id]) }}"
                                        class="btn btn-info">Detail</a>
                                    <a type="button" style="color:aliceblue" class="btn btn-danger">Delete</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="add-room">
                <a type="button" href="{{ Route('user.homestays.rooms.create', ['homestayId' => $homestay->id]) }}" style="color:aliceblue" class="btn btn-success">Add Room</a>
            </div>
        </div>
    </div>
@endsection
@section('css')
@endsection
