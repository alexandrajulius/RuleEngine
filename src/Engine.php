<?php

declare(strict_types = 1);


final class Engine
{
    public array $rules;

    private ExpressionEvaluator $evaluator;

    public function __construct(
        array $rules,
        ExpressionEvaluator $evaluator
    )
    {
        $this->rules = $rules;
        $this->evaluator = $evaluator;
    }

    public function apply(array $data)
    {
        foreach ($this->rules as $rule) {
            if ($this->evaluator->evaluate($rule->expression, $data)) {
                return $rule->action->do($data);
            }
        }

        throw new Exception('No action determined for any of the given rules.');
    }
}
