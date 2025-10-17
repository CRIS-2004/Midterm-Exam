<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//Nav Bars
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/contact', 'Home::contact');

//Annoucement
$routes->get('/announcements', 'Announcement::index');

//teacher, admin, student
$routes->get('/teacher/dashboard', 'Teacher::dashboard');
$routes->get('/admin/dashboard', 'Admin::dashboard');
$routes->get('/announcements', 'Announcements::index'); // assuming you have this

$routes->group('admin', ['filter' => 'roleauth'], function($routes){
    $routes->get('dashboard', 'Admin::dashboard');
});

$routes->group('teacher', ['filter' => 'roleauth'], function($routes){
    $routes->get('dashboard', 'Teacher::dashboard');
});



//Lab 4
$routes->get('/register', 'Auth::register');     
$routes->post('/register', 'Auth::register'); 
$routes->get('/login', 'Auth::login');           
$routes->post('/login', 'Auth::login');         
$routes->get('/logout', 'Auth::logout');         
$routes->get('/dashboard', 'Auth::dashboard');   


