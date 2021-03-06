<?php
/**
 * Siler routing facilities
 */

namespace Siler\Route;

use Siler\Http;
use function Siler\require_fn;

/**
 * Define a new route using the GET HTTP method
 *
 * @param string $path The HTTP URI to listen on
 * @param string|callable $callback The callable to be executed or a string to be used with Siler\require_fn
 */
function get($path, $callback)
{
    route('get', $path, $callback);
}

/**
 * Define a new route using the POST HTTP method
 *
 * @param string $path The HTTP URI to listen on
 * @param string|callable $callback The callable to be executed or a string to be used with Siler\require_fn
 */
function post($path, $callback)
{
    route('post', $path, $callback);
}

/**
 * Define a new route using the PUT HTTP method
 *
 * @param string $path The HTTP URI to listen on
 * @param string|callable $callback The callable to be executed or a string to be used with Siler\require_fn
 */
function put($path, $callback)
{
    route('put', $path, $callback);
}

/**
 * Define a new route using the DELETE HTTP method
 *
 * @param string $path The HTTP URI to listen on
 * @param string|callable $callback The callable to be executed or a string to be used with Siler\require_fn
 */
function delete($path, $callback)
{
    route('delete', $path, $callback);
}

/**
 * Define a new route using the OPTIONS HTTP method
 *
 * @param string $path The HTTP URI to listen on
 * @param string|callable $callback The callable to be executed or a string to be used with Siler\require_fn
 */
function options($path, $callback)
{
    route('options', $path, $callback);
}

/**
 * Define a new route
 *
 * @param string $method The HTTP request method to listen on
 * @param string $path The HTTP URI to listen on
 * @param string|callable $callback The callable to be executed or a string to be used with Siler\require_fn
 */
function route($method, $path, $callback)
{
    $path = regexify($path);

    if (is_string($callback)) {
        $callback = require_fn($callback);
    }

    if (Http\method_is($method) && preg_match($path, Http\path(), $params)) {
        $callback($params);
    }
}

/**
 * Turns a URLroute path into a Regexp
 *
 * @param string $path The HTTP path
 *
 * @return string
 */
function regexify($path)
{
    $path = preg_replace('/\{([A-z-]+)\}/', '(?<$1>[A-z0-9_-]+)', $path);
    $path = "#^{$path}/?$#";

    return $path;
}
