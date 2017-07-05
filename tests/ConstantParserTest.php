<?php
namespace tests;

require_once __DIR__ . '/stubs/ConstantClassStub1.php';

use PHPUnit\Framework\TestCase;
use rg\phpConstantDocComment\Constant;
use rg\phpConstantDocComment\Parser;
use tests\stubs\ConstantClassStub1;

class ConstantParserTest extends TestCase
{
    public function testParser()
    {
        $class = new \ReflectionClass(ConstantClassStub1::class);
        $reader = new Parser;

        $constants = $reader->getClassConstants($class);


        $this->assertConstantValues(
            $constants['TEST_CONSTANT1'],
            'TEST_CONSTANT1',
            'test-value-1',
            '/**
     * @annotations\test1Annotation("annotation value")
     */');

        $this->assertConstantValues(
            $constants['TEST_CONSTANT2'],
            'TEST_CONSTANT2',
            'test-value-2',
            '/**
     * @annotations\test2Annotation
     */');

        $this->assertConstantValues(
            $constants['TEST_CONSTANT3'],
            'TEST_CONSTANT3',
            '3',
            '/**
     * @annotations\test1Annotation("value1")
     * @annotations\test2Annotation("value2")
     */');

     $this->assertConstantValues(
            $constants['TEST_CONSTANT4'],
            'TEST_CONSTANT4',
            4,
            '/**
    * @annotations\test4Annotation
    */');

    }

    private function assertConstantValues(Constant $constant, $name, $value, $docComment)
    {
        $this->assertEquals($constant->getName(), $name);
        $this->assertEquals($constant->getValue(), $value);
        $this->assertEquals($constant->getDocComment(), $docComment);
    }
}
