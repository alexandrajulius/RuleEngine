<?php

declare(strict_types = 1);

namespace Evaluator;

use Engine;
use Expression\ExpressionInterface;

interface EvaluatorInterface
{
    public function evaluate(Engine $evaluator, ExpressionInterface $expression, array $data);

    public function supports(ExpressionInterface $expression): bool;
}
