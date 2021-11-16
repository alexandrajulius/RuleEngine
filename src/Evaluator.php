<?php

declare(strict_types = 1);

interface Evaluator
{
    public function evaluate(ExpressionEvaluator $evaluator, Node $expression, array $data);

    public function supports(Node $expression): bool;
}
