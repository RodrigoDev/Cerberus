<?php

declare (strict_types = 1);

namespace Cerberus\Entities;
use Cerberus\Contracts\UserAcl;

class User implements UserAcl
{
    protected $id;
    protected $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
        $this->id   = rand();
    }

    public function getRole(): string
    {
        return $this->role->getName();
    }

    public function getId(): int
    {
        return $this->id;
    }
}
