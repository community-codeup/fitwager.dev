@extends ('layouts.master')
@section ('content')
    <br>

    <hr style="border-top: 2px solid #e0e0e0">

    <div class="container-fluid" style="margin-top: 5%; padding-bottom: 2%;">
        <div class="row">
            <div class="col-md-12 text-center" style="padding-left: 3%">
                <div style="border: 2px solid #00d053; border-radius: 2%;">
                    <label for="created_by" class="control-label results"><h3>created by: </h3><h4>{{$challenge->user->name}}</h4></label>
                    <label for="bet_type" class="control-label results"><h3>bet type: </h3><h4>{{$challenge->betType->name}}</h4></label>
                    <label for="challenge_type" class="control-label results"><h3>challenge type: </h3><h4>{{$challenge->challengeType->name}}</h4></label>
                    <label for="wager" class="control-label results"><h3>wager: </h3><h4>{{$challenge->wager}}</h4></label>
                </div>
            </div>
        </div>

    <br>

        <div class="row">
                <script>
                    var graphInfo = {!! json_encode($graphInfo) !!};
                </script>
                <div class="col-md-12" id="resultChart" style="min-width: 200px; height: 400px; margin: 0 auto"></div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-6 text-center">okoodfdf
            <label for="created_by" class="control-label"><h4 id="results_categories">winners: </h4></label>
            <ul>
                @foreach ($winners as $winner)
                    <li>{{$winner->user->name}} {{$winner->winnings}}</li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-6 text-center">
            <label for="created_by" class="control-label"><h4>losers: </h4></label>
            <ul>
                @foreach ($losers as $loser)
                    <li>{{$loser->user->name}} {{$loser->winnings}}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <hr style="border-top: 2px solid #e0e0e0">

    <br>

@endsection
