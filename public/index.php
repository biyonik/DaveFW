<?php

require_once dirname(__DIR__).'/vendor/autoload.php';
$loader = new Twig\Loader\FilesystemLoader(dirname(__DIR__).'/App/Views');


//spl_autoload_register(function ($class) {
//   $root = dirname(__DIR__);
//   $file = $root.'/'.str_replace('\\','/',$class).'.php';
//   if(is_readable($file)) {
//       require $root.'/'.str_replace('\\','/',$class).'.php';
//   }
//});

error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

/**
 * Routing
 */
require '../Core/Router.php';
$router = new Core\Router();

$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
$router->add('posts/', ['controller' => 'Posts', 'action' => 'index']);
$router->add('posts/new', ['controller' => 'Posts', 'action' => 'new']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);
$router->dispatch($_SERVER['QUERY_STRING']);
