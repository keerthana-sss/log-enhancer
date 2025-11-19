<?php


use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

// if (! function_exists('enhanced_info')) {
//     /** * Write some information to the log. * 
//      * * @param mixed $message 
//      * * @param mixed $context 
//      * */
//     function enhanced_info($message, $context = []): void
//     {
//         [$message, $context] = array_map(function ($item) {
//             return is_scalar($item) || is_null($item) ? $item : (array) $item;
//         }, [$message, $context]);
        
//         // Log::info($message, is_array($context) ? $context : []);
//         app('log')->info($message, $context);


//         // // 🔵 Normalize message
//         // if (!is_scalar($message) && $message !== null) {
//         //     // JSON encode non-scalar messages
//         //     $message = json_encode($message, JSON_PRETTY_PRINT);
//         // } else {
//         //     // Scalar => cast to string (strict mode compatible)
//         //     $message = (string)$message;
//         // }

//         // // 🔵 Normalize context
//         // if (is_array($context)) {
//         //     // OK
//         // } elseif (is_object($context)) {
//         //     // Convert object -> array
//         //     $context = (array)$context;
//         // } elseif ($context === null) {
//         //     $context = [];
//         // } else {
//         //     // Scalar → wrap as array
//         //     $context = ['value' => $context];
//         // }
//         // Log::info($message, $context);
//     }
// }



use Kks\LogEnhancer\Normalizer;

if (! function_exists('smart_info')) {
    /**
     * Log an informational message with automatic deep normalization.
     *
     * This helper ensures that both the message and the context payload are
     * transformed into log-friendly scalar and array structures before being
     * passed to the underlying logger. It recursively converts Laravel
     * collections, Arrayable objects, Jsonable objects, JsonSerializable
     * instances, Traversable data, and even generic PHP objects into clean,
     * serializable arrays.
     *
     * Use this function when you want consistent, predictable log output
     * without having to manually call ->toArray() or handle nested objects.
     * Particularly useful for debugging responses, model data, collections,
     * or any complex structures that would otherwise appear as unreadable
     * object dumps in your logs.
     *
     * @param  mixed  $message  The log message. Can be a string, array,
     *                          collection, model, or any normalizable object.
     * @param  mixed  $context  Additional context data to include with the log
     *                          entry. Supports complex/nested structures.
     *
     * @return void
     */
    function smart_info($message, $context = []): void
    {
        $message = Normalizer::normalize($message);
        $context = Normalizer::normalize($context);

        Log::info($message, is_array($context) ? $context : []);
    }
}