<?php

namespace App\Controller;

use App\Model\Post;
use App\Model\User;


class HomeController extends AController
{
    public function indexAction()
        {
            $data = [
            'posts' => Post::getAll(),
            'users' => User::getAll(),
        ];
            return $this->view->render('home',$data);
    }

} 