<?php

Route::group(['prefix' => 'timer', 'as' => 'timer.', 'namespace' => 'Api'], static function () {
    Route::pattern('id', '[0-9]+');

    Route::post('start/{id}', 'TimerController@start')->name('start');
    Route::post('stop/{id}', 'TimerController@stop')->name('stop');
});
