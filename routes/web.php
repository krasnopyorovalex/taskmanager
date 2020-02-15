<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::pattern('id', '[0-9]+');

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth']], static function () {

    Route::get('', 'TaskController@index')->name('tasks.index')->middleware('timers.update');
    Route::get('completed', 'TaskController@completed')->name('tasks.completed');
    Route::get('closed', 'TaskController@closed')->name('tasks.closed');

    foreach (glob(app_path('Domain/**/routes.php')) as $item) {
        require $item;
    }

    Route::group(['middleware' => ['is.admin']], static function () {

        Route::resources([
            'users' => 'UserController',
            'groups' => 'GroupController',
            'billing' => 'BillingController'
        ]);
    });
});
