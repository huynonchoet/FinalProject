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
    <section class="blog-posts grid-system">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="all-blog-posts">
                        <div class="row">
                            @foreach ($homestay as $key => $item)
                                @php
                                    $images = json_decode($homestay[$key]->images);
                                @endphp
                                <div class="col-lg-6">
                                    <div class="blog-post">
                                        <div class="blog-thumb">
                                            <img src="{{ asset('storage/homestays/' . $images[0]) }}" alt="">
                                        </div>
                                        <div class="down-content">
                                            <a href="{{ Route('user.homestays.show', ['id' => $item->id]) }}">
                                                <h4>{{ $item->name }}</h4>
                                            </a>
                                            <ul class="post-info">
                                                <li>John Doe</li>
                                                <li>{{ $item->address }}</li>
                                                <li><i class="fa fa-comments" title="Comments"></i> 12</li>
                                            </ul>
                                            <div class="add-room">
                                                <a type="button"
                                                    href="{{ Route('user.homestays.show', ['id' => $item->id]) }}"
                                                    style="color:aliceblue" class="btn btn-success">Show Detail</a>
                                                <a type="button"
                                                    href="{{ Route('user.homestays.edit', ['id' => $item->id]) }}"
                                                    style="color:aliceblue" class="btn btn-success">Update Information</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="add-room">
                        <a type="button" href="{{ Route('user.homestays.create') }}" style="color:aliceblue"
                            class="btn btn-success">Add New Homestay</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('css')
@endsection
