@extends('layouts.master')
@section('content')
    <form method="POST" action="{{action('ChallengesController@store')}}">
        {!! csrf_field() !!}
        @foreach($betTypes as $betType)
            <input type="radio" name="bet_type" value="{{$betType->id}}">{{$betType->name}}
        @endforeach
        <br>
        @foreach($challengeTypes as $challengeType)
            <input type="radio" name="challenge_type" value="{{$challengeType->id}}">{{$challengeType->name}}
        @endforeach
        <br>
        <label for="description">Description</label>
        <input type="text" name="description" id="description"><br>
        <label for="start_date">Start Date</label>
        <input type="text" name="start_date" id="start_date"><br>
        <label for="end_date">End Date</label>
        <input type="text" name="end_date" id="end_date"><br>
        <button type="submit">Submit</button>
    </form>
@endsection
