<?php

declare(strict_types = 1);

namespace QueryBuilder;

use QueryBuilder\Evaluator\ArithmeticEvaluator;
use QueryBuilder\Evaluator\BooleanEvaluator;
use QueryBuilder\Evaluator\ComparisonEvaluator;
use QueryBuilder\Evaluator\IfEvaluator;
use QueryBuilder\Evaluator\IntegerEvaluator;
use QueryBuilder\Evaluator\ListEvaluator;
use QueryBuilder\Evaluator\LogicalEvaluator;
use QueryBuilder\Evaluator\ClosureEvaluator;
use QueryBuilder\Evaluator\PropertyEvaluator;
use QueryBuilder\Evaluator\SumEvaluator;

final class EngineFactory
{
    public function createEngine(): Engine
    {
        return new Engine(
            $this->createEvaluatorStack()
        );
    }

    private function createEvaluatorStack(): array
    {
        return [
            $this->createComparisonEvaluator(),
            $this->createPropertyEvaluator(),
            $this->createIntegerEvaluator(),
            $this->createArithmeticEvaluator(),
            $this->createLogicalEvaluator(),
            $this->createSumEvaluator(),
            $this->createListEvaluator(),
            $this->createClosureEvaluator(),
            $this->createIfEvaluator(),
            $this->createBooleanEvaluator()
        ];
    }

    private function createComparisonEvaluator(): ComparisonEvaluator
    {
        return new ComparisonEvaluator();
    }

    private function createPropertyEvaluator(): PropertyEvaluator
    {
        return new PropertyEvaluator();
    }

    private function createIntegerEvaluator(): IntegerEvaluator
    {
        return new IntegerEvaluator();
    }

    private function createArithmeticEvaluator(): ArithmeticEvaluator
    {
        return new ArithmeticEvaluator();
    }

    private function createLogicalEvaluator(): LogicalEvaluator
    {
        return new LogicalEvaluator();
    }

    private function createSumEvaluator(): SumEvaluator
    {
        return new SumEvaluator();
    }

    private function createListEvaluator(): ListEvaluator
    {
        return new ListEvaluator();
    }

    private function createClosureEvaluator(): ClosureEvaluator
    {
        return new ClosureEvaluator();
    }

    private function createIfEvaluator(): IfEvaluator
    {
        return new IfEvaluator();
    }

    private function createBooleanEvaluator(): BooleanEvaluator
    {
        return new BooleanEvaluator();
    }


}
