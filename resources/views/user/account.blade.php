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
            <h2 class="text-center">Daily Activity Log</h1>
                <div class="col-md-2" style="border: 1px solid grey; height: 300px; background-color: #424040">
                    <h3 style="color: #FF4A48">Total Steps</h3>
                    <ol style="font-size: medium">
                        <li style="color: #FF4A48"><span style="color: black">name1</li>
                    </ol>
                </div>
                  <div class="col-md-2" style="border: 1px solid grey; height: 300px; background-color: #424040">
                    <h3 style="color: #FF4A48">Distance Covered</h3>
                    <ol style="font-size: medium">
                        <li style="color: #FF4A48"><span style="color: black">name1</li>
                    </ol>
                </div>
                  <div class="col-md-2" style="border: 1px solid grey; height: 300px; background-color: #424040">
                    <h3 style="color: #FF4A48">Calories Burned</h3>
                    <ol style="font-size: medium">
                        <li style="color: #FF4A48"><span style="color: black">name1</li>
                    </ol>
                </div>
    </div>
</div>

<hr style="border-top: 2px solid #e0e0e0">
@endsection

