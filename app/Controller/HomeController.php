<?php

namespace App\Controller;


use App\Model\User;
use App\Model\Car;

class HomeController extends AController
{
    public function indexAction()
        {

            $data = [
            'users' => User::getAll(),
            'cars' => Car::getAll(),
        ];
            return $this->view->render('/~polaznik17/home',$data);
    }

//    public function searchAction()
//    {
//        $data =[
//            'cars' => Car::getSearch('car_name',$_POST['search'])
//        ];
//        return $this->view->render('home', $data);
//    }


} 