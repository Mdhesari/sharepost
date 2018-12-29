<?php
/**
 * Users Controller & colaborating views and models
 * Get and Set data from/to database
 */
class Users extends Controller
{

    public function __construct()
    {

    }

    public function login()
    {
        // Check for post request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        } else {

            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
            ];

            $this->view('users/login', $data);
        }
    }

    public function register()
    {
        // Check for post request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        } else {
            $data = [
                'fullname' => '',
                'email' => '',
                'password' => '',
                'password_confirm' => '',
                'fullname_err' => '',
                'email_err' => '',
                'password_err' => '',
                'password_confirm_err' => '',
            ];
            $this->view('users/register', $data);
        }
    }

}
