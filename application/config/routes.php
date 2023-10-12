<?php
defined('BASEPATH') or exit('No direct script access allowed');


$route['default_controller'] = 'auth';
$route['404_override'] = 'notfound';
$route['translate_uri_dashes'] = FALSE;
//$route['pilar/(:any)'] = 'pilar/index/$1';
$route['login'] = 'auth/login';
$route['user'] = 'users';
$route['forgot_password'] = 'auth/forgot_password';
$route['track_medic'] = 'Medic_track/create';
$route['medical'] = 'Medic_track/medical';
$route['medical/get_Full_data'] = 'Medic_track/get_Full_data';
$route['medical/ekspor_'] = 'Medic_track/exportExcel';
