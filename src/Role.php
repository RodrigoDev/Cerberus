<?php

declare (strict_types = 1);

namespace Cerberus;

class Role
{
    protected $name;
    protected $operations = [];

    public function __construct(string $name)
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
     * @return Role
     */
    public function setName(string $name): Role
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return array
     */
    public function getOperations(): array
    {
        return $this->operations;
    }

    /**
     * @param  $operation
     *
     * @return Role
     */
    public function addOperation($operation): Role
    {
        if (is_string($operation)) {
           $operation = new Operation($operation);
        } elseif (!$operation instanceof Operation) {
           throw new Exception\InvalidArgumentException(
               'addRole() expects $operation to be of type Cerberus\\Operation'
           );
        }

        $this->operations[(string) $operation] = $operation;
        return $this;
    }

    /**
     * Returns the Operation identifier
     * Proxies to getName()
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
