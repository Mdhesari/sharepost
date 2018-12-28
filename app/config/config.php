<?php
// Database 
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASSWORD','145780#');
define('DB_NAME','sharepost');

// App root
define('APPROOT',dirname(dirname(__FILE__)));
// URL root
define('URLROOT',"http://localhost/sharepost");
// Current URL
define('CURRENTURL','http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);
// Site name
define('SITE_NAME','Sharepost');
// App version
define('APPVERSION','1.0.0');