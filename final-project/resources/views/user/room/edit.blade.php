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
                        "<img class='new-image image-room' src='" +
                        imgpath + "'>").appendTo(
                        '#showImage');
                });
            });
        });
    </script>

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
                                        <h2>Edit Infor Room</h2>
                                    </div>
                                    <div class="content">
                                        <form id="contact"
                                            action="{{ route('user.homestays.rooms.update', ['roomId' => $room->id]) }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <fieldset>
                                                        <label>Name Room</label>
                                                        <input name="name" type="text" placeholder="Name"
                                                            value="{{ $room->name }}">
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
                                                        @if ($room->images)
                                                        <div class="col-12">
                                                            <label>Old Image</label>
                                                            <table class="table">
                                                                <tr>
                                                                    @php
                                                                        $room->images = json_decode($room->images);
                                                                    @endphp
                                                                    @foreach ($room->images as $item)
                                                                        <th id="table-old-image">
                                                                            <div id="old-img-{{ $room->id }}"
                                                                                class="mt-20">
                                                                                <img class='image-room'
                                                                                    src="{{ asset('storage/rooms/' . $item) }}"
                                                                                    alt="">
                                                                            </div>
                                                                        </th>
                                                                    @endforeach
                                                                </tr>
                                                                <tr id="tr-old-image">
                                                                    @foreach ($room->images as $item)
                                                                        <td id="table-old-image">
                                                                            <input
                                                                                id="checkbox-image-{{ $room->id }}-{{ $loop->index }}"
                                                                                class="checkbox" name="imageDelete[]"
                                                                                type="checkbox" value="{{ $item }}">
                                                                        </td>
                                                                    @endforeach
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    @endif
                                                    </fieldset>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <fieldset>
                                                        <label>Price</label>
                                                        <input name="price" type="text" placeholder="Price (VNĐ)"
                                                            value="{{ $room->price }}">
                                                    </fieldset>
                                                </div>
                                                @error('price')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="col-md-12 col-sm-12">
                                                    <fieldset>
                                                        <label>Description</label>
                                                        <textarea rows="9" cols="70" name="description"
                                                            placeholder="Description">{{ $room->description }}</textarea>
                                                    </fieldset>
                                                </div>
                                                @error('description')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="col-md-12 col-sm-12">
                                                    <fieldset>
                                                        <label>Discount(%)</label>
                                                        <input name="discount" value="0" type="text" placeholder="Discount"
                                                            value="{{ $room->discount }}">
                                                    </fieldset>
                                                </div>
                                                @error('discount')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="col-md-12 col-sm-12">
                                                    <fieldset>
                                                        <label>Quantity</label>
                                                        <input name="quantity_room" type="text" placeholder="Quantity room"
                                                            value="{{ $room->quantity_room }}">
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
                                                                <option value="{{ $item->id }}"
                                                                    {{ $item->id == $room->type_room_id ? 'selected' : '' }}>
                                                                    {{ $item->name }}
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
                                                            class="btn1">UPDATE</a></button>
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
