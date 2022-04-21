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
                                        <h2>Create New Room</h2>
                                    </div>
                                    <div class="content">
                                        <form id="contact"
                                            action="{{ route('user.homestays.rooms.store', ['homestayId' => $homestay->id]) }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <fieldset>
                                                        <label>Name Room</label>
                                                        <input name="name" value="{{ old('name') }}" type="text" placeholder="Name">
                                                    </fieldset>
                                                </div>
                                                @error('name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="col-md-12 col-sm-12">
                                                    <fieldset>
                                                        <div class="form-group">
                                                            <label>Image<span>*</span></label>
                                                            <input id="multiple-image" type="file" name="image[]"
                                                                multiple="multiple">
                                                        </div>
                                                        <div id="showImage" class="mt-20">
                                                        </div>
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
                                                        <label>Price</label>
                                                        <input name="price" value="{{ old('price') }}" type="text" placeholder="Price (VNĐ)">
                                                    </fieldset>
                                                </div>
                                                @error('price')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="col-md-12 col-sm-12">
                                                    <fieldset>
                                                        <label>Description</label>
                                                        <textarea rows="9" cols="70" name="description"
                                                            placeholder="Description">{{ old('description') }}</textarea>
                                                    </fieldset>
                                                </div>
                                                @error('description')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="col-md-12 col-sm-12">
                                                    <fieldset>
                                                        <label>Discount</label>
                                                        <input name="discount" value="{{ old('discount') }}" value="0" type="text" placeholder="Discount">
                                                    </fieldset>
                                                </div>
                                                @error('discount')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="col-md-12 col-sm-12">
                                                    <fieldset>
                                                        <label>Quantity</label>
                                                        <input name="quantity_room" value="{{ old('quantity_room') }}" type="text" placeholder="Quantity room">
                                                    </fieldset>
                                                </div>
                                                @error('quantity_room')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="col-lg-12">
                                                    <fieldset>
                                                        <select name="typeroom">
                                                            <option>Select Your Type Room
                                                            </option>
                                                            @foreach ($typeRooms as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </fieldset>
                                                </div>
                                                @error('typeroom_id')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group button">
                                                    <button type="submit" class="btn2"><a
                                                            class="btn1">CREATE</a></button>
                                                    <a class="a-back"
                                                        href="{{ Route('user.homestays.show', ['id' => $homestay->id]) }}">BACK
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
