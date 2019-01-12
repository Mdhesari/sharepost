<?php
/**
 * Posts Controller & connecting views and models
 * Manage database data
 * Display requested page
 */

class Posts extends Controller
{

    private $postModel;
    private $userModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Sanitize post data
            // * This filter removes data that is potentially harmful for your application. It is used to strip tags and remove or encode unwanted characters.
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'description' => $_POST['description'],
                'text' => $_POST['text'],
                'post_id' => $id,
                'image' => $_FILES['image'],
                'image_err' => '',
                'description_err' => '',
                'text_err' => '',
                'error' => '',
            ];

            if (!empty($data['image']['name'])) {
                $result = imageAddPost($data['image'], $_SESSION['user_id']);

                if (!empty($result['error'])) {
                    $data['image_err'] = $result['error'];
                } else {
                    $data['image'] = $result['img_src'];
                }
            }

            // Validate description
            if (empty($data['description'])) {
                $data['description_err'] = 'you must enter description.';

            }

            // Validate text
            if (strlen($data['text']) < 10) {
                $data['text_err'] = 'you must enter at least 10 characters for text field.';

            }

            // lookup on array in order to see if there are errors
            foreach ($data as $key => $value) {

                // Check if its error type
                if (strpos($key, '_err') != false) {
                    if (strlen($value) != '') {
                        $data['error'] = true;
                    }
                }

            }

            if (!$data['error']) {
                if ($this->postModel->edit($data)) {
                    flash('editpost-success', 'Post was edited successfully.');
                    redirect('posts');
                } else {
                    // error
                    flash('editpost-fail', 'Post was not Edited, there were something wrong. Please try again later!');
                    redirect('posts/edit/' . $id);
                }

            } else {
                $this->view('posts/edit', $data);

            }

        } else {

            $post = $this->postModel->fetchById($id);

            if ($post->user_id != $_SESSION['user_id']) {
                redirect('posts');
            }

            $data = [
                'description' => $post->description,
                'text' => $post->text,
                'post_id' => $post->id,
                'image' => !empty($post->image) ? URLROOT . '/assets/pictures/posts/' . $_SESSION['user_id'] . '/' . $post->image:'',
                'image_err' => '',
                'description_err' => '',
                'text_err' => '',
                'error' => '',
            ];

            $this->view('posts/edit', $data);
        }
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $result = $this->postModel->delete($id);

            if ($result) {
                // Delete was successful
                flash('delete-success', '<i class="fa fa-trash"></i> Post was deleted successfully.');

                redirect('posts');
            } else {
                // Error on deleting post

            }
        } else {
            $this->show($id);
        }
    }

    public function show($id)
    {
        if (empty($id)) {
            redirect('posts');
        }

        $post = $this->postModel->fetchById($id);

        if ($post === false) {
            redirect('posts');
        }

        $user = $this->userModel->findById($post->user_id, true);

        $data = [
            'post' => $post,
            'user' => $user,
        ];

        $this->view('posts/show', $data);
    }

    public function add()
    {

        // Check for post request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Sanitize post data
            // * This filter removes data that is potentially harmful for your application. It is used to strip tags and remove or encode unwanted characters.
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'description' => ucwords($_POST['description']),
                'text' => ucfirst($_POST['text']),
                'user_id' => $_SESSION['user_id'],
                'image' => $_FILES['image'],
                'image_err' => '',
                'description_err' => '',
                'text_err' => '',
                'error' => false,
            ];

            if (!empty($data['image']['name'])) {
                $result = imageAddPost($data['image'], $_SESSION['user_id']);

                // Check error
                if (!empty($result['error'])) {
                    $data['image_err'] = $result['error'];

                } else {
                    $data['image'] = $result['img_src'];
                }

            }

            // Validate description
            if (empty($data['description'])) {
                $data['description_err'] = 'you must enter description.';

            }

            // Validate text
            if (strlen($data['text']) < 10) {
                $data['text_err'] = 'you must enter at least 10 characters for text field.';

            }

            // lookup on array in order to see if there are errors
            foreach ($data as $key => $value) {

                // Check if its error type
                if (strpos($key, '_err') != false) {
                    if (strlen($value) != '') {
                        $data['error'] = true;
                    }
                }

            }

            // Store post if there are no errors
            if (!$data['error']) {
                // Add and check if everything works
                if ($this->postModel->add($data)) {
                    flash('addpost-success', 'New post was added successfully.');
                    redirect('posts');

                } else {
                    flash('addpost-fail', 'Post was not added, there were something wrong. Please try again later!', 'alert alert-warning');
                    redirect('posts/add');
                }

            } else {
                $this->view('posts/add', $data);
            }

        } else {

            $data = [
                'description' => '',
                'text' => '',
                'user_id' => $_SESSION['user_id'],
                'image' => '',
                'image_err' => '',
                'description_err' => '',
                'text_err' => '',
                'error' => false,
            ];

            $this->view('posts/add', $data);

        }

    }

    public function home()
    {

        $posts = $this->postModel->fetchAll();

        $data = [
            'posts' => $posts,
        ];

        $this->view('posts/home', $data);
    }

}
