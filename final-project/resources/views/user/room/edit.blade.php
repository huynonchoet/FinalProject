@extends('user.layouts.app')
@section('content')
    <div class="heading-page header-text">
        <section class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-content">
                            <h4>{{ $room->name }}</h4>
                            <h2>{{ $homestay->name }}</h2>
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
                                    @if (session()->has('success'))
                                        <div class="alert alert-success">
                                            {{ session()->get('success') }}
                                        </div>
                                    @endif
                                    <div class="sidebar-heading">
                                        <h2>Edit Rooms</h2>
                                    </div>
                                    <div class="content">
                                        <form id="contact" action="{{ route('register.create') }}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <fieldset>
                                                        <input name="email" type="text" placeholder="Email">
                                                    </fieldset>
                                                </div>
                                                @error('email')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="col-md-12 col-sm-12">
                                                    <fieldset>
                                                        <input name="name" type="text" placeholder="name">
                                                    </fieldset>
                                                </div>
                                                @error('name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="col-md-12 col-sm-12">
                                                    <fieldset>
                                                        <input name="password" type="password" placeholder="Password">
                                                    </fieldset>
                                                </div>
                                                @error('password')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="col-md-12 col-sm-12">
                                                    <fieldset>
                                                        <input name="password_confirmation" type="password"
                                                            placeholder="Confirm password">
                                                    </fieldset>
                                                </div>
                                                @error('password_confirmation')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="col-lg-12">
                                                    <fieldset>
                                                        <button type="submit" id="form-submit"
                                                            class="main-button">Register</button>
                                                    </fieldset>
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
