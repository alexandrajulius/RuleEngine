<?php

declare(strict_types = 1);

namespace Tests\QueryBuilder;

use QueryBuilder\EngineFactory;
use QueryBuilder\Expression\BooleanExpression;
use QueryBuilder\Expression\IfExpression;
use QueryBuilder\Expression\IntegerExpression;
use QueryBuilder\Engine;
use PHPUnit\Framework\TestCase;

final class IfEvaluatorTest extends TestCase
{
    public function test_it_returns_result_if_true(): void
    {
        $expression = $this->createIfExpression(true, 1, null);

        self::assertEquals(1, $this->getEngine()->evaluate($expression, []));
    }

    public function test_it_returns_null_if_false(): void
    {
        $expression = $this->createIfExpression(false, 1, null);

        self::assertEquals(null, $this->getEngine()->evaluate($expression, []));
    }

    private function createIfExpression(bool $predicate, int $if, ?int $then): IfExpression
    {
        return new IfExpression(new BooleanExpression($predicate), new IntegerExpression($if));
    }

    private function getEngine(): Engine
    {
        return (new EngineFactory())->createEngine();
    }
}
