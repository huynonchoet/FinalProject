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
                                <h2 class="nav-link">Add User</h2>
                                @if (session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
                                <form action="{{ route('admin.users.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input type="text" name="email" value="" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class=" form-group">
                                        <label class="col-md-12">Full Name</label>
                                        <div class="col-md-12">
                                            <input type="text" name="name" value="" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Password</label>
                                        <div class="col-md-12">
                                            <input type="password" name="password" value=""
                                                class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Confirm Password</label>
                                        <div class="col-md-12">
                                            <input type="password" name="password_confirmation" value=""
                                                class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Role</label>
                                        <div class="col-md-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="role"
                                                    id="exampleRadios1" value="1" checked>
                                                <label class="form-check-label">
                                                    Admin
                                                </label>
                                                <input class="form-check-input" type="radio" name="role"
                                                    id="exampleRadios2" value="0" style="margin-left: 15px;">
                                                <label class="form-check-label" style="margin-left: 32px;">
                                                    User
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        @if ($errors->any())
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button name="submit" type="submit" class="btn btn-success">Add User</button>
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
