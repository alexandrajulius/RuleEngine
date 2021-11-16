<?php

declare(strict_types = 1);


final class ComparisonCondition implements Node
{
    public Node $left;

    public string $comparisonOperator;

    public Node $right;

    public function __construct(Node $left, string $comparisonOperator, Node $right)
    {
        $this->left = $left;
        $this->comparisonOperator = $comparisonOperator;
        $this->right = $right;
    }
}
