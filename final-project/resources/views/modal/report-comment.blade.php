<div class="d-flex">
    <div class="author-thumb">
        <img style="width: 100px; height: 100px;" src="{{ asset('storage/users/' . $comment->user->avatar) }}" alt="">
    </div>
    <div class="right-content ml-2 mt-2">
        <h4>{{ $comment->user->name }}<span>{{ $comment->user->updated_at->format('D m/Y') }}</span>
        </h4>
        <p id="content-{{ $comment->id }}">{{ $comment->content }}
        </p>
    </div>
</div>
<div id="comment" style="width: 470px;">
    <div class="sidebar-item submit-comment">
        <div class="sidebar-heading">
            <h2>Your Report</h2>
        </div>
        <div class="content">
            <form id="comment" action="{{ route('user.comment.create.report', ['id' => $comment->id]) }}"
                method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <fieldset>
                            <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                        </fieldset>
                    </div>
                    <div class="col-lg-12">
                        <fieldset>
                            <textarea class="w-100" name="content" style="text-transform: none;" rows="6"
                                @if (Auth::check()) placeholder="Why you report?" @else placeholder="Login For Report" @endif
                                required=""></textarea>
                        </fieldset>
                    </div>
                    @if (Auth::check())
                        <div class="col-lg-12">
                            <fieldset>
                                <button type="submit" id="form-submit" class="main-button">Report</button>
                            </fieldset>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
