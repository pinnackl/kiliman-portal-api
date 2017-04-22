<?php

$loader = require_once __DIR__.'/../vendor/autoload.php';
$loader->add('Pinnackl\Controller', realpath(__DIR__.'/..').'/src');
$loader->add('Pinnackl\Helper', realpath(__DIR__.'/..').'/src');

// Init application
$app = new Silex\Application();

// Dev purpose
$app['debug'] = true;

$helper = new Pinnackl\Helper\Config(realpath(__DIR__.'/..').'/config/config.php');

$app['helper'] = $helper;

// Lazy instanciate controller class
$toController = function($shortClass, $shortMethod)
{
	return sprintf('Pinnackl\Controller\%s::%sAction', $shortClass, $shortMethod);
};

/**
 * API backend API
 */
$app->post('/api/create', $toController('KilimanApi', 'create'));
$app->get('/apis', $toController('KilimanApi', 'list'));
$app->get('/api/show/{id}', $toController('KilimanApi', 'show'));
$app->put('/api/update/{id}', $toController('KilimanApi', 'update'));

/**
 * User API
 */
$app->post('/user/create', $toController('KilimanUser', 'create'));
$app->get('/users', $toController('KilimanUser', 'list'));
$app->get('/user/show/{id}', $toController('KilimanUser', 'show'));
$app->put('/user/update/{id}', $toController('KilimanUser', 'update'));

/**
 * Config API
 */
// FIXME : Fix those request
// $app->post('/config/publish', $toController('KilimanConfig', 'publish'));
// $app->get('/config/changes', $toController('KilimanConfig', 'changes'));

$app->run();