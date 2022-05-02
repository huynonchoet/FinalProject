@extends('admin.layouts.app')
@section('content')
    <div>
        <p class="h2 ml-2">List Report Comment</p>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
    </div>
    @foreach ($comments as $item)
        @if (count($item->report) > 0)
            <div class="border border-5 p-1 m-2 text-dark">
                <div class="border-0 rounded-3 p-3 m-2 text-dark" style="background-color: #CCCCFF">
                    <div class="d-flex">
                        <div class="author-thumb ">
                            <img class="rounded-circle" style="width: 100px; height: 100px;"
                                src="{{ asset('storage/users/' . $item->user->avatar) }}" alt="">
                        </div>
                        <div class="right-content ml-2 mt-2">
                            <h4>{{ $item->user->name }}
                            </h4>
                            @if ($item->updated_at)
                                <span>{{ $item->updated_at->format('D d/m/Y') }}</span>
                            @else
                                <span>Mon 25/04/2022</span>
                            @endif
                            <p id="content-{{ $item->id }}">{{ $item->content }}
                            </p>
                            <div class="d-flex">
                                <form action="{{ route('admin.reports.comments.handle', ['id' => $item->id]) }}"
                                    method="post">
                                    @csrf
                                    <button class="btn btn-danger" type="submit">BLOCK USER</button>
                                </form>
                                <form action="{{ route('admin.reports.comments.block', ['id' => $item->id]) }}"
                                    method="post">
                                    @csrf
                                    <button class="btn btn-warning ml-3" type="submit">BLOCK COMMENT</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($item->report as $item_child)
                    <div class="d-flex ml-4 p-2 mb-1">
                        <div class="author-thumb">
                            <img class="rounded-circle" style="width: 100px; height: 100px;"
                                src="{{ asset('storage/users/' . $item_child->user->avatar) }}" alt="">
                        </div>
                        <div class="right-content ml-2 mt-2">
                            <h4>{{ $item_child->user->name }}
                            </h4>
                            @if ($item_child->updated_at)
                                <span>{{ $item_child->updated_at->format('D d/m/Y') }}</span>
                            @else
                                <span>Mon 25/04/2022</span>
                            @endif
                            <p id="content-{{ $item_child->id }}">{{ $item_child->content }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endforeach
@endsection
@section('js')
@endsection
