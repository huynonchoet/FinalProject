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
                                <h2 class="nav-link">Add Type Room</h2>
                                @if (session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
                                <form action="{{ route('admin.type-rooms.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Name</label>
                                        <div class="col-md-12">
                                            <input type="text" name="name" class="form-control form-control-line">
                                        </div>
                                        @error('name')
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
                                            <button name="submit" type="submit" class="btn btn-success">Add Admin</button>
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
