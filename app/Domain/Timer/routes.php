<?php

Route::group(['prefix' => 'timer', 'as' => 'timer.', 'namespace' => 'Api'], static function () {
    Route::pattern('uuid', '\b[0-9a-f]{8}\b-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-\b[0-9a-f]{12}\b');

    Route::get('change/{uuid}', 'TimerController@update');

    Route::get('load-timer/{uuid}', 'TimerController@timer');
    Route::get('load-timers', 'TimerController@timers');
});
