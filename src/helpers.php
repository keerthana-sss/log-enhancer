<?php

use Illuminate\Support\Arr;


if (! function_exists('info')) {
    /**
     * Write some information to the log.
     *
     * @param  string|object $message
     * @param  array|Enumerable|Arrayable|WeakMap|Traversable|Jsonable|JsonSerializable|object $context
     */
    function info($message, $context = []): void
    {
        [$message, $context] = array_map(function ($item) {
             return is_scalar($item) || is_null($item) ? $item :  Arr::from($item);
        }, [$message, $context]);
        
        app('log')->info($message, $context);
    }
}