<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['dashboard'] = 'welcome';
//user
$route['login'] = 'user/login';
$route['login/register'] = 'user/register';

// project
$route['project'] = 'category';
$route['project/add'] = 'category/create';
$route['project/edit/(:num)'] = 'category/edit/$1';
$route['project/delete/(:num)'] = 'category/delete';
// resorts
$route['resort'] = 'resorts';
$route['resort/add'] = 'resorts/create';
$route['resort/edit/(:num)'] = 'resorts/edit/$1';
$route['resort/delete/(:num)'] = 'resorts/delete';
// slider
$route['slider'] = 'slider';
$route['slider/add'] = 'slider/add';
$route['slider/edit/(:num)'] = 'slider/edit/$1';
$route['slider/delete/(:num)'] = 'slider/delete';

// Blogs
$route['blog'] = 'blog';
$route['blog/add'] = 'blog/add';
$route['blog/edit/(:num)'] = 'blog/edit/$1';
$route['blog/delete/(:num)'] = 'blog/delete/$1';

// Event
$route['event'] = 'event';
$route['event/add'] = 'event/add';
$route['event/edit/(:num)'] = 'event/edit/$1';
$route['event/delete/(:num)'] = 'event/delete';
// Discount
$route['discount'] = 'discount';
$route['discount/add'] = 'discount/add';
$route['discount/edit/(:num)'] = 'discount/edit/$1';
$route['discount/delete/(:num)'] = 'discount/delete';
// Gallery
$route['gallery'] = 'gallery';
$route['gallery'] = 'gallery/view';
$route['gallery/add'] = 'gallery/add';
$route['gallery/edit/(:num)'] = 'gallery/edit/$1';
$route['gallery/delete/(:num)'] = 'gallery/delete';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
