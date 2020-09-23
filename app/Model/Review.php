<?php


namespace App\Model;


class Review extends AModel
{
    protected static $table = 'review';

    protected static function createObject(array $data): AModel
    {
        if ($userId = $data['user_id'] ?? null) {
            $user = User::getOne('id', $userId);
            $data['user_name'] = "{$user->getFirstName()} {$user->getLastName()}";
        }
        return parent::createObject($data);
    }
}