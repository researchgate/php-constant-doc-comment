<?php
namespace rg\phpConstantDocComment;

/**
 * Class Parser
 *
 * @package rg\phpConstantDocComment
 * @copyright ResearchGate GmbH
 */
class Parser
{

    /**
     * @param \ReflectionClass $class
     *
     * @return Constant[]
     */
    public static function getClassConstants(\ReflectionClass $class)
    {
        $constants = [];
        $fileName = $class->getFileName();

        if (empty($fileName)) {
            throw new \RuntimeException('File path was not found for class: ' . $class->getName());
        }
        $content = file_get_contents($fileName);
        $tokens = token_get_all($content);
        $doc = null;
        $isConst = false;
        foreach ($tokens as $token) {
            if (!is_array($token)) {
                continue;
            }

            list($tokenType, $tokenValue) = $token;
            switch ($tokenType) {
                // ignored tokens
                case T_WHITESPACE:
                case T_COMMENT:
                    break;
                case T_DOC_COMMENT:
                    $doc = $tokenValue;
                    break;
                case T_CONST:
                    $isConst = true;
                    break;
                case T_STRING:
                    if ($isConst) {
                        $constants[$tokenValue] = new Constant($tokenValue, $doc);
                    }
                    $doc = null;
                    $isConst = false;
                    break;

                // all other tokens reset the parser
                default:
                    $doc = null;
                    $isConst = false;
                    break;
            }
        }

        return $constants;
    }

    /**
     * @param \ReflectionClass $class
     * @param string $name
     *
     * @return Constant
     */
    public static function getClassConstant(\ReflectionClass $class, $name)
    {
        return self::getClassConstants($class)[$name];
    }
}
