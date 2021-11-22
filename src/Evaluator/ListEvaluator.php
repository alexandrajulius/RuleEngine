<?php

declare(strict_types = 1);

namespace Evaluator;

use Expression\ExpressionInterface;
use Expression\IntegerExpression;
use Expression\ListExpression;
use Engine;

final class ListEvaluator implements EvaluatorInterface
{
    public function evaluate(Engine $evaluator, ExpressionInterface $expression, array $data)
    {
        assert($expression instanceof ListExpression);

        $list = [];
        foreach ($expression->expressions as $element) {
            $list[] = $evaluator->evaluate($element, $data);
        }

        return $list;
    }

    public function supports(ExpressionInterface $expression): bool
    {
        return $expression instanceof ListExpression;
    }

}
