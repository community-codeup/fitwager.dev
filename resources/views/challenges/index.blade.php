@extends('layouts.master')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-3"><h1 style="color:#888888">my<span style="color:#00d053">challenges</span></h1></div>
        </div>
    </div>

    <br>

    <div class="container">
        <div class="row">
                <div class="col-md-4 text-center"><button id="activeTab" type="button" class="btn btn-default btn-lg">active</button>
                </div>



                <div class="col-md-4 text-center"><button id="historicTab" type="button" class="btn btn-default btn-lg">historic</button>
                </div>


                <div class="col-md-4 text-center"><button id="pendingTab" type="button" class="btn btn-default btn-lg">pending</button>
                </div>

        </div>
    </div>

    <br>

    {{--  ACTIVE TABLE  --}}
    <div class="container" id="activeTable">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="mytable" class="table table-bordered table-striped table-hover">
                        <thead>
                        <th>created by</th>
                        <th>status</th>
                        <th>wager</th>
                        <th>bet type</th>
                        <th>challenge type</th>
                        <th>edit</th>
                        <th>delete</th>
                        </thead>
                        <tbody id="buildTableHTML">
                        @foreach ($activeChallenges as $challenge)
                            <tr>
                                <td>{{$challenge->created_by}}</td>
                                <td>{{$challenge->waitingOrLocked}}</td>
                                <td>{{$challenge->wager}}</td>
                                <td>{{$challenge->bet_type}}</td>
                                <td>{{$challenge->challenge_type}}</td>
                                @if((Auth::id() == $challenge->created_by_id) && ($challenge->waitingOrLocked != 'locked in'))
                                    <td><p data-placement="top" data-toggle="tooltip" title="Edit">
                                            <button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" >
                                                <span class="glyphicon glyphicon-pencil"></span></button></p></td>
                                    <td><p data-placement="top" data-toggle="tooltip" title="Delete">
                                            <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" >
                                                <span class="glyphicon glyphicon-trash"></span></button></p></td>
                                @else
                                    <td><p data-placement="top" data-toggle="tooltip" title="Edit">
                                            <button style="opacity: .2" class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" >
                                                <span class="glyphicon glyphicon-pencil"></span></button></p></td>
                                    <td><p data-placement="top" data-toggle="tooltip" title="Delete">
                                            <button style="opacity: .2" class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" >
                                                <span class="glyphicon glyphicon-trash"></span></button></p></td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{--  HISTORIC TABLE  --}}
    <div class="container" id="historicTable" hidden>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="mytable" class="table table-bordered table-striped table-hover">
                        <thead>
                        <th>created by</th>
                        <th>end date</th>
                        <th>wager</th>
                        <th>winnings</th>
                        <th>bet type</th>
                        <th>challenge type</th>
                        </thead>
                        <tbody id="buildTableHTML">
                        @foreach ($historicChallenges as $challenge)
                            <tr>
                                <td>{{$challenge->created_by}}</td>
                                <td>{{$challenge->end_date}}</td>
                                <td>{{$challenge->wager}}</td>
                                <td>{{$challenge->winnings}}</td>
                                <td>{{$challenge->bet_type}}</td>
                                <td>{{$challenge->challenge_type}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{--  PENDING TABLE  --}}
    <div class="container" id="pendingTable" hidden>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="mytable" class="table table-bordered table-striped table-hover">
                        <thead>
                        <th>created by</th>
                        <th>bet type</th>
                        <th>challenge type</th>
                        <th>wager</th>
                        <th>accept challenge</th>
                        </thead>
                        <tbody id="buildTableHTML">
                        @foreach ($pendingChallenges as $challenge)
                            <tr>
                                <td>{{$challenge->user_name}}</td>
                                <td>{{$challenge->bet_type}}</td>
                                <td>{{$challenge->challenge_type}}</td>
                                <td>{{$challenge->wager}}</td>
                                <td><a href="{{action('ChallengesController@acceptChallenge', $challenge->id)}}">accept</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

