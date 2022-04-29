@extends('user.layouts.app')
@section('content')
    <script>
        $(document).ready(function() {
            var reply = [];
            var edit = []
            $('a#replyButton').on('click', function() {
                commentReplyId = $(this).closest('ul').find('input#parentId').val();
                reply[reply.length] = commentReplyId;
                reply.forEach(element => $('ul#reply-' + element).css('display', 'none'));
                $('ul#reply-' + commentReplyId).css('display', 'block');
                $('div#comment').css('display', 'none');
            });

            $('li.edit-parent-comment').on('click', function() {
                var commentId = $(this).closest('ul').find('input#commentId').val();
                $('ul#reply-' + commentId).css('display', 'none');
                $('p#content-' + commentId).css('display', 'none');
                $('div#edit-comment-' + commentId).css('display', 'block');
                $('ul#ul-' + commentId).css('margin-bottom', '70px');
            });
        });
    </script>
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
    <div class="blog-posts">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="all-blog-posts">
                        <div class="row">
                            @php
                                $images = json_decode($homestay->images);
                            @endphp
                            @foreach ($images as $item)
                                <div class="col-lg-6">
                                    <div class="blog-post">
                                        <div class="blog-thumb">
                                            <img src="{{ asset('storage/homestays/' . $item) }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="sidebar-item comments">
                <div class="content">
                    <ul>
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
                        @foreach ($rooms as $key => $item)
                            @php
                                $images = json_decode($rooms[$key]->images);
                            @endphp
                            <li>
                                <div class="author-thumb">
                                    <img src="{{ asset('storage/rooms/' . $images[0]) }}" alt="">
                                </div>
                                <div class="right-content">
                                    <h4>{{ $item->name }}<span>{{ $item->created_at }}<span>({{ $item->typeRoom->name }})</span>
                                    </h4>
                                    <p>Real Price : {{ number_format($item->price, 0, '', ',') }} VND</p>
                                    <p>Discount : {{ $item->discount }}%</p>
                                    <p>Available : {{ $item->quantity_room }}</p>
                                    <p>{{ $item->description }}.</p>
                                    <a type="button" href="{{ Route('booking.room-detail', ['roomId' => $item->id]) }}"
                                        class="btn btn-info">Detail</a>
                                </div>
                                <br>
                            </li>
                            <br>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="sidebar-item comments">
                    <div class="sidebar-heading">
                        <h2>{{ count($comments) }} comments</h2>
                    </div>
                    <div class="content">
                        @foreach ($comments as $item)
                            @if ($item->parent_id == 0)
                                <ul id="ul-{{ $item->id }}" style="margin-bottom: -26px; height: 100px;">
                                    <li>
                                        <div class="author-thumb">
                                            <img style="width: 100px; height: 100px;"
                                                src="{{ asset('storage/users/' . $item->user->avatar) }}" alt="">
                                        </div>
                                        <div class="right-content">
                                            <h4>{{ $item->user->name }}<span>{{ $item->user->updated_at->format('D m/Y') }}</span>
                                            </h4>
                                            <span class="action-comment"><i class="fas fa-ellipsis-h"></i>
                                                <div class="action-option">
                                                    <ul>
                                                        @if (Auth::id() == $item->user_id)
                                                            <li class="edit-parent-comment">Edit</li>
                                                            <input type="hidden" id="commentId" value={{ $item->id }}>
                                                            <form
                                                                action="{{ route('user.comment.delete', ['id' => $item->id]) }}"
                                                                method="post">
                                                                {{ csrf_field() }}
                                                                @method('delete')
                                                                <input type="hidden" name="userId"
                                                                    value={{ Auth::id() }}>
                                                                <button type="submit" class="li-delete">
                                                                    <li>Delete</li>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <li class="edit-parent-comment">Report</li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </span>
                                            <p id="content-{{ $item->id }}">{{ $item->content }}</p>
                                            <div style="display: none" class="mb-3"
                                                id="edit-comment-{{ $item->id }}">
                                                <form id="comment"
                                                    action="{{ route('user.comment.update', ['id' => $item->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <fieldset>
                                                                <input name="comment_id" type="hidden"
                                                                    value="{{ $item->id }}" />
                                                            </fieldset>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <fieldset>
                                                                <textarea style="text-transform: none;width: 100%;height: 70px;" name="content" style="text-transform: none;" rows="6"
                                                                    placeholder="Type your comment"
                                                                    required="">{{ $item->content }}</textarea>
                                                            </fieldset>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <fieldset>
                                                                <button type="submit" id="form-submit" style="display: inline-block;
                                                                                            background-color: #f48840;
                                                                                            color: #fff;
                                                                                            font-size: 13px;
                                                                                            font-weight: 500;
                                                                                            padding: 12px 20px;
                                                                                            text-transform: uppercase;
                                                                                            transition: all .3s;
                                                                                            border: none;"
                                                                    class="main-button">Edit
                                                                    Comment</button>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <ul id="reply-{{ $item->id }}" style="margin-bottom: 25px;">
                                    <div class="button" style="margin-left: 120px">
                                        <input type="hidden" id="parentId" value="{{ $item->id }}" />
                                        <a id="replyButton" class="btn">
                                            <i class="fa fa-reply" aria-hidden="true"></i>Reply
                                        </a>
                                    </div>
                                </ul>
                                @foreach ($comments as $item_child)
                                    @if ($item_child->parent_id == $item->id)
                                        <ul id="ul-{{ $item_child->id }}"
                                            style="margin: -20px 0px 35px 36px; height: 100px; padding-left:20px;/* margin-bottom: 25px; */">
                                            <li>
                                                <div class="author-thumb">
                                                    <img style="width: 100px; height: 100px;"
                                                        src="{{ asset('storage/users/' . $item_child->user->avatar) }}"
                                                        alt="">
                                                </div>
                                                <div class="right-content">
                                                    <h4>{{ $item_child->user->name }}<span>{{ $item_child->user->updated_at->format('D m/Y') }}</span>
                                                    </h4>
                                                    <span class="action-comment"><i class="fas fa-ellipsis-h"></i>
                                                        <div class="action-option">
                                                            <ul>
                                                                @if (Auth::id() == $item_child->user_id)
                                                                    <li class="edit-parent-comment">Edit</li>
                                                                    <input type="hidden" id="commentId"
                                                                        value={{ $item_child->id }}>
                                                                    <form
                                                                        action="{{ route('user.comment.delete', ['id' => $item_child->id]) }}"
                                                                        method="post">
                                                                        {{ csrf_field() }}
                                                                        @method('delete')
                                                                        <input type="hidden" name="userId"
                                                                            value={{ Auth::id() }}>
                                                                        <button type="submit" class="li-delete">
                                                                            <li>Delete</li>
                                                                        </button>
                                                                    </form>
                                                                @else
                                                                    <li class="edit-parent-comment">Report</li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </span>
                                                    <p id="content-{{ $item_child->id }}">{{ $item_child->content }}
                                                    </p>
                                                    <div style="display: none" class="mb-3"
                                                        id="edit-comment-{{ $item_child->id }}">
                                                        <form id="comment"
                                                            action="{{ route('user.comment.update', ['id' => $item_child->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <fieldset>
                                                                        <input name="comment_id" type="hidden"
                                                                            value="{{ $item_child->id }}" />
                                                                    </fieldset>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <fieldset>
                                                                        <textarea style="text-transform: none;width: 100%;height: 70px;" name="content" style="text-transform: none;" rows="6"
                                                                            placeholder="Type your comment"
                                                                            required="">{{ $item_child->content }}</textarea>
                                                                    </fieldset>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <fieldset>
                                                                        <button type="submit" id="form-submit" style="display: inline-block;
                                                                                            background-color: #f48840;
                                                                                            color: #fff;
                                                                                            font-size: 13px;
                                                                                            font-weight: 500;
                                                                                            padding: 12px 20px;
                                                                                            text-transform: uppercase;
                                                                                            transition: all .3s;
                                                                                            border: none;"
                                                                            class="main-button">Edit
                                                                            Comment</button>
                                                                    </fieldset>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    @endif
                                @endforeach
                                <ul id="reply-{{ $item->id }}" style="display: none;margin-bottom: 10px;">
                                    <div class="sidebar-item submit-comment">
                                        <div class="sidebar-heading">
                                            <h2>Reply comment</h2>
                                        </div>
                                        <div class="content">
                                            <form id="comment" action="{{ route('user.comment.store') }}" method="post">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <fieldset>
                                                            <input name="homestay_id" type="hidden"
                                                                value="{{ $homestay->id }}" id="homestay_id" />
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <fieldset>
                                                            <input name="parent_id" type="hidden"
                                                                value="{{ $item->id }}" id="parent_id" />
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <fieldset>
                                                            <textarea name="content" style="text-transform: none;" rows="6" @if (Auth::check()) placeholder="Type your comment" @else placeholder="Login for comment" @endif
                                                                required=""></textarea>
                                                        </fieldset>
                                                    </div>
                                                    @if (Auth::check())
                                                        <div class="col-lg-12">
                                                            <fieldset>
                                                                <button type="submit" id="form-submit"
                                                                    class="main-button">Reply Comment</button>
                                                            </fieldset>
                                                        </div>
                                                    @endif
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </ul>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div id="comment" class="col-lg-12">
                <div class="sidebar-item submit-comment">
                    <div class="sidebar-heading">
                        <h2>Your comment</h2>
                    </div>
                    <div class="content">
                        <form id="comment" action="{{ route('user.comment.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <fieldset>
                                        <input name="homestay_id" type="hidden" value="{{ $homestay->id }}"
                                            id="homestay_id" />
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <input name="parent_id" type="hidden" value="0" id="parent_id" />
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <textarea name="content" style="text-transform: none;" rows="6"
                                            @if (Auth::check()) placeholder="Type your comment" @else placeholder="Login for comment" @endif
                                            required=""></textarea>
                                    </fieldset>
                                </div>
                                @if (Auth::check())
                                    <div class="col-lg-12">
                                        <fieldset>
                                            <button type="submit" id="form-submit" class="main-button">Comment</button>
                                        </fieldset>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
@endsection
