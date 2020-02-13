<?php

Route::group(['prefix' => 'files', 'as' => 'files.'], static function () {
    Route::pattern('id', '[0-9]+');
    Route::pattern('uuid', '\b[0-9a-f]{8}\b-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-\b[0-9a-f]{12}\b');

    Route::get('{uuid}/{id}', 'FileController@download')->name('download');
    Route::post('{uuid}', 'FileController@upload')->name('upload');

    Route::delete('{id}', 'FileController@destroy')->name('destroy');
});
