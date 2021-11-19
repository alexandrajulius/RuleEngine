<?php

declare(strict_types = 1);

namespace Evaluator;

use Expression\BooleanExpression;
use Expression\ExpressionInterface;
use Expression\IntegerExpression;
use ExpressionEvaluator;

#scalar value
final class BooleanEvaluator {

    public function evaluate(ExpressionEvaluator $evaluator, ExpressionInterface $expression, array $data)
    {
        assert($expression instanceof BooleanExpression);

        return $expression->value;
    }

    public function supports(ExpressionInterface $expression): bool
    {
        return $expression instanceof BooleanExpression;
    }
}
