<?php

/**
 * Likes controller
 */
class Likes extends Controller
{

    /**
     * Like model
     *
     * @var object
     */
    private $likeModel;

    /**
     * Set like model obj
     * Check if user is logged in
     *
     * @return void
     */
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect();
        }

        $this->likeModel = $this->model('Like');

    }

    /**
     * Redirect to home in case of no request
     *
     * @return void
     */
    public function home()
    {
        redirect();
    }

    /**
     * Like the post
     *
     * @param int $id
     * @return void
     */
    public function like($id)
    {
        if (empty($id)) {
            redirect();

        }

        $data = [
            'user_id' => $_SESSION['user_id'],
            'post_id' => $id,
        ];

        // Check if user has had already like the post
        if (empty($this->likeModel->check($data))) {
            if ($this->likeModel->add($data)) {
                // Sucess
                redirect('posts/show/' . $id);

            } else {
                // Failed
                flash('like', 'Unable to like now, please try again later.', 'alert alert-danger');

                redirect();
            }

        } else {
            // User has had already liked the post so do the opposite
            if ($this->likeModel->remove($data)) {
                // Decremented like successfully
                redirect('posts/show/' . $id);

            } else {
                // Failed
                flash('like', 'Unable to dislike now, please try again later.', 'alert alert-danger');

                // Redirect to home page
                redirect();

            }
        }

    }

}
