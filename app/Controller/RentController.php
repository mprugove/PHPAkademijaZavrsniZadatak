<?php


namespace App\Controller;

use App\Model\Post;
use App\Model\User;
use App\Model\Rent;

class RentController extends AController
{

    public function indexAction()
    {
        return $this->view->render('rent', [
            'rents' => Rent::getAll(),
            'users' => User::getAll(),
            'posts' => Post::getAll(),
        ]);
    }

    public function createAction()
    {
        if (!$this->isPOST() || !$this->auth->isLoggedIn()) {
            header('Location: /');
            return;
        }

        $rentContent = $_POST['rent'] ?? '';
        if (!$rentContent) {
            header('Location: /');
            return;
        }

        Post::insert([
            'start_date' => $rentContent,
            'end_date' => $rentContent,
            'car_id' => $rentContent,
            'brand_id' => $rentContent,
            'post_id' => $rentContent,
            'user_id' => $this->auth->getCurrentUser()->getId()
        ]);

        header('Location: /');
    }

    public function deleteAction()
    {
        $rentId = $_GET['id'] ?? null;
        if (!$rentId || !$this->auth->isLoggedIn()) {
            header('Location: /');
            return;
        }
        $rent = Post::getOne('id', $rentId);

        if ($rent->getUserId() == $this->auth->getCurrentUser()->getId()) {
            Post::delete('id', $rentId);
        }
        header('Location: /');
    }
}