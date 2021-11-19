<?php

declare(strict_types = 1);

use Evaluator\ArithmeticEvaluator;
use Evaluator\BooleanEvaluator;
use Evaluator\ComparisonEvaluator;
use Evaluator\IfEvaluator;
use Evaluator\IntegerEvaluator;
use Evaluator\ListEvaluator;
use Evaluator\LogicalEvaluator;
use Evaluator\ClosureEvaluator;
use Evaluator\PropertyEvaluator;
use Evaluator\SumEvaluator;

final class EvaluatorFactory
{
    public function createExpressionEvaluator(): ExpressionEvaluator
    {
        return new ExpressionEvaluator(
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
