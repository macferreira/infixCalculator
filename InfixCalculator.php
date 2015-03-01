<?php

namespace InfixCalculator;

require_once('InfixCalculatorHelper');

use InfixCalculatorHelper\InfixCalculatorHelper;

/**
 * Class InfixCalculator
 * @package InfixCalculator
 */
class InfixCalculator
{
    private $numberStack = array();

    private $operatorStack = array();

    private $helper;

    private $operatorPriority = array();

    public function __construct()
    {
        $this->helper = new InfixCalculatorHelper();

        $this->operatorPriority = $this->helper->getOperatorPriority;
    }

    /**
     * @param array $arguments
     * @return mixed|null
     */
    public function calculate(array $arguments)
    {
        $result = null;

        // feed the stacks with arguments and calculate higher priority operations
        $this->feedStacks($arguments);

        // calculate the final value of the expression
        $this->calculateFinalValueInStacks();

        // result is the remaining number in the number stack
        $result = reset($this->numberStack);

        return $result;
    }

    /**
     * @param $arguments
     */
    public function feedStacks($arguments)
    {
        foreach(array_reverse($arguments) as $arg) {

            if(preg_match('/^[0-9]*$/', $arg)) {
                // is number
                array_push($this->numberStack, $arg);
            }
            elseif(preg_match('/^[\*\/\+\-]/', $arg)) {
                // is operator
                $needsToCalculate = $this->helper->needsToCalculate($this->numberStack, $this->operatorStack, $this->operatorPriority, $arg);

                if($needsToCalculate) {

                    $operandToUse = array_pop($operatorStack);
                    $firstNumberToUse = array_pop($numberStack);
                    $secondNumberToUse = array_pop($numberStack);

                    array_push($numberStack, calculate($operandToUse, $firstNumberToUse, $secondNumberToUse));
                    array_push($operatorStack, $arg);
                }
                else {
                    array_push($operatorStack, $arg);
                }
            }
            else {
                //throw exception
                throw new \InvalidArgumentException('invalid argument in array');
            }
        }
    }

    /**
     *
     */
    public function calculateFinalValueInStacks()
    {
        while(!empty($this->operatorStack)) {
            $operandToUse = array_pop($this->operatorStack);
            $firstNumberToUse = array_pop($this->numberStack);
            $secondNumberToUse = array_pop($this->numberStack);

            array_push($this->numberStack, $this->helper->calculateValue($operandToUse, $firstNumberToUse, $secondNumberToUse));
        }
    }

}