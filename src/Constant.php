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
     * @param string $name
     * @param string $docComment
     */
    public function __construct($name, $docComment)
    {
        $this->name = $name;
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
    public function getDocComment()
    {
        return $this->docComment;
    }
}
