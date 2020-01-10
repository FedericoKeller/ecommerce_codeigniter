<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = "login";
$route['home'] = "cargar_vistas/home";
$route['cart'] = "product/index";
$route['show_cart'] = "product/load_cart";
$route['delete_cart/(:num)'] = "product/delete_cart/$1";
$route['delete_element_cart/(:num)'] = "product/delete_element_cart/$1";
$route['electronica'] = "product/get_electronica";
$route['electrica'] = "product/get_electrica";
$route['mecanica'] = "product/get_mecanica";
$route['loginUser'] = "user_authentication/index";
$route['userPage'] = "cargar_vistas/mypage";
$route['userLogout'] = "user_authentication/logout";
$route['404_override'] = 'login/error';
$route['facturacion'] = "factura_controller/index";
$route['addFactura'] = "factura_controller/addNewFacturacion";
$route['tarjeta'] = "factura_controller/tarjeta";
$route['pagar'] = "factura_controller/pagar";
$route['addUserInfo'] = "user_authentication/addUserInfo";

/*********** USER DEFINED ROUTES *******************/

$route['loginMe'] = 'login/loginMe';
$route['dashboard'] = 'user';
$route['logout'] = 'user/logout';

/*********** ADMIN CONTROLLER ROUTES *******************/
$route['noaccess'] = 'login/noaccess';
$route['userListing'] = 'admin/userListing';
$route['employeeListing'] = 'admin/employeeListing';
$route['userListing/(:num)'] = "admin/userListing/$1";
$route['addNew'] = "admin/addNew";
$route['addNewUser'] = "admin/addNewUser";
$route['editOld'] = "admin/editOld";
$route['editOld/(:num)'] = "admin/editOld/$1";
$route['editUser'] = "admin/editUser";
$route['deleteUser'] = "admin/deleteUser";
$route['log-history'] = "admin/logHistory";
$route['log-history/(:num)'] = "admin/logHistorysingle/$1";
$route['log-history/(:num)/(:num)'] = "admin/logHistorysingle/$1/$2";
$route['backupLogTable'] = "admin/backupLogTable";
/*********** MANAGER CONTROLLER ROUTES *******************/
$route['tasks'] = "manager/tasks";
$route['addNewTask'] = "manager/addNewTask";
$route['addNewTasks'] = "manager/addNewTasks";
$route['editOldTask/(:num)'] = "manager/editOldTask/$1";
$route['editTask'] = "manager/editTask";
$route['deleteTask/(:num)'] = "manager/deleteTask/$1";
$route['piezas'] = "manager/piezas";
$route['addNewPieza'] = "manager/addNewPieza";
$route['addNewPiezas'] = "manager/addNewPiezas";
$route['editOldPieza/(:num)'] = "manager/editOldPieza/$1";
$route['editPieza'] = "manager/editPieza";
$route['deletePieza/(:num)'] = "manager/deletePieza/$1";
$route['salesListing'] = "manager/salesListing";

/*********** USER CONTROLLER ROUTES *******************/
$route['loadChangePass'] = "user/loadChangePass";
$route['changePassword'] = "user/changePassword";
$route['pageNotFound'] = "user/pageNotFound";
$route['checkEmailExists'] = "user/checkEmailExists";
$route['endTask/(:num)'] = "user/endTask/$1";
$route['etasks'] = "user/etasks";
$route['editOldPieza/(:num)'] = "user/editOldPieza/$1";
$route['editPieza'] = "user/editPieza";
$route['epiezas'] = "user/epiezas";
$route['userEdit'] = "user/loadUserEdit";
$route['updateUser'] = "user/updateUser";


/*********** LOGIN CONTROLLER ROUTES *******************/
$route['forgotPassword'] = "login/forgotPassword";
$route['resetPasswordUser'] = "login/resetPasswordUser";
$route['resetPasswordConfirmUser'] = "login/resetPasswordConfirmUser";
$route['resetPasswordConfirmUser/(:any)'] = "login/resetPasswordConfirmUser/$1";
$route['resetPasswordConfirmUser/(:any)/(:any)'] = "login/resetPasswordConfirmUser/$1/$2";
$route['createPasswordUser'] = "login/createPasswordUser";

/* End of file routes.php */
/* Location: ./application/config/routes.php */
