@extends('layouts.master')
@section('content')

    <div id="tab" class="btn-group" data-toggle="buttons-radio"">
        <form method="POST" action="{{action('ChallengesController@store')}}">
            {!! csrf_field() !!}
            @foreach($betTypes as $betType)
                <a href="#" id="betType" class="btn btn-large btn-success active types" style="background-color: black" data-toggle="tab" name="bet_type" value="{{$betType->id}}">{{$betType->name}}</a>
            @endforeach
            <br>
            @foreach($challengeTypes as $challengeType)
                <a href="#" id="challengeType" class="btn btn-large btn-warning active types" data-toggle="tab" name="bet_type"name="challenge_type" value="{{$challengeType->id}}">{{$challengeType->name}}</a>
            @endforeach
            <br>
            <label for="description">Description</label>
            <input type="text" name="description" id="description" required=""><br>
            <label for="start_date">Date</label>
            <div id="picker" class="btn btn-primary"><span></span><b class="caret"></b></div><br>
            <label for="wager">Wager</label>
            <input type="text" name="wager" id="wager" required=""><br>
            @foreach($users as $user)
                <input type="checkbox" name="challengers[]" value="{{$user->id}}">{{$user->name}}
            @endforeach
            <br>
            <button type="submit">Submit</button>
        </form>
    </div>

@endsection

