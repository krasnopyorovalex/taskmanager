<?php

use Illuminate\Support\HtmlString;

if (! function_exists('svg')) {
    function svg($symbol): HtmlString
    {
        return new HtmlString(
            '<svg class="svg-element">
                <use xlink:href="' . asset("img/sprites/sprite.svg#{$symbol}") . '"></use>
            </svg>'
        );
    }
}

if (! function_exists('loop_index_by_pagination')) {
    function loop_index_by_pagination($iteration, $paginateStep = 15): int {
        $page = request('page') ? request('page') - 1 : 0;
        return (int) $page * $paginateStep + $iteration;
    }
}

if (! function_exists('is_active_link')) {
    function is_active_link(string $link): HtmlString
    {
        return $link === request()->fullUrl()
            ? new HtmlString(' class="active"')
            : new HtmlString('');
    }
}

if (! function_exists('format_seconds')) {
    function format_seconds($total): HtmlString
    {
        $hours = (int)($total/3600) > 0 ? (int)($total/3600) . '<span>ч</span>' : '';
        $minutes = ($total/60)%60 > 0 ? ($total/60)%60 . '<span>мин</span>' : '';

        return new HtmlString(sprintf('%s %s', $hours, $minutes));
    }
}

if (! function_exists('format_deadline')) {
    function format_deadline($date): string
    {
        return $date ? $date->formatLocalized('%d %b %Y') : 'Не задано';
    }
}

if (! function_exists('words_to_lower_case')) {
    function words_to_lower_case(string $words): string
    {
        return Illuminate\Support\Str::slug($words, '_');
    }
}
