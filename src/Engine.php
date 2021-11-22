<?php

declare(strict_types = 1);

use Evaluator\EvaluatorInterface;
use Expression\ExpressionInterface;

final class Engine
{
    //it's a stack of services, not data, so private
    /**
     * @var EvaluatorInterface[]
     */
    private array $evaluators;

    public function __construct(array $evaluators)
    {
        $this->evaluators = $evaluators;
    }

    public function evaluate(ExpressionInterface $expression, array $data)
    {
        foreach ($this->evaluators as $evaluator) {
            if ($evaluator->supports($expression)) {
                return $evaluator->evaluate($this, $expression, $data);
            }
        }

        throw new Exception(sprintf('No evaluator found for expression "%s": ', get_class($expression)));
    }
}
