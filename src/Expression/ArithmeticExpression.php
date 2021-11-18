<?php

declare(strict_types = 1);

namespace Expression;

# TwoLiteralExpression
final class ArithmeticExpression implements ExpressionInterface
{
    public ExpressionInterface $left;

    public string $arithmeticOperator;

    public ExpressionInterface $right;

    public function __construct(ExpressionInterface $left, string $arithmeticOperator, ExpressionInterface $right)
    {
        $this->left = $left;
        $this->arithmeticOperator = $arithmeticOperator;
        $this->right = $right;
    }
}
