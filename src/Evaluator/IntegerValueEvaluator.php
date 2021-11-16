<?php

declare(strict_types = 1);

namespace Evaluator;

use Evaluator;
use ExpressionEvaluator;
use IntegerValue;
use Node;

final class IntegerValueEvaluator implements Evaluator
{
    //literal
    public function evaluate(ExpressionEvaluator $evaluator, Node $expression, array $data)
    {
        assert($expression instanceof IntegerValue);

        return $expression->value;
    }

    public function supports(Node $expression): bool
    {
        return $expression instanceof IntegerValue;
    }

}
