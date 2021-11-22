<?php

declare(strict_types = 1);

namespace Evaluator;

use Engine;
use Expression\ExpressionInterface;
use Expression\IntegerExpression;

final class IntegerEvaluator implements EvaluatorInterface
{
    //literal
    public function evaluate(Engine $evaluator, ExpressionInterface $expression, array $data)
    {
        assert($expression instanceof IntegerExpression);

        return $expression->value;
    }

    public function supports(ExpressionInterface $expression): bool
    {
        return $expression instanceof IntegerExpression;
    }
}
