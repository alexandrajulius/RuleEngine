<?php

declare(strict_types = 1);

namespace Expression;

# TwoLiteralExpression
final class ComparisonExpression implements ExpressionInterface
{
    public ExpressionInterface $left;

    public string $comparisonOperator;

    public ExpressionInterface $right;

    public function __construct(ExpressionInterface $left, string $comparisonOperator, ExpressionInterface $right)
    {
        $this->left = $left;
        $this->comparisonOperator = $comparisonOperator;
        $this->right = $right;
    }
}
