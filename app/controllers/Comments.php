<?php

/**
 * Controll comments
 */
class Comments extends Controller
{

    /**
     * User model
     *
     * @var object
     */
    private $userModel;

    /**
     * Post model
     *
     * @var object
     */
    private $postModel;

    /**
     * Comment model
     *
     * @var object
     */
    private $commentModel;

    /**
     * Check if user is login
     * Set postmodel and usermodel values
     *
     * @return void
     */
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->userModel = $this->model('User');
        $this->postModel = $this->model('Post');
        $this->commentModel = $this->model('Comment');

    }

    /**
     * Redirect to post
     *
     * @return void
     */
    public function home()
    {
        redirect('posts');

    }

    /**
     * Add new comment
     *
     * @param int $id
     * @return void
     */
    public function add($id)
    {
        // $params = func_get_args();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Sanitize comment data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'text' => filter_var($_POST['comment_text'], FILTER_SANITIZE_STRING),
                'user_id' => $_SESSION['user_id'],
                'post_id' => $id,
                'text_err' => '',
            ];

            // Validate text
            if (empty($data['text'])) {
                $data['text_err'] = 'Please fill in the text box!';
            }

            // Validate post id
            // * Check if the post is exist

            // If there are no errors submit the comment
            if ($data['text_err'] == '') {
                unset($data['text_err']);

                if ($this->commentModel->add($data)) {
                    // Comment successfully added
                    flash('comment_added', 'Your comment was added.');

                    redirect('posts/show/' . $data['post_id']);

                } else {
                    // Comment was not added {database error}
                    flash('comment_failed', 'Unable to add comments now, please try again later.', 'alert alert-danger');

                    redirect('posts/show/' . $data['post_id']);
                }

            } else {
                // There are error and mistakes made by user
                flash('comment_failed', 'Comment was not added, you did not enter any text!', 'alert alert-danger');

                redirect('posts/show/' . $data['post_id']);

            }

        } else {
            // Redirect user to home page because request is incorrect
            redirect();

        }

    }

    public function delete($id)
    {

        // Only access post requests
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get function arguments in an array
            $arr_id = func_get_args();

            // Check if page number is undefined
            // * Validate $id number
            if (count($arr_id) < 1 || !preg_match('~[0-9]+~', $arr_id[0])) {
                redirect('posts');

            }

            if ($this->commentModel->delete($arr_id)) {
                flash('comment_deleted', 'You comment was deleted successfully.');

                redirect('posts/show/' . $arr_id[0]);
            } else {
                flash('comment_not_deleted', 'Unable to delete comment now, please try again later.', 'alert alert-danger');

                redirect('posts/show/' . $arr_id[0]);
            }

        } else {

            // Check if page number is undefined
            // * Validate $id number
            if (is_null($id) || !preg_match('~[0-9]+~', $id)) {
                redirect('posts/show/' . $id);

            } else {
                redirect('posts');
            }

        }
    }

}
