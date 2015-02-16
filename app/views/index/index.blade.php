<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap.3.0.0.css" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap.theme.3.0.0.css" />
        <title>Online Chat</title>
    </head>
    <!-- Both Blade and EmberJS use double-curly-brace syntax, thus our template includes @ symbols before all EmberJS blocks. -->
    <body>
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
                <li><a href="#"><strong id='initialusernicname'>{{ Auth::user()->username }}</strong></a></li>
                <li id='isOnline'></li>
            </ul>
        @endif
        </div>
        <div class="col-md-2"></div>
        <hr class="col-md-12">
        <script type="text/x-handlebars">
            @{{outlet}}
        </script>
        <script type="text/x-handlebars" data-template-name="index">
        <div class="container">
            <div class="col-md-6">
                <div class="col-md-12">
                    <h2>Online Chat</h2>
                    <div class="input-group col-md-12">
                        @{{input type="text" value=command class="form-control"}}
                        <!-- span class="input-group-btn">
                            <button class="btn btn-default" @{{action "send"}}>Send</button>
                        </span -->
                    </div>
                    <div class="col-md-6">Please type your message and press Enter.</div>
                    <div class="col-md-6">Please use @chname command for changing your nicname. For example type "@chname John Dou" (without quotes) and press Enter.</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-12">
                    <br><br><br>
                    Messages list:(@{{model.length}})
                    <table class="table table-striped">
                        @{{#each message in model}}
                            <tr>
                                <td @{{bind-attr class="message.user_id_class"}}>
                                    @{{message.user_name}}
                                </td>
                                <td>
                                    @{{message.message}}
                                </td>
                            </tr>
                        @{{/each}}
                    </table>
                </div>
            </div>
        </div>
        </script>
        <script type="text/javascript" src="js/libs/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="js/libs/handlebars-v1.3.0.js"></script>
        <script type="text/javascript" src="js/libs/ember.js"></script>
        <script type="text/javascript" src="js/libs/ember-data.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/routerChat.js"></script>
        <script type="text/javascript" src="js/models/chat.js"></script>
        <script type="text/javascript" src="js/controllers/chat.js"></script>
        <script type="text/javascript" src="js/views/chat.js"></script>
    </body>
</html>