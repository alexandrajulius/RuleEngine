<?php

declare(strict_types = 1);

namespace QueryBuilder\Evaluator;

use Exception;
use QueryBuilder\Expression\ExpressionInterface;
use QueryBuilder\Expression\LogicalExpression;
use QueryBuilder\Engine;

final class LogicalEvaluator implements EvaluatorInterface
{
    public function evaluate(Engine $evaluator, ExpressionInterface $expression, array $data)
    {
        assert($expression instanceof LogicalExpression);

        $left = $evaluator->evaluate($expression->left, $data);
        $right = $evaluator->evaluate($expression->right, $data);

        switch ($expression->logicalOperator) {
            case '|':
                return $left || $right;
            case '&':
                return $left && $right;
        }

        throw new Exception(sprintf('Unknown logical operator "%s".', $expression->logicalOperator));
    }

    public function supports(ExpressionInterface $expression): bool
    {
        return $expression instanceof LogicalExpression;
    }
}
