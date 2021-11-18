<?php

declare(strict_types = 1);

namespace Evaluator;

use Exception;
use Expression\ExpressionInterface;
use Expression\LogicalExpression;
use ExpressionEvaluator;

final class LogicalEvaluator implements EvaluatorInterface
{
    public function evaluate(ExpressionEvaluator $evaluator, ExpressionInterface $expression, array $data)
    {
        assert($expression instanceof LogicalExpression);

        $left = $evaluator->evaluate($expression->left, $data);
        $right = $evaluator->evaluate($expression->right, $data);

        switch ($expression->logicalOperator) {
            case '|':
                return $left || $right;
            case '&':
                return $left && $right;
           # what about "not"? it's a OneLiteralExpression
        }

        throw new Exception(sprintf('Unknown logical operator "%s".', $expression->logicalOperator));
    }

    public function supports(ExpressionInterface $expression): bool
    {
        return $expression instanceof LogicalExpression;
    }
}
