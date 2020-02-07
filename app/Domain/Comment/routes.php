<?php

Route::group(['prefix' => 'comments', 'as' => 'comments.', 'namespace' => 'Api'], static function () {
    Route::pattern('id', '[0-9]+');
    Route::pattern('uuid', '\b[0-9a-f]{8}\b-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-\b[0-9a-f]{12}\b');

    Route::get('{uuid}', 'CommentController@load');

    Route::post('{uuid}', 'CommentController@store')->name('store');

//    Route::get('{id}/edit', 'CommentController@edit')->name('edit');
//    Route::put('{id}', 'CommentController@update')->name('update');
//    Route::delete('{id}', 'CommentController@destroy')->name('destroy');
});
