<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Authentication/login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


// Admin section==============================>

$routes->get('/',             'Authentication::index');
$routes->get('/dashboard',    'Authentication::dashboard');

//End Admin section==============================>


// Dashboard section---->

//============== routes ,                       controller::function_name====> 

// account-control tab>>>>>>>>>>>>>>>>>

$routes->get('/account-control',                'Dashboard::account_control');

// manage customers tab>>>>>>>>>>>>>>>>>

$routes->get('/create-customer',                'Dashboard::create_customer');
$routes->post('/insert',                        'Dashboard::insert');
$routes->get('/edit-customer/(:any)',			'Dashboard::edit_customer/$1');
$routes->post('/edit-customer/(:any)',			'Dashboard::edit_customer/$1');
$routes->get('/manage-customer',                'Dashboard::manage_customer');
$routes->get('/import-customer',                'Dashboard::import_customer');

// manage billers tab>>>>>>>>>>>>>>>>>>>>>

$routes->get('/create-biller',                  'Dashboard::create_biller');
$routes->post('/biller-insert',                 'Dashboard::biller_insert');
$routes->get('/edit-biller/(:any)',             'Dashboard::edit_biller/$1');
$routes->post('/edit-biller/(:any)',            'Dashboard::edit_biller/$1');
$routes->get('/manage-biller',                  'Dashboard::manage_biller');

// manage both i.e customers and biller tabs>>>>>>>>>>>>>>>
$routes->get('/manage-both',                    'Dashboard::manage_customer_biller');
//end account-control tab>>>>>>>>>>>


// create and upload bills tab >>>>>>>>>>>

$routes->get('/create-upload-bills',            'Statements::create_upload_bills');
$routes->get('/generate-statements',            'Statements::generate_statements');

// create and upload bills tab >>>>>>>

// satement-view tab>>>>>>>>>>>>>>>

$routes->get('/statements-view',                'Statements::statements_view');
$routes->get('/utility-statements',             'Statements::utility_statements');

// payment controller------------------------------------------------->

$routes->get('/payments',                       'Payments::payments');
$routes->get('/edit-payments-status/(:any)',    'Payments::edit_payments_status/$1');
$routes->post('/edit-payments-status/(:any)',   'Payments::edit_payments_status/$1');
$routes->get('/card-details',                   'Payments::card_details');
$routes->get('/payment-success',                'Payments::payment_success');

// end payment controller------------------------------------------------->


//end satement-view tab>>>>>>>>>>>>>>>

// statement-view tab=======>>>>>>>>>>>>

$routes->get('/customer-statements',             'Customers::customer_statements');

//end  statement-view=======>>>>>>>>>>>>



// setting edit profile+++++++++++++++++++++++++++++++++>

$routes->get('/edit-profile',                    'Settings::edit_profile');

// end section setting edit profile+++++++++++++++++++++>
























// end Dashboard section---->







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
