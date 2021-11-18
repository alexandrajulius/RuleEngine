<?php

declare(strict_types = 1);

use Evaluator\ArithmeticEvaluator;
use Evaluator\ComparisonEvaluator;
use Evaluator\IntegerEvaluator;
use Evaluator\LogicalEvaluator;
use Evaluator\PropertyEvaluator;

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
            $this->createLogicalEvaluator()
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
}
