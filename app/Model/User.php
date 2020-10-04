<?php


namespace App\Model;


class User extends AModel
{
    protected static $table = 'user';

    public function getPass(): string
    {
        return $this->__get('pass');
    }
}