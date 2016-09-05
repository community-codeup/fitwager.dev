@extends ('layouts.master')

@section('content')


    <body background="/img/night1.jpg" style="background-color: black;
      webkit-background-size: cover; moz-background-size: cover; o-background-size: cover; background-size: cover">
    <div class="container" id="form" style="margin-top: 5%; padding-bottom: 2%;">
        <form method="POST" action="{{ action('Auth\AuthController@postLogin') }}">
            <div class='row'>
                <div class="col-md-3 text-center" id="header">
                    <h1 style="font-size: 55px; color: whitesmoke; font-weight: bold; text-decoration: underline">STEP 1</h1><br>
                    <div class="form-group row">
                        <input class='form-control' type="text" name="email" id="email" placeholder="email"  value="{{ old('email') }}" autofocus>
                        <br>
                        <input class='form-control' type="password" name="password" id="password" placeholder="password" value="{{ old('password') }}">
                    </div>
                </div>
                <div class="col-md-5"></div>
                <div class="col-md-4">
                    <h1>What We Do</h1>
                </div>
            </div>


            <br>
            <div class="row">
                <div class="col-sm-offset-5 col-sm-7">
                    <button type="submit" class="btn btn-primary btn-lg">Login</button>
                </div>
            </div>

        </form>
    </div>
    </body>
@endsection