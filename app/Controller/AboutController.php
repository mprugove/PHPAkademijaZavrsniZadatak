<?php

namespace App\Controller;

use App\Model\User;

class AboutController extends AController
{
    public function indexAction()
    {
        return $this->view->render('about', [
            'users' => User::getAll()
        ]);
    }
}

