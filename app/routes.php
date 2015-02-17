<?php
Route::get('/', array('before' => 'auth', function()
{
    $users = User::all();
    return View::make("index/index")->with('users', $users);
    // Only authenticated users may enter...
}));



//Route::get('messages', function()
//{
//    return Response::json(array('messages' => array(array('id' => 1111, 'userId' => 987, 'userName' => 'SF123', 'message' => 'SF--SF'))));
//});
Route::controller('messages', 'MessagesController'); // REST


Route::get("phpinfo", function()
{
    return View::make("phpinfo");
});

Route::get('login', function () {
    $users = User::all();
    return View::make('users')->with('users', $users);
});

Route::get('users/list', function () {
    $users = User::all();
    return View::make('users')->with('users', $users);
});

Route::controller('users', 'UsersController');
