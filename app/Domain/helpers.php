<?php

if (! function_exists('is_main_page')) {
    /**
     * @return bool
     */
    function is_main_page()
    {
        return in_array(request()->path(), ['/']);
    }
}
