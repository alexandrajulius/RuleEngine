<?php

declare(strict_types = 1);

namespace QueryBuilder\Expression;

# OneLiteralExpression / OneLiteralNode
final class IntegerExpression implements ExpressionInterface
{
    public int $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }
}
