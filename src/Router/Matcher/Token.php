<?php

namespace MagicFramework\Router\Matcher;

class Token
{
    /** @var string */
    private $value;

    /** @var string|null */
    private $name;

    public function __construct(string $value, string $name = null)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function isParametrized(): bool
    {
        return null !== $this->name;
    }
}
