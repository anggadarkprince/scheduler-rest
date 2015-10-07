<?php
/**
 * Created by PhpStorm.
 * User: Angga Ari Wijaya
 * Date: 1/19/15
 * Time: 9:49 PM
 */

define('ENVIRONMENT', 'development');
if(defined('ENVIRONMENT'))
{
    switch (ENVIRONMENT)
    {
        case 'development':
            error_reporting(E_ALL);
            break;

        case 'testing':
        case 'production':
            error_reporting(0);
            break;

        default:
            exit('The application environment is not set correctly.');
    }
}

require_once __DIR__ . "/AutoLoader.php";
use lib\MVC\Router;

$kernel = new Router($_GET);
$controller = $kernel->getController();
$controller->ExecuteAction();