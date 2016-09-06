@extends('layouts.master')
@section('content')
<div class="container-fluid"><h1>Create Challenge</h1></div>
    <div class="container">
        <div class="row">
                <form class="form-horizontal" method="POST" action="{{action('ChallengesController@store')}}" id="user_parameters">
                    {!! csrf_field() !!}

                    <div class="form-group">

                        <div class="row">
                            <label for="bet" class="col-sm-2 control-label">Bet Type:</label>
                            <div class="col-sm-10">
                                <div class="btn-group" data-toggle="buttons">
                                @foreach($betTypes as $index => $betType)
                                      <label class="btn btn-primary {{ $index == 0 ? 'active' : '' }}"><input {{ $index == 0 ? 'checked' : '' }} type="radio" id="bet"  data-toggle="tab" name="bet_type" autocomplete="off" value="{{$betType->id}}">{{$betType->name}}</label>
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
                                      <label class="btn btn-primary {{ $index == 0 ? 'active' : '' }}"><input {{ $index == 0 ? 'checked' : '' }} type="radio" id="challenge" data-toggle="tab" name="challenge_type" autocomplete="off" value="{{$challengeType->id}}">{{$challengeType->name}}</label>
                                @endforeach
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <label for="description" class="col-sm-2 control-label">Description:</label>
                            <input class="col-md-4" type="text" name="description" id="description" required="">
                            <div class="col-md-6"></div>
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
                            <label for="wager" class="col-sm-2 control-label">Wager:</label>
                            <input class="col-md-1" type="text" name="wager" id="wager" required="">
                            <div class="col-md-9"></div>
                        </div>

                        <br>

                        <div class="row">
                            <label for="user" class="col-sm-2 control-label">User:</label>
                            <div class="col-md-2" style="padding-top: 7px">
                                @foreach($users as $user)
                                <label>
                                  <input type="checkbox" name="challengers[]" value="{{$user->id}}"/>
                                  <img class="img img-thumbnail" src="{{ $user->picture }}" height="75" width="75">
                                </label>
                                {{$user->name}}
                                @endforeach</div>
                            <div class="col-md-8"></div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-sm-2"></div>
                            <button class="col-sm-2" id="get_average_button" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

