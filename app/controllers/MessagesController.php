<?php

class MessagesController extends BaseController {

    public function __construct() {
        $this->beforeFilter('auth', array('except' => 'missingMethod'));
    }
    
    public function missingMethod($parameters = array()) {
        //
    }    
    
    public function getIndex() { // REST
        $messages = Message::where( function ($query) {
            $query->where('userId', '=', Auth::user()->id);
//                ->where('receiverId', '=', 1);
        })->orWhere(  function ($query) {
            $query->where('receiverId', '=', Auth::user()->id);
//                ->where('receiverId', '=', 1);
        })->take(10)->get();
        return Response::json(array('messages' => $messages->toArray()));
    }    
    
    public function anyConversation() { // REST
        $messages = Message::where( function ($query) {
            $query->where('userId', '=', Auth::user()->id)
                ->where('receiverId', '=', Input::get('receiverId'));
        })->orWhere(  function ($query) {
            $query->where('receiverId', '=', Auth::user()->id)
                ->where('userId', '=', Input::get('receiverId'));
        })->take(10)->get();
        return Response::json(array('messages' => $messages->toArray()));
    }    
    
}


