<?php

declare(strict_types = 1);

namespace Evaluator;

use Exception;
use Expression\ArithmeticExpression;
use Expression\ExpressionInterface;
use Engine;

final class ArithmeticEvaluator implements EvaluatorInterface
{
    public function evaluate(Engine $evaluator, ExpressionInterface $expression, array $data)
    {
        assert($expression instanceof ArithmeticExpression);

        $left = $evaluator->evaluate($expression->left, $data);
        $right = $evaluator->evaluate($expression->right, $data);

        switch ($expression->arithmeticOperator) {
            case '+':
                return $left + $right;
            case '-':
                return $left - $right;
            case 'x':
                return $left * $right;
            case ':':
                return $left / $right;
        }

        throw new Exception(sprintf('Unknown arithmetic operator "%s".', $expression->arithmeticOperator));
    }

    public function supports(ExpressionInterface $expression): bool
    {
        return $expression instanceof ArithmeticExpression;
    }
}
