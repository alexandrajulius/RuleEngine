<?php

declare(strict_types = 1);

namespace Expression;

# TwoLiteralExpression
final class LogicalExpression implements ExpressionInterface
{
    public ExpressionInterface $left;

    public string $logicalOperator;

    public ExpressionInterface $right;

    public function __construct(ExpressionInterface $left, string $logicalOperator, ExpressionInterface $right)
    {
        $this->left = $left;
        $this->logicalOperator = $logicalOperator;
        $this->right = $right;
    }
}
