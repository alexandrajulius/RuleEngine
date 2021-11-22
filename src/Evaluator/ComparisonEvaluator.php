<?php

declare(strict_types = 1);

namespace Evaluator;

use Exception;
use Expression\ComparisonExpression;
use Engine;
use Expression\ExpressionInterface;

final class ComparisonEvaluator implements EvaluatorInterface
{
    //anything that gets passed to here will be a comparison expression
    public function evaluate(Engine $evaluator, ExpressionInterface $expression, array $data)
    {
        assert($expression instanceof ComparisonExpression);

        $left = $evaluator->evaluate($expression->left, $data);
        $right = $evaluator->evaluate($expression->right, $data);

        switch ($expression->comparisonOperator) {
            case '<':
                return $left < $right;
            case '>':
                return $left > $right;
            case '<=':
                return $left <= $right;
            case '>=':
                return $left >= $right;
            case '=':
                return $left === $right;
        }

        throw new Exception(sprintf('Unknown comparison operator "%s".', $expression->comparisonOperator));
    }

    public function supports(ExpressionInterface $expression): bool
    {
        return $expression instanceof ComparisonExpression;
    }
}
