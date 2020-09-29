<?php

namespace App\Model;

class Post extends AModel
{
    protected static $table = 'post';

    protected static function createObject($data): AModel
    {
        if ($userId = $data['user_id'] ?? null) {
            $user = User::getOne('id', $userId );
            $data['user_name'] = "{$user->getFirstName()} {$user->getLastName()}";
            $data['user'] = "{$user->getUserType()}";

        }
        return parent::createObject($data);
    }

}






