<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// For the account and content creation portion of the application

$routes->group('account', function ($routes) {
    $routes->get('login', 'UserController::index');
    $routes->post('login-account', 'UserController::login');
    $routes->get('register', 'UserController::register');
    $routes->post('register', 'UserController::register');
    $routes->get('forgot-password', 'UserController::forgotPassword');
    $routes->post('forgot-password', 'UserController::forgotPassword');
    $routes->get('reset-password/(:any)', 'UserController::resetPassword/$1');
    $routes->post('reset-password/(:any)', 'UserController::resetPassword/$1');
});

// For the content creation portion of the application

$routes->group('roleplay', function ($routes) {
    $routes->get('home', 'UserPageController::index');
    $routes->get('profile', 'UserPageController::profile');
    $routes->get('settings', 'UserPageController::settings');
    $routes->get('logout', 'UserPageController::logout');
});
