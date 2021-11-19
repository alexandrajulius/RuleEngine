<?php

declare(strict_types = 1);

namespace Evaluator;

use Expression\ClosureExpression;
use Expression\ExpressionInterface;
use ExpressionEvaluator;

final class ClosureEvaluator implements EvaluatorInterface
{
    public function evaluate(ExpressionEvaluator $evaluator, ExpressionInterface $expression, array $data)
    {
        assert($expression instanceof ClosureExpression);

        $closure = $expression->anonymousFunction;

        return $closure($data);
    }

    public function supports(ExpressionInterface $expression): bool
    {
        return $expression instanceof ClosureExpression;
    }

}
