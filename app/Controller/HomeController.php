<?php

namespace App\Controller;

use App\Model\Post;
use App\Model\User;

class HomeController extends AController
{
    public function indexAction()
        {
            return $this->view->render('/home', [
            'posts' => Post::getAll(),
            'users' => User::getAll(),
        ]);
    }
} 