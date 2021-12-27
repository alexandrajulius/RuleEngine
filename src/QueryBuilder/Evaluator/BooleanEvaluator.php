<?php

declare(strict_types = 1);

namespace QueryBuilder\Evaluator;

use QueryBuilder\Expression\BooleanExpression;
use QueryBuilder\Expression\ExpressionInterface;
use QueryBuilder\Engine;

#scalar value
final class BooleanEvaluator {

    public function evaluate(Engine $evaluator, ExpressionInterface $expression, array $data)
    {
        assert($expression instanceof BooleanExpression);

        return $expression->value;
    }

    public function supports(ExpressionInterface $expression): bool
    {
        return $expression instanceof BooleanExpression;
    }
}
