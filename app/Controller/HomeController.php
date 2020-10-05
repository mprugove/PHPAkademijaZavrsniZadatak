<?php

namespace App\Controller;


use App\Model\User;
use App\Model\Car;

class HomeController extends AController
{
    public function indexAction()
        {
            $getId=$_GET['id'] ?? null;
            $data = [
            'users' => User::getAll(),
            'cars' => Car::getAll(),
            'car' => Car::getOne('id', $getId),
        ];
            return $this->view->render('home',$data);
    }

//    public function searchAction()
//    {
//        $data =[
//            'cars' => Car::getSearch('car_name',$_POST['search'])
//        ];
//        return $this->view->render('home', $data);
//    }


} 