@extends ('layouts.master')
@section ('content')

    <script>
        var graphInfo = {!! json_encode($graphInfo) !!};
    </script>
    <div class="col-sm-9" id="resultChart" style="min-width: 200px; height: 400px; margin: 0 auto"></div>

    <h1>Created by: {{$challenge->user->name}}</h1>
    <h1>Wager: {{$challenge->wager}}</h1>
    <h1>Bet Type: {{$challenge->betType->name}}</h1>
    <h1>Challenge Type: {{$challenge->challengeType->name}}</h1>
    <h1>Winners:</h1>
    <ul>
        @foreach ($winners as $winner)
            <li>{{$winner->user->name}} {{$winner->winnings}}</li>
        @endforeach
    </ul>
    <h1>Losers: </h1>
    <ul>
        @foreach ($losers as $loser)
            <li>{{$loser->user->name}} {{$loser->winnings}}</li>
        @endforeach
    </ul>



@endsection
