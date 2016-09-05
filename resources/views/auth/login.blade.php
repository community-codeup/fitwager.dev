@extends ('layouts.master')

@section('content')
    <div id="login-background">
                <div class='row'>
                    <div class="col-md-12 text-center" id="header">
                        <h1 style="font-size: 55px; color: whitesmoke; font-weight: bold">FIT<span style="color: limegreen">WAGER</span></h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary btn-lg" href="/auth/fitbit">Log in to FitBit</button>
                    </div>
                </div>
    </div>

@endsection

