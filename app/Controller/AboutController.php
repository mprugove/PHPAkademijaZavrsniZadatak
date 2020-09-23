<?php


namespace App\Controller;


class AboutController extends AController
{

    public function indexAction()
    {
        return $this->view->render('about');

    }
}