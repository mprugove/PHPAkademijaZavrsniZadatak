<?php

namespace App\Controller;

use App\Model\User;


class UserController extends AController
{

    public function loginAction()
    {
        if (!$this->auth->isLoggedIn()) {
            return $this->view->render('login');
        }

        header('Location: http://phpacademy.inchoo.io/~polaznik17/');
    }

    public function registerAction()
    {
        if (!$this->auth->isLoggedIn()) {
            return $this->view->render('register');
        }

        header('Location: http://phpacademy.inchoo.io/~polaznik17/');
    }

    public function registerSubmitAction()
    {
        if (!$this->isPOST()) {
            // allow post only
            header('Location: /');
            return;
        }
        $requiredKeys = ['first_name', 'last_name', 'email', 'pass', 'confirm_pass'];
        if(!$this->validateData($_POST, $requiredKeys)) {
            header('Location: http://phpacademy.inchoo.io/~polaznik17/user/register');
        }

        if ($_POST['pass'] !== $_POST['confirm_pass']) {
            header('Location: http://phpacademy.inchoo.io/~polaznik17/user/register');
            return;
        }

        $user = User::getOne('email', $_POST['email']);

        if ($user->getId()) {
            // check if exists
            header('Location: http://phpacademy.inchoo.io/~polaznik17/user/register');
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
        header('Location: http://phpacademy.inchoo.io/~polaznik17/user/login');
    }

    public function loginSubmitAction()
    {
        if (!$this->isPOST() || $this->auth->isLoggedIn()) {
            header('Location: http://phpacademy.inchoo.io/~polaznik17/');
            return;
        }

        $requiredKeys = ['email', 'pass'];
        if (!$this->validateData($_POST, $requiredKeys)) {
            header('Location: http://phpacademy.inchoo.io/~polaznik17/user/login');
            return;
        }

        $user = User::getOne('email', $_POST['email']);

        if (!$user->getId() || !password_verify($_POST['pass'], $user->getPass())) {
            header('Location: http://phpacademy.inchoo.io/~polaznik17/user/login');
            return;
        }

        $this->auth->login($user);
        header('Location: http://phpacademy.inchoo.io/~polaznik17/');
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

    public function logoutAction()
    {
        if ($this->auth->isLoggedIn()) {
            $this->auth->logout();
        }

        header('Location: http://phpacademy.inchoo.io/~polaznik17/');
    }

    public function updateAction()
    {
        if($this->auth->isLoggedIn()) {
            if ($_POST['new_pass'] === $_POST['confirm_new_pass']) {
                User::update('pass', $_POST['id'], password_hash($_POST['new_pass'], PASSWORD_DEFAULT));
                header('Location : http://phpacademy.inchoo.io/~polaznik17/');
                return;
            }
        }
    }
}