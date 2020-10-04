<?php

namespace App\Controller;

use App\Model\News;
use App\Model\Review;
use App\Model\User;

class NewsController extends AController
{

    public function indexAction()
    {
        return $this->view->render('news', [
            'users' => User::getAll(),
            'news' => News::getAll(),
        ]);
    }
    public function addAction()
    {
        if (!$this->isPOST() || !$this->auth->isLoggedIn()) {
            header('Location: home ');
            return;
        }

        $newsContent = $_POST['new_post'] ?? '';
        $authUser = $this->auth->getCurrentUser()->getId();
        if (!$newsContent) {
            header('Location: home');
            return;
        }

        News::insert([
            'content' => $newsContent,
            'user_id' => $authUser
        ]);
        header('Location: ~polaznik17/news');
    }

    public function deleteAction()
    {
        $newsId = $_GET['id'] ?? null;
        if (!$newsId || !$this->auth->isLoggedIn()) {
            header('Location: ~polaznik17/news');
            return;
        }

        $news = News::getOne('id', $newsId);
        if ($news->getUserId() == $this->auth->getCurrentUser()->getId()) {
            News::delete('id', $newsId);
        }
        header('Location: ~polaznik17/news');
    }
}