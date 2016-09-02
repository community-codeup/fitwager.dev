@extends ('layouts.master')
@section('content')
    <br>
    <hr>
            <div class="container-fluid" style="margin-top: 5%; padding-bottom: 2%;">
                    <div class="row">
                        <div class="col-sm-3 text-center">
                                <img class="text-center img-responsive center-block" style="padding:1px; border:1px solid #021a40; width:200px;height:200px"; img src="http://placehold.it/200x200">

                                <br>
                                <a href="#">Edit Profile</a>
                                <h3>Coin Amount = {{ $user->coins }}</h3>
                        </div>
                        <div class="col-sm-2" style="border: 2px solid white"><h1>Users Name</h1>
                            <ul style="list-style-type: none; padding: 0; margin: 0">
                                <li>Email</li>
                                <li>Phone Number</li>
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
            <hr>

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

