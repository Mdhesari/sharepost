<?php
// Config file
require_once 'config/config.php';

require_once 'helpers/url.php';
require_once 'helpers/session.php';
require_once 'helpers/location.php';

// Load libraries
require_once 'libraries/Controller.php';
require_once 'libraries/Core.php';
require_once 'libraries/Database.php';

// Autoload core libraries
spl_autoload_register(function($className){
    require_once 'libraries/' . $className . '.php';    
});

