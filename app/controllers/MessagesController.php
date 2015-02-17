<?php

class MessagesController extends BaseController {

    public function __construct() {
        $this->beforeFilter('auth', array('except' => 'missingMethod'));
    }
    
    public function missingMethod($parameters = array()) {
        //
    }    
    
    public function getIndex() { // REST
        return Response::json(array('messages' => Message::all()->toArray()));
    }    
    
}


