<?php
use PHPUnit\Framework\TestCase;

require("src/json-multiline-strings.php");

class jsonMultilineStringsSplit_test extends TestCase
{
    public function testjsonMultilineStringsSplit()
    {
        $input = array( "foo" => "bar", "long" => "text with\nseveral\nline breaks");
        $expected = array( "foo" => "bar", "long" => array("text with", "several", "line breaks") );

        $this->assertEquals($expected, jsonMultilineStringsSplit($input));
    }
}

class jsonMultilineStringsJoin_test extends TestCase
{
    public function testjsonMultilineStringsJoin()
    {
        $input = array( "foo" => "bar", "long" => array("text with", "several", "line breaks"), "nojoin" => array( "this no join", 1 ) );
        $expected = array( "foo" => "bar", "long" => "text with\nseveral\nline breaks", "nojoin" => array( "this no join", 1 ));

        $this->assertEquals($expected, jsonMultilineStringsJoin($input));
    }
}
