<?php 

require_once 'config/config.php';
require_once 'helpers/url_helper.php';

//autoload core libraries

spl_autoload_register(function($className){
    require_once 'libraries/' . $className . '.php';
});