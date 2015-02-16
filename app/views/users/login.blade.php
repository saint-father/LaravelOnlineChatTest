@extends('layout')
 
@section('title')
Login
@stop
 
@section('headExtra')
    {{ HTML::style('css/signin.css') }}
@stop

@section('content')
<div class="container">
    @if (Session::has('alert'))
        <div class="alert alert-danger">
            <p>{{ Session::get('alert') }}
        </div>
    @endif
    @if (Session::has('message'))
        <div class="">
            <p>{{ Session::get('message') }}
        </div>
    @endif
    <div class="input-group">
    <form class="form-signin" role="form" action="{{ action('UsersController@postLogin') }}" method="post">
        <h2 class="form-signin-heading">Please Login for chat</h2>
        <input type="text" class="form-control" placeholder="Email or username" name="username" required autofocus />
        <input type="password" class="form-control" placeholder="Password" name="password" required />
        <label class="checkbox">
            <input type="checkbox" name="remember" value="remember-me"> Remember me
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
 
        <!-- a href="/password/remind">Forgot password?</a><br /-->
        <a href="/users/register">Registration</a>
    </form>
    </div>
</div>
@stop