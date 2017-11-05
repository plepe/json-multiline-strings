<?php
function jsonMultilineStringsSplit ($data) {
  foreach ($data as $k => $v) {
    if (is_string($v) && strpos($v, "\n") !== false) {
      $data[$k] = explode("\n", $v);
    }
    elseif (is_array($v)) {
      $data[$k] = jsonMultilineStringsSplit ($v);
    }
  }

  return $data;
}

/**
 * return true if the array consists only of strings and all elements are
 * incrementally ordered.
 */
function isStringArray ($arr) {
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

function jsonMultilineStringsJoin ($data) {
  foreach ($data as $k => $v) {
    if (isStringArray($v)) {
      $data[$k] = implode("\n", $v);
    }
    elseif (is_array($v)) {
      $data[$k] = jsonMultilineStringsJoin ($v);
    }
  }

  return $data;
}
