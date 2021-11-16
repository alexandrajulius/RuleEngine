<?php

declare(strict_types = 1);


final class IntegerValue implements Node
{
    public int $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }
}
