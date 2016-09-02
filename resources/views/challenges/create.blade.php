@extends('layouts.master')
@section('content')
<div class="container-fluid"><h1>Create Challenge</h1></div>
    <div class="container">
        <div class="row">
                <form class="form-horizontal" method="POST" action="{{action('ChallengesController@store')}}">
                    {!! csrf_field() !!}

                    <div class="form-group">

                        <div class="row">
                            <label for="bet" class="col-sm-2 control-label">Bet Type:</label>
                            <div class="col-sm-6">
                                @foreach($betTypes as $index => $betType)
                                    <a href="#" @if($index == 0) checked @endif id="betType" class="btn btn-large btn-success active types" data-toggle="tab" name="bet_type" value="{{$betType->id}}">{{$betType->name}}</a>
                                @endforeach</div>
                            <div class="col-sm-4"></div>
                        </div>

                        <br>

                        <div class="row">
                            <label for="bet" class="col-sm-2 control-label">Challenge Type:</label>
                            <div class="col-sm-4">
                                @foreach($challengeTypes as $index => $challengeType)
                                    <a href="#" @if($index == 0) checked @endif id="challengeType" class="btn btn-large btn-warning active types" data-toggle="tab" name="bet_type"name="challenge_type" value="{{$challengeType->id}}">{{$challengeType->name}}</a>
                                @endforeach</div>
                            <div class="col-sm-6"></div>
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
                            {{--<div class="col-sm-9"></div>--}}
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
                                    <input type="checkbox" name="challengers[]" value="{{$user->id}}">{{$user->name}}
                                @endforeach</div>
                            <div class="col-md-8"></div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-sm-2"></div>
                            <button class="col-sm-2" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

