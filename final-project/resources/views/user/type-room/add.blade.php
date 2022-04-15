@extends('user.layouts.app')
@section('content')
    <div class="heading-page header-text">
        <section class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-content">
                            <h2>Request New Type Room</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <section class="contact-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="down-contact">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="sidebar-item contact-form">
                                    @if (Session::has('message'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                    <div class="sidebar-heading">
                                        <h2>Request New Type Room</h2>
                                    </div>
                                    <div class="content">
                                        <form id="contact"
                                            action="{{ route('user.type-rooms.store') }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <fieldset>
                                                        <label>Name</label>
                                                        <input name="name" type="text" value="{{ old('name') }}" placeholder="Name">
                                                    </fieldset>
                                                </div>
                                                @error('name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <input type="hidden" name="status" value="0"
                                                        class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group button">
                                                    <button type="submit" class="btn2"><a
                                                            class="btn1">REQUEST</a></button>
                                                    <a class="a-back"
                                                        href="{{ Route('user.homestays.index') }}">BACK
                                                    </a>
                                                </div>
                                            </div>
                                        </form>
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
