@extends('admin.layouts.app')
@section('content')
    <section class="blog-posts grid-system">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="all-blog-posts">
                        <div class="row">
                            <div class="signup-form">
                                <!--sign up form-->
                                <h2 class="nav-link">Update Tax</h2>
                                @if (session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
                                <form action="{{ route('admin.taxs.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">From</label>
                                        <div class="col-md-12">
                                            <input type="date" value="{{ old('day_start') }}" name="day_start" class="form-control form-control-line">
                                        </div>
                                        @error('day_start')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">To</label>
                                        <div class="col-md-12">
                                            <input type="date" value="{{ old('end_day') }}" name="end_day" class="form-control form-control-line">
                                        </div>
                                        @error('end_day')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Tax</label>
                                        <div class="col-md-12">
                                            <input type="text" value="{{ old('tax') }}" name="tax" class="form-control form-control-line">
                                        </div>
                                        @error('tax')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>                                   
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="hidden" name="status" value="1"
                                                class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button name="submit" type="submit" class="btn btn-success">Update Tax</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--/sign up form-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
