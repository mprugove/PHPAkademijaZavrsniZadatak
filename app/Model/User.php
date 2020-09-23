<?php


namespace App\Model;


class User extends AModel
{
    protected static $table = 'user';

    public function getPass()
    {
        return $this->__get('pass');
    }
}