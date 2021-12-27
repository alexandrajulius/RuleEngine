<?php

declare(strict_types = 1);

namespace QueryBuilder\Evaluator;

use QueryBuilder\Expression\ClosureExpression;
use QueryBuilder\Expression\ExpressionInterface;
use QueryBuilder\Engine;

final class ClosureEvaluator implements EvaluatorInterface
{
    public function evaluate(Engine $evaluator, ExpressionInterface $expression, array $data)
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
