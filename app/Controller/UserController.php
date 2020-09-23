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

        header('Location: /');
    }

    public function registerAction()
    {
        if (!$this->auth->isLoggedIn()) {
            return $this->view->render('register');
        }

        header('Location: /');
    }


    public function registerSubmitAction()
    {
        if (!$this->isPOST()) {
            // only POST requests are allowed
            header('Location: /');
            return;
        }

            $requiredKeys = ['first_name', 'last_name', 'email', 'password', 'confirm_password'];
            if (!$this->validateRegisterData($_POST, $requiredKeys)) {
                // set error message
                header('Location: /user/register');
                return;


        }

            User::insert([
                'first_name' => $_POST['first_name'] ?? null,
                'last_name' => $_POST['last_name'] ?? null,
                'email' => $_POST['email'],
                'pass' => password_hash($_POST['password'], PASSWORD_DEFAULT)
            ]);

            header('Location: /user/login');
        }


    public function loginSubmitAction()
    {
        // only POST requests are allowed
            if (!$this->isPOST() || $this->auth->isLoggedIn()) {
                header('Location: /');
                return;
            }

                $requiredKeys = ['email', 'password'];
                if (!$this->validateData($_POST, $requiredKeys)) {
                    // set error message
                    header('Location: /user/login');
                    return;
                }

                // todo login
                $this->auth->login($user);
                header('Location: /');
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

                header('Location: /');
            }
        }