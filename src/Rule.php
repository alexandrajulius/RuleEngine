<?php

declare(strict_types = 1);

use Expression\ExpressionInterface;

final class Rule
{
    public ExpressionInterface $predicate;

    public ActionInterface $action;

    public function __construct(ExpressionInterface $predicate, ActionInterface $action)
    {
        $this->predicate = $predicate;
        $this->action = $action;
    }
}
