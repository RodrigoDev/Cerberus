<?php

declare (strict_types = 1);

namespace Cerberus;

class Operation
{
    protected $name;

    public function __construct(string $name = null)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Operation
     */
    public function setName(string $name): Operation
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Returns the Operation identifier
     * Proxies to getName()
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->getName();
    }
}
