<?php

declare(strict_types = 1);


final class PropertyAccessValue implements Node
{
    public string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

}
