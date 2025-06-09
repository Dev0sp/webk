<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('dbg', 'Auth::index');
$routes->get('logout', 'Auth::logout');
$routes->get('dashboard', 'User::index');
$routes->post('dashboard', 'User::Server');
$routes->match(['get', 'post'], '/', 'Auth::login');
$routes->match(['get', 'post'], 'login', 'Auth::login');
$routes->match(['get', 'post'], 'register', 'Auth::register');//Server
$routes->match(['get', 'post'], 'userLogs', 'Auth::userLogs');
$routes->match(['get', 'post'], 'createUser', 'User::createUser');

$routes->match(['get', 'post'], 'reset', 'Auth::reset');


//
$routes->match(['get', 'post'], 'settings', 'User::settings');
$routes->match(['get', 'post'], 'settings1', 'SettingsController::settings1');
$routes->match(['get', 'post'], 'Server', 'User::Server');
$routes->match(['get', 'post'], 'player', 'Player::index');
$routes->match(['get'],'alter','User::alterUser');



$routes->get('/upload', 'Main::index');
$routes->match(['get', 'post'], 'upload', 'Main::upload');
$routes->match(['get', 'post'], 'Create', 'Main::Create');
$routes->match(['get', 'post'], 'resetPassword', 'Main::resetPassword');
$routes->match(['get', 'post'], 'Bypass', 'Main::Bypass');
$routes->match(['get', 'post'], 'OnlineBypass', 'Main::OnlineBypass');




$routes->match(['get', 'post'], 'notify', 'Main::notify');
$routes->match(['get', 'post'], 'Show', 'Main::Show');
$routes->match(['get', 'post'],'bullet_On', 'Memo::bullet_On');
$routes->match(['get', 'post'],'bullet_Off', 'Memo::bullet_Off');
$routes->match(['get', 'post'],'Memory_On', 'Memo::Memory_On');
$routes->match(['get', 'post'],'Memory_Off', 'Memo::Memory_Off');
$routes->match(['get', 'post'],'blockKey', 'Memo::blockKey');
$routes->match(['get', 'post'],'ResetKey', 'Memo::ResetKey');
$routes->match(['get', 'post'],'resetKeyOne', 'Memo::resetKeyOne');
$routes->match(['get', 'post'],'loginreset', 'Memo::loginreset');

$routes->get('/Memo', 'Main::index');
$routes->match(['get', 'post'],'memory', 'Memo::index');


$routes->group('keys', function ($routes) {

	
	
	$routes->match(['get', 'post'], '/', 'Keys::index');
	$routes->match(['get', 'post'], 'generate', 'Keys::generate');
	$routes->get('(:num)', 'Keys::edit_key/$1');
	$routes->get('reset', 'Keys::api_key_reset');
	$routes->post('edit', 'Keys::edit_key');
	$routes->match(['get', 'post'], 'api', 'Keys::api_get_keys');
	
	
	$routes->match(['get'],'active','Keys::Keyactive');
	$routes->match(['get'],'inactive','Keys::Keyinactive');
	$routes->get('delete','Keys::api_key_delete');
	$routes->match(['get'],'alter','Keys::alterKeys');
	$routes->match(['get'],'resetAll','Keys::resetAllKeys');
	$routes->match(['get'],'download/all','Keys::download_all_Keys');
	$routes->match(['get'],'download/new','Keys::download_new_Keys');
	$routes->match(['get'],'deleteAll','Keys::deleteKeys');
	$routes->match(['get'],'deleteKeys','Keys::deleteKeys');

	$routes->match(['get'],'start','Keys::startDate');
});






$routes->group('admin', ['filter' => 'admin'], function ($routes) {
	$routes->match(['get', 'post'], 'create-referral', 'User::ref_index');
	$routes->match(['get', 'post'], 'manage-users', 'User::manage_users');
	$routes->match(['get', 'post'], 'user/(:num)', 'User::user_edit/$1');
	$routes->match(['get'],'user/alter','User::alterUser');
	$routes->match(['get', 'post'],'user/singledelete/(:num)','User::singleDelete/$1');
	/* --------------------------- Admin API Grouping -------------------------- */
	$routes->group('api', function ($routes) {
		$routes->match(['get', 'post'], 'users', 'User::api_get_users');
	});
});

$routes->match(['get', 'post'], 'connect', 'Connect::index');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
