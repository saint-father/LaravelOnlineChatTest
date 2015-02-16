<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');
        
        protected $fillable = array('username', 'email', 'password');
        
        public static $validation = array(
            'email'     => 'required|email|unique:users',

            'username'  => 'required|alpha_num|unique:users',

            'password'  => 'required|confirmed|min:6',
        );        

        protected function generateCode() {
            return Str::random(); // By default, the length of random string of 16 characters
        }        
        
        public function sendActivationMail() {
            $activationUrl = action(
                'UsersController@getActivate',
                array(
                    'userId' => $this->id,
                    'activationCode'    => $this->activationCode,
                )
            );

            $that = $this;
//            return; // for debugging only
            Mail::send('emails/activation',
                array('activationUrl' => $activationUrl),
                function ($message) use($that) {
                    $message->to($that->email)->subject('Thank you for registering!');
                }
            );
        }        
        
        public function register() {
            $this->password = Hash::make($this->password);
            $this->activationCode = $this->generateCode();
            $this->isActive = true;
            $this->isAdmin = false;
            $this->save();

            Log::info("User [{$this->email}] registered. Activation code: {$this->activationCode}");

//            $this->sendActivationMail();

            return $this->id;
        }        
        
        public function activate($activationCode) {
            if ($this->isActive) {
                return false;
            }

            if ($activationCode != $this->activationCode) {
                return false;
            }

            $this->activationCode = '';
            $this->isActive = true;
            $this->save();

            Log::info("User [{$this->email}] successfully activated");

            return true;
        }        
        
	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

        public function getRememberToken()
        {
            return $this->remember_token;
        }

        public function setRememberToken($value)
        {
            $this->remember_token = $value;
        }

        public function getRememberTokenName()
        {
            return 'remember_token';
        }
}