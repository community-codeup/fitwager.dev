@extends ('layouts.master')

@section('content')
<<<<<<< HEAD
    <body background="/img/night2.jpg" style="background-color: black;
      webkit-background-size: cover; moz-background-size: cover; o-background-size: cover; background-size: cover">
        <div class="container" id="form" style="margin-top: 5%; padding-bottom: 2%;">
            <form method="POST" action="{{ action('Auth\AuthController@postLogin') }}">
                <div class='row'>
                    <div class="col-md-12 text-center" id="header">
                        <h1 style="font-size: 55px; color: whitesmoke; font-weight: bold; text-decoration: underline">FIT<span style="color: limegreen">WAGER</span></h1><br>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary btn-lg">Log in to FitBit</button>
                        <a href="/auth/fitbit">Signin</a>
                    </div>
                </div>

        </div>
    </body>

@endsection

