<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "/main";
$route['main'] = "/main/login_reg_view";
$route['dashboard'] = "/main/dashboard_view";
$route['add'] = "/main/add_view";
$route['add_form'] = "/main/add_form";

$route['remove_from_list/(:num)'] = "/main/remove_from_list/$1";
$route['add_to_list/(:num)'] = "/main/add_to_list/$1";
$route['wish_items/(:num)'] = "main/wish_items_view/$1";
$route['wish_items/create'] = "main/create_view";
$route['logout'] = "/main/logout";
$route['404_override'] = '';


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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

/* End of file routes.php */
/* Location: ./application/config/routes.php */
