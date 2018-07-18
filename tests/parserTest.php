<?php
use PHPUnit\Framework\TestCase;
require_once dirname(__FILE__) . '/../parser.php';
 
class ParserTest extends TestCase {

    private $parser;
    private $validSample;

    function setUp() {
        parent::setUp();
        $this->parser = new Parser();
        $this->validSample = file_get_contents(dirname(__FILE__) . '/src/sample-input.txt');
    }

    /**
     * @expectedException TypeError
     */
    public function testNoArg() {
        $this->parser->parse();
    }

    
    public function testInvalidArg() {
        $this->assertEquals([],$this->parser->parse(true));
        $this->assertEquals([],$this->parser->parse(1234));
    }

    public function testEmptyArg() {
        $this->assertEquals([], $this->parser->parse(''));
    }

    public function testInvalidData() {
        $this->assertEquals([], $this->parser->parse('sfdfdsdfdf'));
    }

    public function testInvalidNumLines() {
        $sample = file_get_contents(dirname(__FILE__) . '/src/sample-input.invalid.txt');
        $this->assertEquals([], $this->parser->parse($sample));
    }

    public function testValidSample() {
        $sample = file_get_contents(dirname(__FILE__) . '/src/sample-input.txt');
        $this->assertEquals(['0123456789', '21113598014862', '4410'], $this->parser->parse($sample));
    }

    public function testSampleWindowsNewline() {
        $sample = file_get_contents(dirname(__FILE__) . '/src/sample-input.4.txt');
        $this->assertEquals(['0123456789'], $this->parser->parse($sample));
    }

    public function testSampleVariableSpace() {
        $sample = file_get_contents(dirname(__FILE__) . '/src/sample-input.1.txt');
        $this->assertEquals(['0123456789', '21113598014862', '4410'], $this->parser->parse($sample));
    }

    public function testSampleBrokenInput() {
        $sample = file_get_contents(dirname(__FILE__) . '/src/sample-input.2.txt');
        $this->assertEquals(['0123456789'], $this->parser->parse($sample));
    }

    public function testSampleExtraNewline() {
        $sample = file_get_contents(dirname(__FILE__) . '/src/sample-input.3.txt');
        $this->assertEquals([], $this->parser->parse($sample));
    }

    

}