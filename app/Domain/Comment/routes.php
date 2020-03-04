<?php

Route::group(['prefix' => 'comments', 'as' => 'comments.', 'namespace' => 'Api'], static function () {
    Route::pattern('id', '[0-9]+');
    Route::pattern('uuid', '\b[0-9a-f]{8}\b-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-\b[0-9a-f]{12}\b');

    Route::get('task/{uuid}', 'TaskCommentController@show')->name('task.show');
    Route::post('task/{uuid}', 'TaskCommentController@store')->name('task.store');

    Route::get('customer/{id}', 'CustomerCommentController@show')->name('customer.show');
    Route::post('customer/{id}', 'CustomerCommentController@store')->name('customer.store');

//    Route::get('{id}/edit', 'CommentController@edit')->name('edit');
//    Route::put('{id}', 'CommentController@update')->name('update');
//    Route::delete('{id}', 'CommentController@destroy')->name('destroy');
});
