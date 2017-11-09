<?php
function reducePath ($paths, $currentPath)
{
    $ret = array_filter($paths, function ($path) use ($currentPath) {
        return (sizeof($path) && $path[0] === $currentPath);
    });

    $ret = array_map(function ($path) {
        return array_slice($path, 1);
    }, $ret);

    return $ret;
}

function jsonMultilineStringsSplit ($data, $options=array())
{
    if (array_key_exists('exclude', $options) && array_search(array(), $options['exclude']) !== false) {
        return $data;
    }

    if (is_string($data)) {
        if (strpos($data, "\n") !== false) {
            return  explode("\n", $data);
        }

        return $data;
    }

    if (is_array($data)) {
        foreach ($data as $k => $v) {
            $nextOpt = $options;

            if (array_key_exists('exclude', $options)) {
                $nextOpt['exclude'] = reducePath($options['exclude'], $k);
            }

            $data[$k] = jsonMultilineStringsSplit($v, $nextOpt);
        }
    }

    return $data;
}

/**
 * return true if the array consists only of strings and all elements are
 * incrementally ordered.
 */
function isStringArray($arr)
{
    if (!is_array($arr)) {
        return false;
    }

    if (array_keys($arr) !== range(0, sizeof($arr) - 1)) {
        return false;
    }

    for ($i = 0; $i < sizeof($arr); $i++) {
        if (!is_string($arr[$i])) {
            return false;
        }
    }

    return true;
}

function jsonMultilineStringsJoin($data, $options=array())
{
    if (array_key_exists('exclude', $options) && array_search(array(), $options['exclude']) !== false) {
        return $data;
    }

    if (isStringArray($data)) {
        return implode("\n", $data);
    }

    if (is_array($data)) {
        foreach ($data as $k => $v) {
            $nextOpt = $options;

            if (array_key_exists('exclude', $options)) {
                $nextOpt['exclude'] = reducePath($options['exclude'], $k);
            }

            $data[$k] = jsonMultilineStringsJoin($v, $nextOpt);
        }
    }

    return $data;
}
