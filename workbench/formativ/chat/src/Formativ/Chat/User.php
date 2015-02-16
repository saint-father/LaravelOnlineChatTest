<?php

namespace Formativ\Chat;

use Ratchet\ConnectionInterface;
use Illuminate\Database\Eloquent\Model;

class User extends Model 
implements UserInterface
{
    protected $socket;

    protected $name;

    protected $id;

    public function getSocket()
    {
        return $this->socket;
    }

    public function setSocket(ConnectionInterface $socket)
    {
        $this->socket = $socket;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}