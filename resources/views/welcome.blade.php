

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
                            <h1 style="color: white">we are <h1><img src="/img/logo14.png"></h1></h1>
                            <h3>challenge your fitbit friends today</h3>
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
                            <h1>start earning <span style="color: #00d053">wager</span> coins today</h1>
                        </hgroup>
                        <a href="/about" class="btn btn-hero btn-lg" role="button">Click for More Info</a>
                    </div>
                </div>
                <div class="item slides">
                    <div class="slide-3">
                        <div class="overlay"></div>
                    </div>
                    <div class="hero">
                        <hgroup>
                            <h1><span style="color: #00d053">log in</span> to your fitbit account here</h1>
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

                            <div class="col-md-4" style="border: 1px solid grey; height: 300px; background-color: #424040">
                                <h3 style="color: #00d053">Coins Leaders</h3>
                                        <ol style="font-size: medium">
                                            @foreach($userCoins as $userCoin)
                                            <li style="color: #00d053"><span style="color: white">{{$userCoin->name}} {{$userCoin->coins}}</span></li>
                                            @endforeach
                                        </ol>       
                            </div>
                          <div class="col-md-4" style="border: 1px solid grey; height: 300px; background-color: #424040">
                                <h3 style="color: #00d053">Challenges Won</h3>
                                        <ol style="font-size: medium">
                                            @foreach($challengesWon as $challenger)
                                             <li style="color: #00d053"><span style="color: black">{{$challenger->status}}</span></li>
                                            @endforeach
                                        </ol>       
                            </div>
                           <div class="col-md-4" style="border: 1px solid grey; height: 300px; background-color: #424040">
                                <h3 style="color: #00d053">Coins Leaders</h3>
                                        <ol style="font-size: medium">
                                            @foreach($userCoins as $userCoin)
                                            <li style="color: #00d053"><span style="color: white">{{$userCoin->name}} {{$userCoin->coins}}</span></li>
                                            @endforeach
                                        </ol>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
