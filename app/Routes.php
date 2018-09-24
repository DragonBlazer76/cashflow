<?php
/**
 * Routes - all standard Routes are defined here.
 *
 * @author David Carr - dave@daveismyname.com
 * @author Virgil-Adrian Teaca - virgil@giulianaeassociati.com
 * @version 3.0
 */


/** Define static routes. */

// The default Routing
//Home Modules
Route::get('/',             'App\Controllers\Homedefault@index');
Route::post('contact',      'App\Controllers\Homedefault@contact');
Route::post('subscribe',      'App\Controllers\Homedefault@subscribe');

Route::get('login',         'App\Controllers\Login@index');
Route::post('signin',       'App\Controllers\Login@signin');
Route::get('signout',       'App\Controllers\Login@signout');
Route::get('recover',       'App\Controllers\Login@recover');
Route::post('reset',        'App\Controllers\Login@reset');
Route::get('chgpwd',        'App\Controllers\Login@chgpwd');
Route::post('chgpwd2',      'App\Controllers\Login@chgpwd2');
Route::get('register',      'App\Controllers\Login@register');
Route::post('register2',    'App\Controllers\Login@register2');
Route::post('checkdomain',    'App\Controllers\Login@checkdomain'); //checking domain before signup


Route::get('dashboard',     'App\Controllers\Dashboard@index');
Route::get('getuserfirsttime',      'App\Controllers\Dashboard@getuserfirsttime');
Route::post('updatesupplierfirsttime',    'App\Controllers\Dashboard@updatesupplierfirsttime');
Route::post('updatesuppliersecondtime',    'App\Controllers\Dashboard@updatesuppliersecondtime');
Route::post('changeprofile',    'App\Controllers\Dashboard@changeprofile');
Route::get('getnotification',      'App\Controllers\Dashboard@getnotification');


Route::get('activate',      'App\Controllers\Login@activate');
Route::get('invoice/new/1',      'App\Controllers\Invoice@createinvoice1');
Route::get('invoice/new/2',      'App\Controllers\Invoice@createinvoice2');
Route::get('invoice/new/3',      'App\Controllers\Invoice@createinvoice3');
Route::get('getsupplierdetails',      'App\Controllers\Invoice@getsupplierdetails');
Route::get('getsearchsuppdata',      'App\Controllers\Invoice@getsearchsuppdata');
Route::get('gettaxdetails',      'App\Controllers\Invoice@gettaxdetails');
Route::post('saveinvoice1',      'App\Controllers\Invoice@saveinvoice1');
Route::get('getinvoicedetails',      'App\Controllers\Invoice@getinvoicedetails');
Route::post('updateinvitems',      'App\Controllers\Invoice@updateinvitems');
Route::post('deleteinvitems',      'App\Controllers\Invoice@deleteinvitems');
Route::post('deleteinvoice',      'App\Controllers\Invoice@deleteinvoice');
Route::get('listinvoice',      'App\Controllers\Invoice@listinvoice');
Route::get('listbid',           'App\Controllers\Invoice@listbid');
Route::get('getinvoicelisttble',      'App\Controllers\Invoice@getinvoicelisttble'); //get the invoices list
Route::get('invoice/bid',      'App\Controllers\Invoice@bidinvoice');
Route::post('savebid',      'App\Controllers\Invoice@savebid');
Route::post('rejectbid',      'App\Controllers\Invoice@rejectbid');
Route::get('getbidlisttble',      'App\Controllers\Invoice@getbidlisttble'); //get the invoices list
Route::get('invoice/edit/1',      'App\Controllers\Invoice@editinvoice1');
Route::get('invoice/edit/2',      'App\Controllers\Invoice@editinvoice2');
Route::get('invoice/edit/3',      'App\Controllers\Invoice@editinvoice3');
Route::get('auction/new/1',      'App\Controllers\Auction@createauction1');
Route::post('saveauction1',      'App\Controllers\Auction@saveauction1');
Route::get('getinvoiceforauction',      'App\Controllers\Auction@getinvoiceforauction'); //get the invoices list for auction
Route::get('listauction',      'App\Controllers\Auction@listauction');
Route::get('getauctionlisttble',      'App\Controllers\Auction@getauctionlisttble'); //get the invoices list
Route::get('auction/view',      'App\Controllers\Auction@viewauction'); //get the invoices list
Route::post('cancelauction',      'App\Controllers\Auction@cancelauction');

//For settings
Route::get('profile',               'App\Controllers\Profile@index');
Route::post('profile_password',     'App\Controllers\Profile@profile_password');
Route::post('profile_picture',      'App\Controllers\Profile@profile_picture');
Route::post('personal_profile',     'App\Controllers\Profile@personal_profile');
Route::post('company_profile',      'App\Controllers\Profile@company_profile');
Route::get('supplier_profile',      'App\Controllers\Profile@supplier_profile');

Route::get('notification',      'App\Controllers\Misc@notification');
Route::get('getnotifylist',      'App\Controllers\Misc@getnotifylist');
Route::post('updatenotify',      'App\Controllers\Misc@updatenotify');
Route::post('deletenotify',      'App\Controllers\Misc@deletenotify');

//Route::get('listsuppliers',      'App\Controllers\Suppliers@index');
//Route::get('getsupplierslisttble',      'App\Controllers\Suppliers@getsupplierslisttble');
//Route::get('addsuppliers',      'App\Controllers\Suppliers@addsuppliers1');

/** End default Routes */
