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

	$route['default_controller'] = "frontpage";
	$route['404_override'] = '';
	//$route['user/(:any)'] = 'user/index/$1';
	//$route['user/(:any)/followers'] = 'user/followers/$2';
	
	if($handle = opendir(APPPATH.'/controllers')){
		while(false !== ($controller = readdir($handle))){
			if($controller != '.' && $controller != '..' && strstr($controller, '.') == '.php'){
			$controllers[] = strstr($controller, '.', true);
			}
		}
		closedir($handle);
	}
	
	$url_parts = explode('/',$_SERVER['REQUEST_URI']);
	$reserved_routes = $controllers;
	 
	// these are the /username routes
	if(!in_array($url_parts[2], $reserved_routes))
	{
		$route['([a-zA-Z]+)/followers'] = 'user/followers/$1';
		$route['([a-zA-Z]+)/following'] = 'user/following/$1';
		$route['([a-zA-Z]+)'] = 'user/index/$1';	
		
	}
/* End of file routes.php */
/* Location: ./application/config/routes.php */
