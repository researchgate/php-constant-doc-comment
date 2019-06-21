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
        
        $nextPart = null;
        $nextStop = T_CLASS;
        $doc = '';
        $insideClass = false;
        foreach ($tokens as $token) {
            $keyWord = is_array($token) ? $token[0] : $token;
            if($keyWord == T_CLASS && $insideClass) {
                //We are done with the class in question
                return $constants;
            }
            if($keyWord == T_DOC_COMMENT) {
                $doc = $token[1];
            } else if($keyWord == $nextStop) {
                if($nextStop == T_CLASS) {
                    $nextPart = 'className';
                }
                else if($nextStop == T_CONST) {
                    $nextPart = 'name';
                    $nextStop = '=';
                } else if($nextStop == '=') {
                    $nextPart = null;
                    $nextStop = T_CONST;
                }
            } else {
                if($nextPart == 'className') {
                    if($keyWord == T_WHITESPACE || $keyWord == T_COMMENT) {
                        continue;
                    } else {
                        $className = $token[1];
                        if($className == $class->getShortName()) {
                            $insideClass = true;
                            $nextPart = null;
                            $nextStop = T_CONST;
                        }
                    }
                }
                else if($nextPart == 'name') {
                    if($keyWord == T_WHITESPACE || $keyWord == T_COMMENT) {
                        continue;
                    } else {
                        $constName = $token[1];
                        $constValue = $class->getConstant($constName);
                        $constants[$constName] = new Constant($constName, $constValue, $doc);
                        $doc = '';
                    }
                }
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
