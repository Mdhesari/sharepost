<?php

/**
 * Controll comments
 */
class Comments extends Controller
{

    public function __construct()
    {

    }

    public function add($id)
    {
        // $params = func_get_args();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Sanitize comment data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'text' => $_POST['comment_text'],
                'post_id' => $id,
            ];

        } else {

            redirect();

        }

    }

    public function delete()
    {

    }

}
