<?php


namespace App\Controller;



use App\Model\Rent;
use App\Model\Review;
use App\Model\Car;
use App\Model\User;

class ReviewController extends AController
{
    public function indexAction()
    {
        $getId=$_GET['id'] ?? null;
        if( !$getId){
            header('Location: /');
            return;
        }
        return $this->view->render('/review', [
            'cars'=>Car::getOne('id', $getId),
            'reviews'=>Review::getAvg('','id',$getId),
            'rentals'=>Rent::getOne('id',$getId),
            'users'=>User::getOne('id',$getId),
        ]);
    }

    public function addAction()
    {
        if (!$this->isPost() || !$this->auth->isLoggedIn()) {
            header('Location: /');
            return;
        }

        $authUser = $this->auth->getCurrentUser()->getId();

        Review::insert([
            'user_id' => $authUser,
            'car_id' => $_POST['car_id'],
            'score' => $_POST['score'],
        ]);
        header("Location: /~polaznik17/review");
    }
}