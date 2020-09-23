<?php

namespace App\Controller;

use App\Model\Review;

class HomeController extends AController
{
    public function indexAction()
    {
        return $this->view->render('home');

    }
} 