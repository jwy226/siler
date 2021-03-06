<?php
/**
 * Helpers functions for HTTP requests
 */

namespace Siler\Http\Request;

/**
 * Returns the raw HTTP body request
 *
 * @param string The input file to check on
 *
 * @return string
 */
function raw($input = 'php://input')
{
    return file_get_contents($input);
}

/**
 * Returns URL decoded raw request body
 *
 * @param string The input file to check on
 *
 * @return array
 */
function params($input = 'php://input')
{
    $params = [];
    parse_str(raw($input), $params);
    return $params;
}

/**
 * Returns JSON decoded raw request body
 *
 * @param string The input file to check on
 *
 * @return array
 */
function json($input = 'php://input')
{
    return json_decode(raw($input), true);
}
