<?php

namespace InfixCalculatorTests;

require_once('vendor/autoload.php');
require_once('InfixCalculator.php');

use InfixCalculator\InfixCalculator;

/**
 * Class InfixCalculatorTests
 * @package InfixCalculatorTests
 */
class InfixCalculatorTests extends \PHPUnit_Framework_TestCase
{
    private $infixCalculator;

    public function setUp()
    {
        $this->infixCalculator = new InfixCalculator();
    }

    public function testExampleExpression()
    {
        $arguments = array('1','+', '1', '*', '3', '+', '3');

        $result = $this->infixCalculator->calculate($arguments);
        $this->assertEquals(7, $result, '');
    }

    public function testAddition()
    {
        $arguments = array('2','+', '2');

        $result = $this->infixCalculator->calculate($arguments);
        $this->assertEquals(4, $result, '');
    }

    public function testSubtraction()
    {
        $arguments = array('2','-', '2');

        $result = $this->infixCalculator->calculate($arguments);
        $this->assertEquals(0, $result, '');
    }

    public function testMultiplication()
    {
        $arguments = array('2','*', '2');

        $result = $this->infixCalculator->calculate($arguments);
        $this->assertEquals(4, $result, '');
    }

    public function testDivision()
    {
        $arguments = array('2','/', '2');

        $result = $this->infixCalculator->calculate($arguments);
        $this->assertEquals(1, $result, '');
    }
}