<?php

declare(strict_types = 1);

namespace Evaluator;

use Expression\ExpressionInterface;
use Expression\SumExpression;
use Engine;

final class SumEvaluator implements EvaluatorInterface
{
    public function evaluate(Engine $evaluator, ExpressionInterface $expression, array $data)
    {
        assert($expression instanceof SumExpression);

        $listOfNumbers = $evaluator->evaluate($expression->expression, $data);

        return array_sum((array)$listOfNumbers);
    }

    public function supports(ExpressionInterface $expression): bool
    {
        return $expression instanceof SumExpression;
    }
}
