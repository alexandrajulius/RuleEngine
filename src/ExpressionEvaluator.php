<?php

declare(strict_types = 1);

final class ExpressionEvaluator
{
    //it's a service, not data, so private
    /**
     * @var Evaluator[]
     */
    private array $evaluators;

    public function __construct(array $evaluators)
    {
        $this->evaluators = $evaluators;
    }

    public function evaluate(Node $expression, array $data)
    {
        foreach ($this->evaluators as $evaluator) {
            if ($evaluator->supports($expression)) {
                return $evaluator->evaluate($this, $expression, $data);
            }
        }

        throw new Exception(sprintf('No evaluator found for expression "%s": ', get_class($expression)));
    }
}
