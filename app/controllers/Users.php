<?php
/**
 * Users Controller & colaborating views and models
 * Get and Set data to database
 */
class Users extends Controller
{

    private $userModel;
    protected $pass_limit;
    protected $username_limit;

    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->pass_limit = 6;
        $this->username_limit = 3;
    }

    public function home(){
        redirect('users/login');
        
    }

    public function logout(){
        // Destroy sessions
        logoutUser();
        
    }   

    public function dashboard(){
        echo 'dashboard';
    }

    public function login()
    {
        // Check for post request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $user = '';

            $data = [
                'email-username' => trim($_POST['email-username']),
                'password' => trim($_POST['password']),
                'email-username_err' => '',
                'password_err' => '',
                'error' => false,
            ];

            // Validate email
            if (empty($data['email-username'])) {
                $data['email-username_err'] = 'enter your correct email or username.';

            } else if (!filter_var($data['email-username'], FILTER_VALIDATE_EMAIL)) {
                if (!$this->userModel->findByUsername($data['email-username'])) {
                    $data['email-username_err'] = 'username is incorrect.';

                } else {
                    $user = $this->userModel->findByUsername($data['email-username'], true);
                }

            } else if (!$this->userModel->findByEmail($data['email-username'])) {
                $data['email-username_err'] = 'email doesn\'t exists.';

            } else {
                $user = $this->userModel->findByEmail($data['email-username'], true);

            }

            // Validate password
            if (mb_strlen($data['password']) < $this->pass_limit) {
                $data['password_err'] = 'your password is incorrect.';

            }

            // lookup on array in order to see if there are errors
            foreach ($data as $key => $value) {
                // check if its error type
                if (strpos($key, '_err') != false) {
                    if (strlen($value) != '') {
                        $data['error'] = true;
                    }

                }

            }

            // Submit registeration if there are no errors
            if (!$data['error']) {
                // There are no errors
                $data['user'] = $user;
                // Check and set logged in user
                $loggedInUser = $this->userModel->login($data);

                if ($loggedInUser) {
                    // Create sessions
                    createUserSession($data['user']);

                } else {
                    // Error
                    $data['password_err'] = 'passwords don\'t match.';

                    $this->view('users/login',$data);
                }

            } else {
                $this->view('users/login', $data);

            }

        } else {

            $data = [
                'email-username' => '',
                'password' => '',
                'email-username_err' => '',
                'password_err' => '',
                'error' => false,
            ];

            $this->view('users/login', $data);
        }
    }

    public function register()
    {
        // Check for post request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'fullname' => stripslashes(trim(ucwords($_POST['fullname']))),
                'email' => stripslashes(trim(strtolower($_POST['email']))),
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'password_confirm' => trim($_POST['password_confirm']),
                'gender' => isset($_POST['gender']) ? $_POST['gender'] : '',
                'fullname_err' => '',
                'email_err' => '',
                'username_err' => '',
                'password_err' => '',
                'password_confirm_err' => '',
                'error' => false,
            ];

            // Validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'enter your email.';

            } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['email_err'] = 'email is invalid, please enter valid emai.';

            } else if ($this->userModel->findByEmail($data['email'])) {
                $data['email_err'] = 'email is already exists.';

            }

            // Validate username
            if (empty($data['username'])) {
                $data['username_err'] = 'enter an username.';

            } elseif (strlen($data['username']) < $this->username_limit) {
                $data['username_err'] = 'username must be at least 3 characters.';

            } elseif ($this->userModel->findByUsername($data['username'])) {
                $data['username_err'] = 'username is already taken by someone else.';

            }

            // Validate passwords
            if (mb_strlen($data['password'], 'UTF-8') < $this->pass_limit) {
                $data['password_err'] = 'password must be more than 8 characters.';
            } else if ($data['password'] !== $data['password_confirm']) {
                $data['password_confirm_err'] = 'passwords don\'t match.';
            }

            // Validate full name
            if (mb_strlen($data['fullname'], 'UTF-8') < 3) {
                $data['fullname_err'] = 'full name must be more than 3 characters.';
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

            // Submit registeration if there are no errors
            if (!$data['error']) {
                // There are no errors
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Put user's info on database
                if ($this->userModel->register($data)) {
                    flash('register_success', 'Your account was created, Now you can sign up.');
                    redirect('users/login');

                } else {
                    die('Something went wrong!');
                }

            } else {
                // There are errors
                $this->view('users/register', $data);
            }

        } else {
            $data = [
                'fullname' => '',
                'email' => '',
                'username' => '',
                'password' => '',
                'password_confirm' => '',
                'fullname_err' => '',
                'email_err' => '',
                'username_err' => '',
                'password_err' => '',
                'password_confirm_err' => '',
                'error' => false,
            ];

            $this->view('users/register', $data);
        }
    }

}
