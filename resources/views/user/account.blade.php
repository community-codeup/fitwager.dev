@extends ('layouts.master')
@section('content')
    <br>

    <hr style="border-top: 2px solid #e0e0e0">

            <div class="container-fluid" style="margin-top: 5%; padding-bottom: 2%;">
                    <div class="row">
                        <div class="col-sm-3 text-center">
                                <img class="text-center img-responsive center-block" style="padding:1px; border:1px solid #021a40; width:200px;height:200px"; src="{{ $user->picture }}">

                                <br>
                                <h3>Coin Amount = {{ $user->coins }}</h3>
                        </div>
                        <div class="col-sm-2" style="border: 2px solid white"><h1>{{ $user->name }}</h1>
                            <ul style="list-style-type: none; padding: 0; margin: 0">
                                <li>User email : {{$user->email}}</li>
                                <li>Fitbit Id : {{ $user->fitbit_id }}</li>
                            </ul>
                        </div>
                        <div class="col-sm-3"></div>
                        <div class="col-sm-2" style="border: 2px solid white">
                            <h3>Upcoming Challenges</h3>
                            <ul style="list-style-type: none; padding: 0; margin: 0">
                                <li>challenge</li>
                            </ul>
                        </div>
                    </div>
            </div>

            <hr style="border-top: 2px solid #e0e0e0">

            <div class="container-fluid">
                <h1 class="text-center">Activity</h1>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12" style="padding: 0">
                        <div class="activity-inner">
                            <div class="item full-width-image-2">
                                <div class="slide">
                                    <div class="container-fluid overlay"></div>
                                </div>
                                <div class="hero">
                                    <hgroup style="border: 2px solid white">
                                        <h1>Enter Activity Here</h1>
                                        <h2>Coins coins coins</h2>
                                        <button class="btn btn-danger btn-lg" role="button">Click here</button>
                                    </hgroup>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection

