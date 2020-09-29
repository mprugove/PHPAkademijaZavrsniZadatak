<?php

namespace App\Controller;

use App\Model\Post;


class UpdateController extends AController
{
    public function indexAction()
    {
        return $this->view->render('update', [
            'posts' => Post::getAll('id', [1,1]),
        ]);

    }
    // update
}