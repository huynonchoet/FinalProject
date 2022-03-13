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
                                    <p>Real Price : {{ $item->price }}VNĐ.</p>
                                    <p>Quantity : {{ $item->quantity_room }}.</p>
                                    <p>Discount : {{ $item->discount }}.</p>
                                    <p>{{ $item->description }}.</p>
                                    <a type="button"
                                        href="{{ Route('user.homestays.rooms.edit', ['roomId' => $item->id]) }}"
                                        class="btn btn-info">Detail</a>
                                    <form action="{{ route('user.homestays.rooms.destroy', ['roomId' => $item->id]) }}"
                                        method="post">
                                        {{ csrf_field() }}
                                        @method('delete')
                                        <button type="submit" style="margin-top: -63px;margin-left: 78px;"
                                            class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                                <br>
                            </li>
                            <br>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="add-room">
                <a type="button" href="{{ Route('user.homestays.rooms.create', ['homestayId' => $homestay->id]) }}"
                    style="color:aliceblue" class="btn btn-success">Add New Room</a>
                <a type="button" href="{{ Route('user.homestays.index') }}" style="color:aliceblue"
                    class="btn btn-success">Back List Homestay</a>
            </div>
        </div>
    </div>
@endsection
@section('css')
@endsection
