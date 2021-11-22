<?php

declare(strict_types = 1);

namespace Evaluator;

use Expression\ExpressionInterface;
use Expression\IfExpression;
use Engine;

final class IfEvaluator implements EvaluatorInterface
{
    public function evaluate(Engine $evaluator, ExpressionInterface $expression, array $data)
    {
        assert($expression instanceof IfExpression);

        $predicate = $evaluator->evaluate($expression->predicate, $data);

        if ($predicate) {
            return $evaluator->evaluate($expression->ifAction, $data);
        }

        if ($expression->elseAction === null) {
            return null;
        }

        return $evaluator->evaluate($expression->elseAction, $data);
    }

    public function supports(ExpressionInterface $expression): bool
    {
        return $expression instanceof IfExpression;
    }

}
