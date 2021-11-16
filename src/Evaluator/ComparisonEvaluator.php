<?php

declare(strict_types = 1);

namespace Evaluator;

use ComparisonCondition;
use Evaluator;
use Exception;
use ExpressionEvaluator;
use Node;

final class ComparisonEvaluator implements Evaluator
{
    //anything that gets passed to here will be a comparison expression
    public function evaluate(ExpressionEvaluator $evaluator, Node $expression, array $data)
    {
        assert($expression instanceof ComparisonCondition);

        $left = $evaluator->evaluate($expression->left, $data);
        $right = $evaluator->evaluate($expression->right, $data);

        switch ($expression->comparisonOperator) {
            case '<':
                return $left < $right;
            case '>':
                return $left > $right;
            case '=':
                return $left == $right;
        }

        throw new Exception(sprintf('Unknown comparison operator "%s".', $expression->comparisonOperator));
    }

    public function supports(Node $expression): bool
    {
        return $expression instanceof ComparisonCondition;
    }
}
