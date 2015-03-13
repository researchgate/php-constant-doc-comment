<?php
namespace rg\phpConstantDocComment;

/**
 * Class Constant
 *
 * @package rg\phpConstantDocComment
 * @copyright ResearchGate GmbH
 */
class Constant
{

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $docComment;

    /**
     * @var string
     */
    private $value;

    /**
     * @param string $name
     * @param string $value
     * @param string $docComment
     */
    public function __construct($name, $value, $docComment)
    {
        $this->name = $name;
        $this->value = $value;
        $this->docComment = $docComment;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getDocComment()
    {
        return $this->docComment;
    }
}
