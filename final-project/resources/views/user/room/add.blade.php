@extends('user.layouts.app')
@section('content')
    <div class="heading-page header-text">
        <section class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-content">
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
                                        <h2>Create New Room</h2>
                                    </div>
                                    <div class="content">
                                        <form id="contact" action="{{ route('register.create') }}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <fieldset>
                                                        <input name="name" type="text" placeholder="Name">
                                                    </fieldset>
                                                </div>
                                                @error('name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="col-md-12 col-sm-12">
                                                    <fieldset>
                                                        <input name="price" type="text" placeholder="Price">
                                                    </fieldset>
                                                </div>
                                                @error('price')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="col-md-12 col-sm-12">
                                                    <fieldset>
                                                        <textarea rows="9" cols="70" name="description"
                                                            placeholder="Description"></textarea>
                                                    </fieldset>
                                                </div>
                                                @error('description')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="col-md-12 col-sm-12">
                                                    <fieldset>
                                                        <input name="discount" type="text" placeholder="Discount">
                                                    </fieldset>
                                                </div>
                                                @error('discount')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="col-md-12 col-sm-12">
                                                    <fieldset>
                                                        <input name="quantity_room" type="text" placeholder="Quantity room">
                                                    </fieldset>
                                                </div>
                                                @error('quantity_room')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="col-md-12 col-sm-12">
                                                    <fieldset>
                                                        <input name="quantity_room" type="text" placeholder="Quantity room">
                                                    </fieldset>
                                                </div>
                                                @error('quantity_room')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="col-lg-12">
                                                    <fieldset>
                                                        <select name="homestay">
                                                            <option>Select Your Homestay
                                                            </option>
                                                            @foreach ($homestays as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </fieldset>
                                                </div>
                                                @error('homestay')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
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
