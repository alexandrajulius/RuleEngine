<?php

declare(strict_types = 1);

namespace Evaluator;

use Engine;
use Expression\ExpressionInterface;
use Expression\PropertyExpression;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class PropertyEvaluator implements EvaluatorInterface
{
    public function evaluate(Engine $evaluator, ExpressionInterface $expression, array $data)
    {
        assert($expression instanceof PropertyExpression);

        $propertyAccessor = PropertyAccess::createPropertyAccessorBuilder()
            ->enableExceptionOnInvalidIndex()
            ->enableExceptionOnInvalidPropertyPath()
            ->getPropertyAccessor();

        return $propertyAccessor->getValue($data, $expression->path);
    }

    public function supports(ExpressionInterface $expression): bool
    {
        return $expression instanceof PropertyExpression;
    }
}
