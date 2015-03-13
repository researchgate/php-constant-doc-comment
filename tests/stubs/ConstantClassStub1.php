<?php
namespace tests\stubs;

/**
 * @copyright ResearchGate GmbH
 */
class ConstantClassStub1 {

    /**
     * @annotations\test1Annotation("annotation value")
     */
    const TEST_CONSTANT1 = 'test-value-1';

    private $testProperty1;

    /**
     * @annotations\test2Annotation
     */
    const TEST_CONSTANT2 = 'test-value-2';

    private $testProperty2=10;

    /**
     * @var int
     */
    protected $val = 1;

    /**
     * @annotations\test1Annotation("value1")
     * @annotations\test2Annotation("value2")
     */
    const TEST_CONSTANT3 = '3';
}
