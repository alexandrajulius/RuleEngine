<?php

declare(strict_types = 1);

namespace Evaluator;

use ExpressionEvaluator;
use Expression\ExpressionInterface;

interface EvaluatorInterface
{
    public function evaluate(ExpressionEvaluator $evaluator, ExpressionInterface $expression, array $data);

    public function supports(ExpressionInterface $expression): bool;
}
