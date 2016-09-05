

    @extends ('layouts.master')

    @section('content')


        {{-- BEGINNING OF PAGINATION --}}

        <div class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
            <!-- Overlay -->

            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#bs-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#bs-carousel" data-slide-to="1"></li>
                <li data-target="#bs-carousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item slides active">
                    <div class="slide-1">
                        <div class="overlay"></div>
                    </div>
                    <div class="hero">
                        <hgroup>
                            <h1>We are Fit<span style="color: limegreen">Wager</span></h1>
                            <h3>Challenge Others In Your Area Today</h3>
                        </hgroup>
                        <a href="auth/fitbit" class="btn btn-hero btn-lg" href="/auth/fitbit" role="button">Begin Now</a>
                    </div>
                </div>
                <div class="item slides">
                    <div class="slide-2">
                        <div class="overlay"></div>
                    </div>
                    <div class="hero">
                        <hgroup>
                            <h1>Start Earning Wager Coins Today</h1>
                        </hgroup>
                        <button class="btn btn-hero btn-lg" role="button">Click for More Info</button>
                    </div>
                </div>
                <div class="item slides">
                    <div class="slide-3">
                        <div class="overlay"></div>
                    </div>
                    <div class="hero">
                        <hgroup>
                            <h1>Log in to Your FitBit Account Here</h1>
                        </hgroup>
                        <a href="auth/fitbit" class="btn btn-hero btn-lg" role="button">Log In</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- END OF PAGINATION --}}

        {{-- START LEADERBOARD COLUMNS --}}


        {{--example--}}
        <div class="container-fluid">
            <div class="row">
                <div class="container-fluid text-center"><h1>LEADERBOARD</h1></div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div id="page-wrap">
                    <div class="col-md-12 five-columns group" style="padding-top: -1%">
                        <div class="row" style="border: 1px solid grey;">
                            <div class="col-md-4" style="border: 1px solid grey; height: 300px; background-color: lightgray"><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p></div>
                            <div class="col-md-4" style="border: 1px solid grey; height: 300px; background-color: darkgrey"><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p></div>
                            <div class="col-md-4" style="border: 1px solid grey; height: 300px; background-color: lightgrey"><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
