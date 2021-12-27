<?php

declare(strict_types = 1);

namespace QueryBuilder\Evaluator;

use QueryBuilder\Engine;
use QueryBuilder\Expression\ExpressionInterface;

interface EvaluatorInterface
{
    public function evaluate(Engine $evaluator, ExpressionInterface $expression, array $data);

    public function supports(ExpressionInterface $expression): bool;
}
