<?php

declare(strict_types = 1);

namespace Expression;

final class ListExpression implements ExpressionInterface
{
    public array $expressions;

    public function __construct(array $expressions)
    {
        $this->expressions = $expressions;
    }
}
