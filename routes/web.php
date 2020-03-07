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

use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram;

Route::pattern('id', '[0-9]+');

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth']], static function () {

    Route::get('', 'TaskController@index')->name('tasks.index')->middleware('timers.update');
    Route::get('completed', 'TaskController@completed')->name('tasks.completed');
    Route::get('closed', 'TaskController@closed')->name('tasks.closed');
    Route::get('report', 'ReportController@index')->name('report.index');
    Route::get('report-to-pdf', 'ReportController@pdf')->name('report.pdf');

    foreach (glob(app_path('Domain/**/routes.php')) as $item) {
        require $item;
    }

    Route::group(['middleware' => ['is.admin']], static function () {

        Route::resources([
            'users' => 'UserController',
            'groups' => 'GroupController',
            'customers' => 'CustomerController'
        ]);
    });
});


Route::get('/test', static function () {
    new Telegram(env('TG_API_TOKEN'), env('TG_BOT_NAME'));

    $data = [];
    $data['chat_id'] = 187050562;
    $data['parse_mode'] = 'Markdown';
    $data['text'] = "\x23\xE2\x83\xA3" . " *Поставлена задача № 12*" . "\n";
    $data['text'] .= "*Название:* test" . "\n";
    $data['text'] .= "*Инициатор:* I am" . "\n";
    $data['text'] .= "=============================\n";
    $data['text'] .= '$description' . "\n";

    Request::sendMessage($data);
});
