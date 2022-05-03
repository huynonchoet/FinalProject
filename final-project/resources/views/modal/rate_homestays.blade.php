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
            <h2>Your Rate</h2>
        </div>
        <div class="content">
            <div class="stars">
                <form action="{{ route('user.homestays.create.rate', ['id' => $homestay->id]) }}" method="post">
                    @csrf
                    @for ($i = 5; $i >= 1; $i--)
                        <input class="star star-{{ $i }}" id="star-{{ $i }}"
                            value={{ $i }} type="radio" name="star" />
                        <input value={{$bookingDetail->id}} type="hidden" name="bookingDetails_id" />
                        <label class="star star-{{ $i }}" for="star-{{ $i }}"></label>
                    @endfor
                    <br>
                    <br>
                    <br>
                    @if (Auth::check())
                        <div class="col-lg-12">
                            <fieldset>
                                <button type="submit" id="form-submit" class="main-button">Rate</button>
                            </fieldset>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
