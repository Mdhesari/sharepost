<?php
/**
 * Pages Controller & connecting views and models
 * Manage database data
 * Display requested page
 */
class Pages extends Controller
{

    public function __construct()
    {

    }

    public function home()
    {

        $data = [
            'title' => "Travercy MVC",
        ];

        $this->view('pages/home', $data);
    }

    public function about($id = [])
    {

        $data = [
            'title' => "Welcome to about page",
        ];

        $this->view('pages/about', $data);
    }
    
}
