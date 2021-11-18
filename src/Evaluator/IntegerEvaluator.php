<?php

declare(strict_types = 1);

namespace Evaluator;

use ExpressionEvaluator;
use Expression\ExpressionInterface;
use Expression\IntegerExpression;

final class IntegerEvaluator implements EvaluatorInterface
{
    //literal
    public function evaluate(ExpressionEvaluator $evaluator, ExpressionInterface $expression, array $data)
    {
        assert($expression instanceof IntegerExpression);

        return $expression->value;
    }

    public function supports(ExpressionInterface $expression): bool
    {
        return $expression instanceof IntegerExpression;
    }
}
