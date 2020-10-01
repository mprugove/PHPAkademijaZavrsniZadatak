<?php

namespace App\Controller;

use App\Model\Post;

class PostController extends AController
{
    public function createAction()
    {
        if (!$this->isPOST() || !$this->auth->isLoggedIn()) {
            header('Location: http://phpacademy.inchoo.io/~polaznik17/home/');
            return;
        }

        $postContent = $_POST['new_post'] ?? '';

        if (!$postContent) {
            header('Location: http://phpacademy.inchoo.io/~polaznik17/home/');
            return;
        }

        Post::insert([
            'content' => $postContent,
            'user_id' => $this->auth->getCurrentUser()->getId()
        ]);

        header('Location: http://phpacademy.inchoo.io/~polaznik17/home/');
    }

    public function deleteAction()
    {
        $postId = $_GET['id'] ?? null;
        if (!$postId || !$this->auth->isLoggedIn()) {
            header('Location: http://phpacademy.inchoo.io/~polaznik17/home/');
            return;
        }

        $post = Post::getOne('id', $postId);

        if ($post->getUserId() == $this->auth->getCurrentUser()->getId()) {
            Post::delete('id', $postId);
        }
        header('Location: http://phpacademy.inchoo.io/~polaznik17/home/');
    }
}