<?php

use Illuminate\Support\HtmlString;

if (! function_exists('svg')) {
    function svg($symbol): HtmlString {
        return new HtmlString(
            '<svg>
                <use xlink:href="' . asset("img/sprites/sprite.svg#{$symbol}") . '"></use>
            </svg>'
        );
    }
}
