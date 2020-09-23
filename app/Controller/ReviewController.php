<?php



namespace App\Controller;

use App\Model\Review;

class ReviewController extends AController
{
    public function createAction()
    {
        if (!$this->isReview() || !$this->auth->isLoggedIn()) {
            header('Location: /');
            return;
        }

        $reviewContent = $_POST['new_review'] ?? '';

        if (!$reviewContent) {
            // set error message
            header('Location: /');
            return;
        }

        Review::insert([
            'content' => $reviewContent,
            'user_id' => $this->auth->getCurrentUser()->getId()
        ]);

        header('Location: /');
    }

    public function deleteAction()
    {
        $reviewId = $_GET['id'] ?? null;
        if (!$reviewId || !$this->auth->isLoggedIn()) {
            header('Location: /');
            return;
        }

        $review = Review::getOne('id', $reviewId);

        if ($review->getUserId() == $this->auth->getCurrentUser()->getId()) {
            Review::delete('id', $reviewId);
        }

        header('Location: /');
    }
}