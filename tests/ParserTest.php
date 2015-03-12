<?php
namespace tests;

require_once __DIR__ . '/stubs/ConstantClassStub1.php';

use rg\phpConstantDocComment\Constant;
use rg\phpConstantDocComment\Parser;
use tests\stubs\ConstantClassStub1;

class ParserTest extends \PHPUnit_Framework_TestCase
{
    public function testParser()
    {
        $class = new \ReflectionClass(ConstantClassStub1::class);
        $reader = new Parser;

        $constants = $reader->getClassConstants($class);

        $this->assertTrue(is_array($constants));
        $this->assertArrayHasKey('TEST_CONSTANT1', $constants);
        $this->assertArrayHasKey('TEST_CONSTANT2', $constants);
        $this->assertArrayHasKey('TEST_CONSTANT3', $constants);

        $this->assertConstantValues(
            $constants['TEST_CONSTANT1'],
            'TEST_CONSTANT1',
            '/**
     * @annotations\test1Annotation("annotation value")
     */');

        $this->assertConstantValues(
            $constants['TEST_CONSTANT2'],
            'TEST_CONSTANT2',
            '/**
     * @annotations\test2Annotation
     */');

        $this->assertConstantValues(
            $constants['TEST_CONSTANT3'],
            'TEST_CONSTANT3',
            '/**
     * @annotations\test1Annotation("value1")
     * @annotations\test2Annotation("value2")
     */');

    }

    private function assertConstantValues(Constant $constant, $name, $docComment)
    {
        $this->assertEquals($name, $constant->getName());
        $this->assertEquals($docComment, $constant->getDocComment());
    }
}
