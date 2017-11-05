<?php
use PHPUnit\Framework\TestCase;
require("src/json-multiline-strings.php");

class jsonMultilineStringsSplit_test extends TestCase {
  public function testjsonMultilineStringsSplit () {
    $input = array( "foo" => "bar", "long" => "text with\nseveral\nline breaks");
    $expected = array( "foo" => "bar", "long" => array("text with", "several", "line breaks") );

    $this->assertEquals($expected, jsonMultilineStringsSplit($input));
  }
}

class jsonMultilineStringsJoin_test extends TestCase {
  public function testjsonMultilineStringsJoin () {
    $input = array( "foo" => "bar", "long" => array("text with", "several", "line breaks") );
    $expected = array( "foo" => "bar", "long" => "text with\nseveral\nline breaks");

    $this->assertEquals($expected, jsonMultilineStringsJoin($input));
  }
}
