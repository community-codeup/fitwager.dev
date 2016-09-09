@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3"><h1 style="color:#888888">create<span style="color:#00d053">challenge</span></h1></div>
        </div>
    </div>

    <br>

    <div class="container-fluid">
        <div class="row">
            <form class="form-horizontal" method="POST" action="{{action('ChallengesController@store')}}"
                  id="user_parameters">
                {!! csrf_field() !!}

                <div class="form-group" style="margin-right: 0px; margin-left: 0px;">

                    <div class="row">
                        <label for="bet" class="col-sm-2 control-label">Bet Type:</label>
                        <div class="col-sm-10">
                            <div class="btn-group" data-toggle="buttons">
                                @foreach($betTypes as $index => $betType)
                                    <span style="padding-right: 0" data-toggle="tooltip" title="{{$betType->description}}"><label id="{{$betType->name . 'Radio'}}" class="btn btn-primary {{ $index == 0 ? 'active' : '' }}"><input style="visibility: hidden; margin-left: -10px"
                                                {{ $index == 0 ? 'checked' : '' }} type="radio"
                                                data-toggle="tab" name="bet_type"
                                                autocomplete="off" value="{{$betType->id}}">{{$betType->name}}</label></span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <label for="bet" class="col-sm-2 control-label">Challenge Type:</label>
                        <div class="col-sm-10">
                            <div class="btn-group" data-toggle="buttons">
                                @foreach($challengeTypes as $index => $challengeType)
                                    <span><label class="btn btn-primary {{ $index == 0 ? 'active' : '' }}"><input style="visibility: hidden; margin-left: -10px"
                                                {{ $index == 0 ? 'checked' : '' }} type="radio" id="challenge"
                                                data-toggle="tab" name="challenge_type" autocomplete="off"
                                                value="{{$challengeType->id}}">{{$challengeType->name}}</label></span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <br>

                    <div id="targetScore" class="row">
                        <label for="description" class="col-sm-2 control-label">Target Score:</label>
                        <input id="targetScoreForm" class="form-control" style="width: 11%;" type="text" name="targetScore" required="">
                    </div>

                    <br>

                    <div class="row">
                        <label for="wager" class="col-sm-2 control-label">Wager:</label>
                        <input class="form-control" style="width: 11%;" type="text" name="wager" id="wager" required="">
                    </div>

                    <br>

                    <div class="row">
                        <label for="description" class="col-sm-2 control-label">Description:</label>
                        <input class="form-control" style="width: 35%;" type="text" name="description" id="description" required="">
                    </div>

                    <br>

                    <div class="row">
                        <label for="start_date" class="col-sm-2 control-label">Date:</label>
                        <div id="picker" class="btn btn-primary"><span></span><b class="caret"></b></div>
                        <input type="hidden" id="hidden-start-date" name="start_date">
                        <input type="hidden" id="hidden-end-date" name="end_date">
                    </div>

                    <br>

                        <div class="row">
                            <label for="user" class="col-sm-2 control-label">User:</label>
                            <div class="col-md-10" style="padding-top: 7px">

                                @foreach($users as $user)
                                    <label style="padding-right: 34px;">
                                      <input type="checkbox" name="challengers[]" id="usersOnChallenge" value="{{$user->id}}"/>
                                       <figure>
                                        <img class="img img-thumbnail btn-group" id="usersOnChallenge" src="{{ $user->picture }}" height="75" width="75">
                                        <figcaption>{{$user->name}}</figcaption>
                                       </figure>
                                    </label>
                                @endforeach
                                    <input hidden type="checkbox" checked name="challengers[]" value="{{Auth::user()->id}}"/>
                            </div>

                        </div>

                    <br>

                    <div class="row">
                        <div class="col-sm-2"></div>
                        <button class="col-sm-2" id="create_challenge_button" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

