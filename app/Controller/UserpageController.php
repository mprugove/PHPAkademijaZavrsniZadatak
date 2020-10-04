<?php

// admin can add, delete users

namespace App\Controller;

use App\Model\User;


class UserpageController extends AController
{
    public function indexAction()
    {
        if($_SESSION['user_type'] === '1' || $_SESSION['user_type'] != '2') {
            return $this->view->render('userpage', [
                'users' => User::getAll('Username'),

            ]);
        } else {
            return $this->view->render('userpage', [
                'users' => User::getAll('Username', [1, 1]),
            ]);
        }
    }
    // admin delete
    public function deleteAction()
    {
        $userId = $_GET['id'] ?? null;
        User::delete('id', $userId);

        header('Location: userpage');
    }

    public function registerAction()
    {
        if (!$this->auth->isLoggedIn()) {
            return $this->view->render('userpage');
        }

        header('Location: /');
    }

    public function registerSubmitAction()
    {
        if (!$this->isPOST()) { // allow post only
            header('Location: /');
            return;
        }
        $requiredKeys = ['first_name', 'last_name', 'email', 'pass', 'confirm_pass'];
        if(!$this->validateData($_POST, $requiredKeys)) {
            header('Location: /user/register');
        }

        if ($_POST['pass'] !== $_POST['confirm_pass']) {
            header('Location: /user/register');
            return;
        }

        $user = User::getOne('email', $_POST['email']);

        if ($user->getId()) {
            // check if exists
            header('Location: /user/register');
            return;
        }

        User::insert([
            'username' => $_POST['username'] ?? null,
            'first_name' => $_POST['firstname'] ?? null,
            'last_name' => $_POST['lastname'] ?? null,
            'email' => $_POST['email'],
            'pass' => password_hash($_POST['pass'], PASSWORD_DEFAULT),
            'country' => $_POST['country'] ?? null,
            'license' => $_POST['license'] ?? null,
            'join_date' => $_POST['join_date'] ?? null,

        ]);
        header('Location: /userpage');
    }

    public function updateAction()
    {
        if($this->auth->isLoggedIn())
        {
            if($_POST['new_pass'] === $_POST['confirm_new_pass'])
            {
                User::update('pass',$_POST['id'],password_hash($_POST['new_pass'], PASSWORD_DEFAULT));
                header('Location: /userpage');
                return;
            }
        }
    }

    protected function validateData(array $data, array $keys): bool
    {
        foreach ($keys as $key) {
            $isValueValid = isset($data[$key]) && $data[$key];
            if (!$isValueValid) {
                return false;
            }
        }
        return true;
    }
}