<?php


namespace App\Controller;

use App\Model\Car;
use App\Model\User;
use App\Model\Rent;

class RentController extends AController
{

    public function indexAction()
    {
        $getId=$_GET['id'] ?? null;
        $data = [
            'rents' => Rent::getAll(),
            'users' => User::getAll(),
            'user' => User::getOne('id', $getId),
            'cars' => Car::getAll(),
            'car' => Car::getOne('id', $getId)
        ];
        return $this->view->render('rent',$data);

    }

    public function addAction()
    {
        if (!$this->isPost() || !$this->auth->isLoggedIn()) {
            header('Location: /');
            return;
        }

        $authUser = $this->auth->getCurrentUser()->getId();

        Rent::insert([
            'user_id' => $authUser,
            'start_date' => $_POST['start_date'],
            'end_date' => $_POST['end_date'],
            'car_id' => $_POST['car_id'],

        ]);
        header("Location: /~polaznik17/rent");
    }

    public function deleteAction()
    {
        $rentId = $_GET['id'] ?? null;
        if (!$rentId || !$this->auth->isLoggedIn()) {
            header('Location: /~polaznik17/rent');
            return;
        }
        $rent = Rent::getOne('id', $rentId);

        if ($rent->getUserId() == $this->auth->getCurrentUser()->getId()) {
            Rent::delete('id', $rentId);
        }
        header('Location: /~polaznik17/rent');
    }
}
