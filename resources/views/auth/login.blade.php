@extends ('layouts.master')

@section('content')
    <form method="POST" action="{{ action('Auth\AuthController@postLogin') }}">
        <label>Email</label>
        <input type="text" name="email" value="{{ old('email') }}">
        <label>Password</label>
        <input type="password" name="password" value="{{ old('password') }}">
        <input type="submit">
    </form>
    <button action
@endsection
