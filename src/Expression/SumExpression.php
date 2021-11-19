<?php

declare(strict_types = 1);

namespace Expression;

final class SumExpression implements ExpressionInterface
{
    public ExpressionInterface $expression;

    public function __construct(ExpressionInterface $expression)
    {
        $this->expression = $expression;
    }
}
