<?php

namespace InfixCalculatorHelper;

/**
 * Class InfixCalculatorHelper
 * @package InfixCalculatorHelper
 */
class InfixCalculatorHelper
{
    /**
     * @return array
     */
    public function getOperatorPriority()
    {
        return array('*' => 2, '/' => 2, '+' => 1, '-' => 1);
    }

    /**
     * @param $op
     * @param $arg1
     * @param $arg2
     * @return float
     */
    public function calculateValue($op, $arg1, $arg2)
    {
        switch ($op) {
            case '*':
                return $arg2*$arg1;
            case '/':
                return $arg2/$arg1;
            case '+':
                return $arg2+$arg1;
            case '-':
                return $arg2-$arg1;
        }
    }

    /**
     * @param $numberStack
     * @param $operatorStack
     * @param $operatorPriority
     * @param $arg
     * @return bool
     */
    public function needsToCalculate($numberStack, $operatorStack, $operatorPriority , $arg)
    {
        $condition1 = count($numberStack) > 1;
        $condition2 = empty($operatorStack);
        $condition3 = !empty($operatorStack) ? $operatorPriority[end($operatorStack)] > $operatorPriority[$arg] : false;

        return $condition1 && ($condition2 || $condition3);
    }
}