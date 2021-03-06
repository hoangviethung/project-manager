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
$route['default_controller'] = 'main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//Default
$route['admin'] = 'cms/main';
$route['dashboard/login'] = 'auth';
$route['dashboard/logout'] = 'auth/logout';
$route['dashboard/group'] = 'default/group';
$route['dashboard/project'] = 'default/project';
$route['dashboard/user'] = 'default/user';
$route['dashboard/user/edit_user_save'] = 'default/user/edit_user_save';
$route['dashboard/task'] = 'default/task';
$route['dashboard/(:any)'] = 'dashboard/$1';
$route['dashboard'] = 'dashboard';

$route['confirm_group_invite'] = 'main/confirm_group_invite';

//Register
$route['forget_password'] = 'main/forgetPassword';
$route['register_save'] = 'main/registerSave';


// $route['product'] = 'default/product';
// $route['about'] = 'default/about';
// $route['partner'] = 'default/partner';
// $route['gallery'] = 'default/gallery';
// $route['gallery/(:any)'] = 'default/gallery/$1';
// $route['tintuc'] = 'default/tintuc';
// $route['tintuc/(:any)'] = 'default/tintuc/details/$1';
// $route['thucdon'] = 'default/thucdon';
// $route['thucdon/ajax/getpage'] = 'default/thucdon/getPageAjax';
// $route['thucdon/(:any)'] = 'default/thucdon/danh_muc/$1';
// $route['gioithieu'] = 'default/gioithieu';
// $route['dattiec'] = 'default/dattiec';
// $route['dichvu'] = 'default/dichvu';
// $route['khuyenmai'] = 'default/khuyenmai';
// $route['tuyendung'] = 'default/tuyendung';
// $route['lienhe'] = 'default/lienhe';
// $route['hinhanh'] = 'default/gallery';
// $route['hinhanh/ajax/getpage'] = 'default/gallery/getPageAjax';

//admin
