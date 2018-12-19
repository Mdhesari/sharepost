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
        $posts = $this->postModel->getPosts();

        $data = [
            'title' => "Welcome to home page",
            'posts' => $posts
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
