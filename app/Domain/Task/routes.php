<?php

Route::group(['prefix' => 'tasks', 'as' => 'tasks.'], static function () {
    Route::pattern('uuid', '\b[0-9a-f]{8}\b-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-\b[0-9a-f]{12}\b');

    Route::get('{uuid}', 'TaskController@show')->name('show')->middleware('timers.update');
    Route::get('create', 'TaskController@create')->name('create');
    Route::post('', 'TaskController@store')->name('store');
    Route::post('{uuid}/update', 'TaskController@update')->name('update');
    Route::post('{uuid}/complete', 'TaskController@complete')->name('complete');
    Route::delete('{uuid}', 'TaskController@destroy')->name('destroy');
});
