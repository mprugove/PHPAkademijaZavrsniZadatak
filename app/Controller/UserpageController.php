<?php

namespace App\Controller;

use App\Model\User;
use App\Model\Userpage;

class UserpageController extends AController
{
    public function indexAction()
    {
        if($_SESSION['user_type'] === '1') {
            return $this->view->render('userpage', [
                'users' => User::getAll('Username'),

            ]);
        } else {
            return $this->view->render('userpage', [
                'users' => User::getAll('Username', [1, 1]),
            ]);
        }
    }

    public function deleteAction()
    {
        $userId = $_GET['id'] ?? null;
        $userpage = Userpage::getOne('id', $userId);
        Userpage::delete('id', $userId);

        header('Location: /userpage');
    }

//    public function registerSubmitAction()
//    {
//        if (!$this->isPOST()) { // allow post only
//            header('Location: /');
//            return;
//        }
//        $requiredKeys = ['first_name', 'last_name', 'email', 'pass', 'confirm_pass'];
//        if(!$this->validateData($_POST, $requiredKeys)) {
//            header('Location: /user/register');
//        }
//
//        if ($_POST['pass'] !== $_POST['confirm_pass']) {
//            header('Location: /user/register');
//            return;
//        }
//
//        $user = Userpage::getOne('email', $_POST['email']);
//
//        if ($user->getId()) {
//            // check if exists
//            header('Location: /user/register');
//            return;
//        }
//
//        Userpage::insert([
//            'username' => $_POST['username'] ?? null,
//            'first_name' => $_POST['firstname'] ?? null,
//            'last_name' => $_POST['lastname'] ?? null,
//            'email' => $_POST['email'],
//            'pass' => password_hash($_POST['pass'], PASSWORD_DEFAULT),
//            'country' => $_POST['country'] ?? null,
//            'license' => $_POST['license'] ?? null,
//            'join_date' => $_POST['join_date'] ?? null,
//
//        ]);
//        header('Location: /userpage');
//    }

}