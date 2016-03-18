<?php

declare (strict_types = 1);

namespace Cerberus;

class Resource
{
    protected $name;
    protected $ownerId;

    public function __construct(string $name = null, string $ownerId = null)
    {
        $this->name = $name;
        $this->ownerId = $ownerId;
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
     * @return resource
     */
    public function setName(string $name): Resource
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getOwnerId(): string
    {
        return $this->ownerId;
    }

    /**
     * @param string $ownerId
     *
     * @return resource
     */
    public function setOwnerField(string $ownerId): Resource
    {
        $this->ownerId = $ownerId;
        return $this;
    }

    /**
     * Returns the Resource identifier
     * Proxies to getName()
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
