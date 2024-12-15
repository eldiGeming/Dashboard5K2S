<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use CodeIgniter\Router\RouteCollection;

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
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['dashboard'] = 'Dashboard/index';

$route['class'] = 'Dashboard/myclass';

$route['competition'] = 'Dashboard/competition';
$route['competition/kerapihan_lab'] = 'Kompetisi/kerapihan_lab';
$route['competition/keamanan_lab'] = 'Kompetisi/keamanan_lab';
$route['competition/ketertiban_lab'] = 'Kompetisi/ketertiban_lab';
$route['competition/kebersihan_lab'] = 'Kompetisi/kebersihan_lab';

$route['competition/kerapihan_lab_edit/edit/(:num)'] = 'Kompetisi/kerapihan_lab_edit/$1';  // Form Edit
$route['competition/update_kerapihan_lab/(:num)'] = 'Kompetisi/update_kerapihan_lab/$1';
$route['competition/keamanan_lab_edit/edit/(:num)'] = 'Kompetisi/keamanan_lab_edit/$1';  // Form Edit
$route['competition/update_keamanan_lab/(:num)'] = 'Kompetisi/update_keamanan_lab/$1';
$route['competition/ketertiban_lab_edit/edit/(:num)'] = 'Kompetisi/ketertiban_lab_edit/$1';  // Form Edit
$route['competition/update_ketertiban_lab/(:num)'] = 'Kompetisi/update_ketertiban_lab/$1';
$route['competition/kebersihan_lab_edit/edit/(:num)'] = 'Kompetisi/kebersihan_lab_edit/$1';  // Form Edit
$route['competition/update_kebersihan_lab/(:num)'] = 'Kompetisi/update_kebersihan_lab/$1';

$route['login'] = 'login/index';           
$route['login/authenticate'] = 'login/authenticate';
$route['dashboard/logout'] = 'Dashboard/logout';        

$route['no_permission'] = 'no_permission/index';


