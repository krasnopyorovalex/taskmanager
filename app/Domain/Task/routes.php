<?php

Route::group(['prefix' => 'task', 'as' => 'task.'], static function () {
    Route::pattern('id', '[0-9]+');

    Route::get('{id}', 'TaskController@show')->name('show');
    Route::get('create', 'TaskController@create')->name('create');
    Route::post('', 'TaskController@store')->name('store');
    Route::get('{id}/edit', 'TaskController@edit')->name('edit');
    Route::put('{id}', 'TaskController@update')->name('update');
    Route::delete('{id}', 'TaskController@destroy')->name('destroy');

});
