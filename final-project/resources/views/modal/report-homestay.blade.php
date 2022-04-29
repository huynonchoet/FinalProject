<section class="blog-posts grid-system">
    <div class="container">
        <div class="all-blog-posts">
            <h2 class="text-center">{{ $homestay->name }}</h2>
            <br>
            <div class="row" style="width: 1400px;">
                @php
                    $images = json_decode($homestay->images);
                @endphp
                <div class="col-md-4 col-sm-6">
                    <div class="blog-post">
                        <div class="blog-thumb">
                            <img src="{{ asset('storage/homestays/' . $images['0']) }}" alt="">
                        </div>
                        <div class="down-content">
                            <span> {{ $homestay->name }} </span>
                            <a href="vacations.html">
                                <h4>{{ $homestay->phone }}</h4>
                            </a>
                            <p>{{ $homestay->address }}</p>
                            <div class="post-options">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <ul class="post-tags">
                                            <li><i class="fa fa-bullseye"></i></li>
                                            <li><a
                                                    href="{{ route('booking.index', ['homestayId' => $homestay->id]) }}">View
                                                    Homestay
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="comment" style="width: 470px;">
    <div class="sidebar-item submit-comment">
        <div class="sidebar-heading">
            <h2>Your Report</h2>
        </div>
        <div class="content">
            <form id="comment" action="{{ route('user.homestays.create.report', ['id' => $homestay->id]) }}"
                method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <fieldset>
                            <input type="hidden" name="homestay_id" value="{{ $homestay->id }}" />
                        </fieldset>
                    </div>
                    <div class="col-lg-12">
                        <fieldset>
                            <textarea class="w-100" name="content" style="text-transform: none;" rows="6"
                                @if (Auth::check()) placeholder="Why you report?" @else placeholder="Login for Report" @endif
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
