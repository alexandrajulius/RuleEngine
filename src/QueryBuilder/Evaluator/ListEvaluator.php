<?php

declare(strict_types = 1);

namespace QueryBuilder\Evaluator;

use QueryBuilder\Expression\ExpressionInterface;
use QueryBuilder\Expression\ListExpression;
use QueryBuilder\Engine;

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
