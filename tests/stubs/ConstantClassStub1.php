<?php
/**
 * @copyright ResearchGate GmbH
 */
namespace tests\stubs;
/**
 * const outside class, don't match that
 * 
 */
const ONE = 1;


class OtherClass {
	/**
	 * This is a different Comment from a different Class
	 */
	const TEST_CONSTANT1 = 'test-value-1';
}

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

    /**
    * @annotations\test4Annotation
    */
    const TEST_CONSTANT4 = 4;
 
    const TEST_CONSTANT5 = 5;
    
    const TEST_CONSTANT6 = 2**3;
    
    /**
     * As of PHP 5.6.0
     */
    const TWO = ONE * 2;
    const THREE = ONE + self::TWO;
    const SENTENCE = 'The value of THREE is '.self::THREE;
    
    /**
     * 
     * As of PHP 5.3.0
     */
    const BAR = <<<'EOT'
bar
EOT;

}
class AnotherOtherClass {
	/**
	 * This is a different Comment from a different Class
	 */
	const TEST_CONSTANT1 = 'test-value-1';
}
