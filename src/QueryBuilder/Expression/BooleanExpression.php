<?php

declare(strict_types = 1);

namespace QueryBuilder\Expression;

# OneLiteralExpression / OneLiteralNode
final class BooleanExpression implements ExpressionInterface
{
    public bool $value;

    public function __construct(bool $value)
    {
        $this->value = $value;
    }
}
