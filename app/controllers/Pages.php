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
            'title' => "SHARE POST",
            'description' => "Great web application to communicate, Available for everyone... <br> Built on the Travercy MVC PHP frame work.",
        ];

        $this->view('pages/home', $data);
    }

    public function about($id = [])
    {

        $data = [
            'title' => "About us",
            'description'=>"App to share posts with your friends."
        ];

        $this->view('pages/about', $data);
    }
    
}
