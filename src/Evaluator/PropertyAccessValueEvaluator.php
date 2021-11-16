<?php

declare(strict_types = 1);

namespace Evaluator;

use Evaluator;
use ExpressionEvaluator;
use Node;
use PropertyAccessValue;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class PropertyAccessValueEvaluator implements Evaluator
{
    public function evaluate(ExpressionEvaluator $evaluator, Node $expression, array $data)
    {
        assert($expression instanceof PropertyAccessValue);

        $propertyAccessor = PropertyAccess::createPropertyAccessorBuilder()
            ->enableExceptionOnInvalidIndex()
            ->enableExceptionOnInvalidPropertyPath()
            ->getPropertyAccessor();

        return $propertyAccessor->getValue($data, $expression->path);
    }

    public function supports(Node $expression): bool
    {
        return $expression instanceof PropertyAccessValue;
    }
}
