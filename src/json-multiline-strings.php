<?php
function jsonMultilineStringsSplit($data, $options=array())
{
    if (is_string($data)) {
        if (strpos($data, "\n") !== false) {
            return  explode("\n", $data);
        }

        return $data;
    }

    if (is_array($data)) {
        foreach ($data as $k => $v) {
            $data[$k] = jsonMultilineStringsSplit($v);
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
    if (isStringArray($data)) {
        return implode("\n", $data);
    }

    if (is_array($data)) {
        foreach ($data as $k => $v) {
            $data[$k] = jsonMultilineStringsJoin($v);
        }
    }

    return $data;
}
