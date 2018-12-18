<?php

class Pages extends Controller
{
    private $postModel;
    public function __construct()
    {
        $this->postModel = $this->model('Post');
    }

    public function home()
    {

        $data = [
            'title' => "Welcome to home page"
        ];

        $this->view('pages/home',$data);
    }

    public function about($id = [])
    {

        $data = [
            'title' => "Welcome to about page"
        ];

        $this->view('pages/about',$data);
    }
}
