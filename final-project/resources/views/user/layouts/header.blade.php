<header class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <h2>Your Homestay Website<em>.</em></h2>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <form id="search" action="{{ route('home') }}" method="GET">
                <div class="input-group">
                    <input name="search" type="text" class="form-control bg-light border-0 small"
                        placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ Route('home') }}">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    @if (Auth::check())
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                aria-haspopup="true" aria-expanded="false">My Homestay</a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="{{ Route('user.booking-landlords.index') }}">Booking order</a></li>
                                <li><a class="dropdown-item" href="{{ Route('user.type-rooms.request') }}">Request Type Room</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                aria-haspopup="true" aria-expanded="false">My booking</a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li>
                                    <a class="dropdown-item" href="{{ route('booking.test') }}">Booking</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('booking.history') }}">Booking
                                        History</a>
                                </li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                aria-haspopup="true" aria-expanded="false">Profile</a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="{{ Route('user.account.index') }}">My
                                        Account</a></li>
                                <li><a class="dropdown-item" href="{{ Route('user.homestays.index') }}">My
                                        Homestay</a></li>
                            </ul>
                        </div>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ Route('logout') }}">Logout</a>
                        </li>
                    @endif
                    @if (!Auth::check())
                        <li><a class="nav-link" href="{{ Route('login') }}">Login</a></li>
                        <li><a class="nav-link" href="{{ Route('register.index') }}">Register</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
