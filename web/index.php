<?php

$loader = require_once __DIR__.'/../vendor/autoload.php';
$loader->add('Pinnackl\Controller', realpath(__DIR__.'/..').'/src');
$loader->add('Pinnackl\Helper', realpath(__DIR__.'/..').'/src');

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

$app = new Silex\Application();

$app['debug'] = true;

$helper = new Pinnackl\Helper\Config(realpath(__DIR__.'/..').'/config/config.php');

$app['helper'] = $helper;

// Convert application/json data to Array
// $app->before(function (Request $request) {
//     if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
//         $data = json_decode($request->getContent(), true);
//         $request->request->replace(is_array($data) ? $data : array());
//     }
// });

$toController = function($shortClass, $shortMethod)
{
	return sprintf('Pinnackl\Controller\%s::%sAction', $shortClass, $shortMethod);
};

/**
 * API backend API
 */
// $app->post('/api/create', $toController('KilimanApi', 'create'));
$app->get('/apis', $toController('KilimanApi', 'list'));
$app->get('/api/show/{id}', $toController('KilimanApi', 'show'));
// $app->put('/api/update', $toController('KilimanApi', 'update'));
// $app->delate('/api/delate', $toController('KilimanApi', 'delate'));
/**
 * User API
 */
$app->post('/user/create', $toController('KilimanUser', 'create'));
$app->get('/users', $toController('KilimanUser', 'list'));
$app->get('/user/show/{id}', $toController('KilimanUser', 'show'));
// $app->put('/api/update', $toController('KilimanApi', 'update'));
// $app->delate('/api/delate', $toController('KilimanApi', 'delate'));

$app->run();