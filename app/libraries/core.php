<?php
/**
 * App Core Class
 * Creates URL & loads core controller
 * URL FORMAT - /Controller/method/params
 */
class Core
{
    protected $currentController = 'Pages';
    protected $currentMethod = 'home';
    protected $params = [];

    public function __construct()
    {
        /**
         * we comment this because we might use it again
         *
        print_r($this->getUrl());
         */
        $url = $this->getUrl();

        if (file_exists(APPROOT . '/controllers/' . ucwords($url[0]) . '.php')) {
            // If exists, set as current controller
            $this->currentController = ucwords($url[0]);
            // Unset url 0 index
            unset($url[0]);
        }

        // Require the controller file
        require_once APPROOT . '/controllers/' . $this->currentController . '.php';

        // Instantiate the controller
        $this->currentController = new $this->currentController;

        // check for second part of url
        if (isset($url[1])) {
            // check to see if method exists in controller
            if (method_exists($this->currentController, strtolower($url[1]))) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }

        }

        // Get params
        $this->params = $url ? array_values($url) : [];
        // Call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

    }

    public function getUrl()
    {
        // echo $_REQUEST['GET'];
        if (isset($_GET['url'])) {
            $url = $_GET['url'];
            $url = rtrim($url, '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }

    }
}
