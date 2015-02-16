<?php
Route::get('/', array('before' => 'auth', function()
{
    return View::make("index/index");
    // Only authenticated users may enter...
}));
////load a custom view
//Route::get("/", function()
//{
//    return View::make("index/index");
//});

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
