<?php

Route::group(['prefix' => 'comments', 'as' => 'comments.'], function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', 'CommentController@index')->name('index');
    Route::get('create', 'CommentController@create')->name('create');
    Route::post('', 'CommentController@store')->name('store');
    Route::get('{id}/edit', 'CommentController@edit')->name('edit');
    Route::put('{id}', 'CommentController@update')->name('update');
    Route::delete('{id}', 'CommentController@destroy')->name('destroy');

});
