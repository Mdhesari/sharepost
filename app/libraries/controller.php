<?php
/**
 * Base Controller
 * Loads models and views
 */
class Controller
{
    // Load model
    public function model($model)
    {
        // check for model file
        if (file_exists('../app/models/' . ucwords($model) . '.php')) {
            // Require model file
            require_once '../app/models/' . ucwords($model) . '.php';
        } else {
            die('model file does not exist');
        }
        
        // Instantiate model
        return new $model();
    }

    public function view($view,$data = [])
    {
        // Check for view file
        if (file_exists('../app/views/' . $view . '.php')) {
            // Require viwe file
            require_once '../app/views/' . $view . '.php';
        } else {
            die('view file doesn\'t exist...');
        }

    }

}
