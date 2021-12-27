<?php

declare(strict_types = 1);

namespace QueryBuilder\Expression;

final class IfExpression implements ExpressionInterface
{
    public ExpressionInterface $predicate;

    public ExpressionInterface $ifAction;

    public ?ExpressionInterface $elseAction;

    public function __construct(
        ExpressionInterface $predicate,
        ExpressionInterface $ifAction,
        ?ExpressionInterface $elseAction = null
    )
    {
        $this->predicate = $predicate;
        $this->ifAction = $ifAction;
        $this->elseAction = $elseAction;
    }
}
