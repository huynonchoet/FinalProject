@extends('user.layouts.app')
@section('content')
    <script type="text/javascript">
        /**
         * Show multiple image when choose image
         */
        $(document).ready(function() {
            $('#multiple-image').change(function(event) {
                var files = event.target.files;
                console.log(files);
                var result = $("#showImage");
                result.empty();
                $.each(files, function(i, file) {
                    var imgpath = URL.createObjectURL(file);
                    result.add(
                        "<img class='new-image' style='height: 120px;width: 200px; margin-left:30px;' src='" +
                        imgpath + "'>").appendTo(
                        '#showImage');
                });
            });

            /**
             * remove image when click button remove image
             */
            $('.btn-remove-img').bind('click', function(e) {
                var dataProduct = $(this).data('product');
                var dataIndex = $(this).data('index');
                var img_item = $(this).parent();
                $('#checkbox-image-' + dataProduct + '-' + dataIndex).attr('checked', true);
                console.log($('#checkbox-image-' + dataProduct + '-' + dataIndex));
                img_item.remove()
            });
        });
    </script>

    <div class="heading-page header-text">
        <section class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-content">
                            <h2>Update Information Your Homestay</h2>
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
                                    <div class="sidebar-heading">
                                        <h2>Update Information Your Homestay</h2>
                                    </div>
                                    <div class="content">
                                        <form id="contact"
                                            action="{{ route('user.homestays.update', ['id' => $homestay->id]) }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <fieldset>
                                                        <label>Name Homestay</label>
                                                        <input name="name" type="text" placeholder="Name"
                                                            value="{{ $homestay->name }}">
                                                    </fieldset>
                                                </div>
                                                @error('name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="col-md-12 col-sm-12">
                                                    <fieldset>
                                                        <div class="form-group">
                                                            <label>Image</label>
                                                            <input id="multiple-image" type="file" name="imageNew[]"
                                                                multiple="multiple">
                                                        </div>
                                                        <div id="showImage" class="mt-20">
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                @error('imageNew')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                @error('imageNew.*')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="col-md-12 col-sm-12">
                                                    <fieldset>
                                                        @if ($homestay->images)
                                                            <div class="col-12">
                                                                <label>Old Image</label>
                                                                <table class="table">
                                                                    <tr>
                                                                        @php
                                                                            $homestay->images = json_decode($homestay->images);
                                                                        @endphp
                                                                        @foreach ($homestay->images as $item)
                                                                            <th id="table-old-image">
                                                                                <div id="old-img-{{ $homestay->id }}"
                                                                                    class="mt-20">
                                                                                    <img class='image-room'
                                                                                        src="{{ asset('storage/homestays/' . $item) }}"
                                                                                        alt="">
                                                                                </div>
                                                                            </th>
                                                                        @endforeach
                                                                    </tr>
                                                                    <tr id="tr-old-image">
                                                                        @foreach ($homestay->images as $item)
                                                                            <td id="table-old-image">
                                                                                <input
                                                                                    id="checkbox-image-{{ $homestay->id }}-{{ $loop->index }}"
                                                                                    class="checkbox"
                                                                                    name="imageDelete[]" type="checkbox"
                                                                                    value="{{ $item }}">
                                                                            </td>
                                                                        @endforeach
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        @endif
                                                    </fieldset>
                                                </div>
                                                @error('image')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                @error('image.*')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="col-md-12 col-sm-12">
                                                    <fieldset>
                                                        <label>Address</label>
                                                        <input name="address" type="text" placeholder="Address"
                                                            value="{{ $homestay->address }}">
                                                    </fieldset>
                                                </div>
                                                @error('address')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="col-md-12 col-sm-12">
                                                    <fieldset>
                                                        <label>Phone</label>
                                                        <input name="phone" type="text" placeholder="Phone"
                                                            value="{{ $homestay->phone }}">
                                                    </fieldset>
                                                </div>
                                                @error('phone')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group button">
                                                    <button type="submit" class="btn2"><a
                                                            class="btn1">CREATE</a></button>
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
