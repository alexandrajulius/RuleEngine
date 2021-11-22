<?php

declare(strict_types = 1);

namespace Tests;

use EngineFactory;
use Expression\IntegerExpression;
use Expression\ListExpression;
use Expression\SumExpression;
use Engine;
use PHPUnit\Framework\TestCase;

final class SumEvaluatorTest extends TestCase
{
    public function test_it_sums_up_a_list_of_integers(): void
    {
        self::assertEquals(
            6,
            $this->getEngine()->evaluate($this->createSumExpression(1,2,3), [])
        );
    }

    public function test_it_sums_up_one_integer(): void
    {
        self::assertEquals(
            1,
            $this->getEngine()->evaluate($this->createSumExpression(1), [])
        );
    }

    public function test_it_sums_up_one_integer_without_a_list(): void
    {
        $expression = new SumExpression(new IntegerExpression(1));

        self::assertEquals(
            1,
            $this->getEngine()->evaluate($expression, [])
        );
    }

    private function createSumExpression(...$summands): SumExpression
    {
        $listOfIntegerExpressions = array_map(function(int $summand): IntegerExpression {
            return new IntegerExpression($summand);
        }, $summands);

        return new SumExpression(new ListExpression($listOfIntegerExpressions));
    }

    private function getEngine(): Engine
    {
        return (new EngineFactory())->createEngine();
    }
}
