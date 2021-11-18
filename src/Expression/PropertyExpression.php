<?php

declare(strict_types = 1);

namespace Expression;

final class PropertyExpression implements ExpressionInterface
{
    public string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }
}
