<?php
use PHPUnit\Framework\TestCase;

class jsonMultilineStrings extends TestCase
{
    public function testjsonMultilineStringsSplit()
    {
        $input = array( "foo" => "bar", "long" => "text with\nseveral\nline breaks", "number" => 5);
        $expected = array( "foo" => "bar", "long" => array("text with", "several", "line breaks"), "number" => 5 );

        $this->assertEquals($expected, jsonMultilineStringsSplit($input));
    }

    public function testjsonMultilineStringsSplit_exclude()
    {
        $input = array( "foo" => "bar", "long" => "text with\nseveral\nline breaks", "excluded" => "text with\nseveral\nline breaks", "number" => 5);
        $expected = array( "foo" => "bar", "long" => array("text with", "several", "line breaks"), "excluded" => "text with\nseveral\nline breaks", "number" => 5 );

        $this->assertEquals($expected, jsonMultilineStringsSplit($input, array('exclude' => array(array('excluded')))));
    }

    public function testjsonMultilineStringsSplit_string_only()
    {
        $input = 'text without line breaks';
        $expected = 'text without line breaks';

        $this->assertEquals($expected, jsonMultilineStringsSplit($input));
    }

    public function testjsonMultilineStringsSplit_multilinestring_only()
    {
        $input = "text with\nseveral\nline breaks";
        $expected = [ 'text with', 'several', 'line breaks' ];

        $this->assertEquals($expected, jsonMultilineStringsSplit($input));
    }

    public function testjsonMultilineStringsJoin()
    {
        $input = array( "foo" => "bar", "long" => array("text with", "several", "line breaks"), "nojoin" => array( "this no join", 1 ) );
        $expected = array( "foo" => "bar", "long" => "text with\nseveral\nline breaks", "nojoin" => array( "this no join", 1 ));

        $this->assertEquals($expected, jsonMultilineStringsJoin($input));
    }

    public function testjsonMultilineStringsJoin_exclude()
    {
        $input = array( "foo" => "bar", "long" => array("text with", "several", "line breaks"), "excluded" => array("text with", "several", "line breaks"), "number" => 5);
        $expected = array( "foo" => "bar", "long" => "text with\nseveral\nline breaks", "excluded" => array("text with", "several", "line breaks"), "number" => 5 );

        $this->assertEquals($expected, jsonMultilineStringsJoin($input, array('exclude' => array(array('excluded')))));
    }

    public function testjsonMultilineStringsJoin_string_only()
    {
        $input = 'text without line breaks';
        $expected = 'text without line breaks';

        $this->assertEquals($expected, jsonMultilineStringsJoin($input));
    }

    public function testjsonMultilineStringsJoin_multilinestring_only()
    {
        $input = [ 'text with', 'several', 'line breaks' ];
        $expected = "text with\nseveral\nline breaks";

        $this->assertEquals($expected, jsonMultilineStringsJoin($input));
    }
}
