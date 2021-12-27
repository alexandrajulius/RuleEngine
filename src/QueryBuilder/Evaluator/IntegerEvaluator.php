<?php

declare(strict_types = 1);

namespace QueryBuilder\Evaluator;

use QueryBuilder\Engine;
use QueryBuilder\Expression\ExpressionInterface;
use QueryBuilder\Expression\IntegerExpression;

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
