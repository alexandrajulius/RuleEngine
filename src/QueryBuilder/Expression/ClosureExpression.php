<?php

declare(strict_types = 1);

namespace QueryBuilder\Expression;

use Closure;

final class ClosureExpression implements ExpressionInterface
{
    public Closure $closure;

    public function __construct(Closure $anonymousFunction)
    {
        $this->anonymousFunction = $anonymousFunction;
    }
}
