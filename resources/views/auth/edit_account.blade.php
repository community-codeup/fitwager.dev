@extends('layouts.master')
@section('content')
 <form method="POST" action="{{ action('ProfileController@update', $user->id) }}" class="search-form">
    {!! csrf_field() !!}
    {!! method_field('PUT') !!} 
  <div class="control-group">
    	<!-- Username -->
    	<label class="control-label"  for="name">Username</label>
    	<div class="controls">
    		<input type="text" id="name" name="name" placeholder="" value="{{ $user->name }}" class="form-control">
    		<p class="help-block">Update your username </p>
    	</div>
   </div>
   <div class="control-group">
        <!-- E-mail -->
        <label class="control-label" for="email">E-mail</label>
        <div class="controls">
            <input type="text" id="email" name="email" placeholder="" value="{{ $user->email }}" class="form-control">
            <p class="help-block">Please provide your new E-Mail</p>
        </div>
    </div>
    <div class="control-group">
            <!-- Password-->
        <label class="control-label" for="password">Password</label>
        <div class="controls">
            <input type="password" id="password" name="password" placeholder="" value="{{ $user->password }}" class="form-control">
            <p class="help-block">New Password Please</p>
        </div>
    </div>

    <input type="submit">
</form>