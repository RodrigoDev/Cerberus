<?php

declare (strict_types = 1);

namespace Tests\Stubs;

use Cerberus\Contracts\UserAcl;

class User implements UserAcl
{
    protected $id;
    protected $role;

    public function __construct()
    {
        $this->id = rand();
    }

    public function setRole(Role $role)
    {
        $this->role = $role;
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
