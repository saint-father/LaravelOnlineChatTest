<?php

class UsersController extends BaseController {

    public function getRegister() {
        return View::make('users/register');
    }
    
    public function getLogin() {
        return View::make('users/login');
    }

    public function postRegister() {
        $rules = User::$validation;
        $validation = Validator::make(Input::all(), $rules);
        if ($validation->fails()) {
            return Redirect::to('users/register')->withErrors($validation)->withInput();
        }

        $user = new User();
        $user->fill(Input::all());
        $id = $user->register();

        return Redirect::to('users/login')->with('message', 
                'Registration is almost complete. Your account is activated already. (But in the real world, You need to confirm e-mail, specified at registration by clicking on the link in the message.)');
    }
    
    public function getActivate($userId, $activationCode) {
        $user = User::find($userId);
        if (!$user) {
            return $this->getMessage("Activation link is invalid.");
        }

        if ($user->activate($activationCode)) {
            Auth::login($user);
            return $this->getMessage("Your account is activated.", "/");
        }

        return $this->getMessage("Activation link is invalid, or Your account is activated already.");
    }    
    
    public function postLogin() {
        $creds = array(
            'password' => Input::get('password'),
            'isActive'  => 1,
        );

        $username = Input::get('username');
        if (strpos($username, '@')) {
            $creds['email'] = $username;
        } else {
            $creds['username'] = $username;
        }

        if (Auth::attempt($creds, Input::has('remember'))) {
            Log::info("User [{$username}] successfully logged in.");
            return Redirect::intended();
        } else {
            Log::info("User [{$username}] failed to login.");
        }

        $alert = "Invalid combination of the login (email) and password, or account is not active yet.";

        return Redirect::back()->withAlert($alert);
    }

    public function getLogout() {
        Auth::logout();
        return Redirect::to('/');
    }    
    
}


