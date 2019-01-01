<?php
/**
 * Users Controller & colaborating views and models
 * Get and Set data from/to database
 */
class Users extends Controller
{

    private $userModel;
    protected $pass_limit;

    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->pass_limit = 6;
    }

    public function login()
    {
        // Check for post request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email-username' => trim($_POST['email-username']),
                'password' => trim($_POST['password']),
                'email-username_err' => '',
                'password_err' => '',
                'error' => false
            ];

            // Validate email
            if (empty($data['email-username'])) {
                $data['email-username_err'] = 'enter your correct email or username.';

            }

            // Validate password
            if(mb_strlen($data['password']) < $this->pass_limit){
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
            if(!$data['error']){
                // There are no errors
                
            }else {
                $this->view('users/login',$data);

            }

        } else {

            $data = [
                'email-username' => '',
                'password' => '',
                'email-username_err' => '',
                'password_err' => '',
                'error'=>false
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
                'error' => false
            ];

            // Validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'enter your email.';

            } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['email_err'] = 'email is invalid, please enter valid emai.';

            } else if($this->userModel->findByEmail($data['email'])){
                $data['email_err'] = 'email is already exists.';

            }

            // Validate username
            if (empty($data['username'])) {
                $data['username_err'] = 'enter an username.';

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
                

            }else {
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
                'error' => false
            ];

            $this->view('users/register', $data);
        }
    }

}
