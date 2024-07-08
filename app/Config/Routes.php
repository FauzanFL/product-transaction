<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'User::index');
$routes->get('/product', 'Product::index');
$routes->group('/product', function ($routes) {
    $routes->get('/', 'Product::index');
    $routes->get('edit/(:num)', 'Product::edit/$1');
    $routes->get('create', 'Product::create');
    $routes->post('save', 'Product::save');
    $routes->post('update/(:num)', 'Product::update/$1');
    $routes->delete('delete/(:num)', 'Product::delete/$1');
});
$routes->group('/facture', function ($routes) {
    $routes->get('/', 'Facture::index');
    $routes->get('edit/(:num)', 'Facture::edit/$1');
    $routes->get('create', 'Facture::create');
    $routes->get('detail/(:num)', 'Facture::detail/$1');
    $routes->get('(:num)/product/add', 'FactureProduct::add/$1');
    $routes->post('product/save', 'FactureProduct::save');
    $routes->delete('product/delete/(:num)', 'FactureProduct::delete/$1');
    $routes->post('save', 'Facture::save');
    $routes->post('update/(:num)', 'Facture::update/$1');
    $routes->delete('delete/(:num)', 'Facture::delete/$1');
});

$routes->post('/', 'User::login');

$routes->add('logout', 'User::logout');
