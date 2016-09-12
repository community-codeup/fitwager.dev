@extends ('layouts.master')
@section ('content')
    <br>

    <hr style="border-top: 2px solid #e0e0e0">

    <div class="container-fluid" style="margin-top: 5%; padding-bottom: 2%;">
        <div class="row">
            <div class="col-sm-3" style="padding-left: 3%">
                <div style="border: 2px solid #00d053; border-radius: 2%; display: inline-block; padding-right: 3%; padding-left: 3%;">
                    <div><label for="created_by" class="control-label"><h4 id="results_categories">created by:</span> {{$challenge->user->name}}</h4></label></div>
                    <div><label for="created_by" class="control-label"><h4 id="results_categories">bet type: {{$challenge->betType->name}}</h4></label></div>
                    <div><label for="created_by" class="control-label"><h4 id="results_categories">challenge type: {{$challenge->challengeType->name}}</h4></label></div>
                    <div><label for="created_by" class="control-label"><h4 id="results_categories">wager: {{$challenge->wager}}</h4></label></div>
                    <div><label for="created_by" class="control-label"><h4 id="results_categories">winners: </h4></label></div>
                    <ul>
                        @foreach ($winners as $winner)
                            <li>{{$winner->user->name}} {{$winner->winnings}}</li>
                        @endforeach
                    </ul>
                    <div><label for="created_by" class="control-label"><h4>losers: </h4></label></div>
                    <ul>
                        @foreach ($losers as $loser)
                            <li>{{$loser->user->name}} {{$loser->winnings}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

                <script>
                    var graphInfo = {!! json_encode($graphInfo) !!};
                </script>
                <div class="col-sm-9" id="resultChart" style="min-width: 200px; height: 400px; margin: 0 auto"></div>
        </div>
    </div>

    <hr style="border-top: 2px solid #e0e0e0">

    <br>

@endsection
