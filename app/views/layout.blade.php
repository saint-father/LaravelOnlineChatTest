<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" type="text/css" href="/css/bootstrap.3.0.0.css" />
        <link rel="stylesheet" type="text/css" href="/css/bootstrap.theme.3.0.0.css" />
        <title></title>
    </head>
    
    <body>
      <div class="row">
      <div class="col-md-10">
        @if (!Auth::check())
            <form class="navbar-form navbar-right" role="form" action="{{ action('UsersController@postLogin') }}" method="post">
                <a href="/users/login" class="btn btn-success">Login</a>
                <a href="/users/register" class="btn btn-success">Registration</a>
            </form>
        @else
            <form class="navbar-form navbar-right" role="form" action="/users/logout">
                <button class="btn btn-success">Logout</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><strong>{{ Auth::user()->username }}</strong></a></li>
            </ul>
        @endif
        </div>

      </div>
      <div class="row">
      @yield('content')
      </div>
    </body>
</html>
