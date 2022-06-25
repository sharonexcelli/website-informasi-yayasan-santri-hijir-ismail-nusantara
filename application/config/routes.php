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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'main/home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['gallery'] = 'main/gallery';
$route['gallery/page/(:any)'] = 'main/gallery/$1';
$route['contactus'] = 'main/contactus';
$route['send-contactus'] = 'main/send_contactus';
$route['terms-and-condition'] = 'main/terms_and_condition';
$route['privacy-and-policy'] = 'main/privacy_and_policy';
$route['frequently-asked-questions'] = 'main/faq';
$route['get-ready'] = 'main/coming';
$route['events'] = 'main/events';
$route['events/page/(:any)'] = 'main/events/$1';
$route['events/detail/(:any)'] = 'main/events_detail/$1';
$route['profile-alumni'] = 'main/quotes';
$route['profile-alumni/page/(:any)'] = 'main/quotes/$1';
$route['profile-alumni/detail/(:any)'] = 'main/quotes_detail/$1';



$route['news'] = 'main/news';
$route['news/page/(:any)'] = 'main/news/$1';
$route['news/detail/(:any)'] = 'main/news_detail/$1';
$route['central-management'] = 'main/central_man';
$route['central-management/page/(:any)'] = 'main/central_man/$1';
$route['regional-management'] = 'main/regional_man';
$route['regional-management/page/(:any)'] = 'main/regional_man/$1';
$route['aboutus'] = 'main/aboutus';
$route['general-policy'] = 'main/general_policy';


$route['pendidikan-umum'] = 'main/pendidikan_umum';
$route['pendidikan-khusus'] = 'main/pendidikan_khusus';
$route['profile-pengajar'] = 'main/quotes';
$route['profile-pengajar/page/(:any)'] = 'main/quotes/$1';
$route['profile-pengajar/detail/(:any)'] = 'main/quotes_detail/$1';


// cms
$route['cms/auth'] = 'cms/auth';
$route['cms/auth/do-login'] = 'cms/auth/do_login';
$route['cms/auth/do-logout'] = 'cms/main/logout';

$route['cms'] = 'cms/main';
$route['cms/dashboard'] = 'cms/dashboard';
