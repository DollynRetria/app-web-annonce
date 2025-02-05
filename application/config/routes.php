<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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

$route['default_controller']                         = "page";
$route['admin-utilisateur.html']                     = "utilisateur/listes";
$route['admin-utilisateur/(:num).html']              = "utilisateur/listes/$1";
$route['admin-utilisateur-active-(:num).html']       = "utilisateur/activer/$1";
$route['admin-nouveau-utilisateur.html']             = "utilisateur/nouveauUtilisateur";
$route['admin-suppr-utilisateur-(:num)-(:num).html'] = "utilisateur/deleteUtilisateur/$1/$2";
$route['admin-suppr-utilisateur-(:num).html']        = "utilisateur/deleteUtilisateur/$1";
$route['admin-modifier-utilisateur-(:num).html']     = "utilisateur/modifier/$1";
$route['admin-detail-utilisateur-(:num).html']       = "utilisateur/detail/$1";
//annonces
$route['admin-annonce-(:num).html']       = "admin/annonceDetail/$1";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */