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
                                            <a
                                                href="{{ Route('user.homestays.show', ['id' => $item->id]) }}">
                                                <h4>{{ $item->name }}</h4>
                                            </a>
                                            <ul class="post-info">
                                                <li>John Doe</li>
                                                <li><a
                                                        href="{{ Route('user.homestays.show', ['id' => $item->id]) }}">{{ $item->address }}</a>
                                                </li>
                                                <li><a
                                                        href="{{ Route('user.homestays.show', ['id' => $item->id]) }}"><i
                                                            class="fa fa-comments" title="Comments"></i> 12</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('css')
@endsection
