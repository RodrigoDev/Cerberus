<?php

declare (strict_types = 1);

namespace Cerberus;

use Cerberus\Contracts\UserAcl;
use Cerberus\Entities\Resource;
use Cerberus\Entities\Role;

class Acl
{
    protected $roles = [];
    protected $resources = [];
    protected $user;

    /**
     * @param UserAcl $user
     *
     * @return Acl
     */
    public function setUser(UserAcl $user): Acl
    {
        $this->user = $user;

        return $this;
    }

    public function addRole(string $name)
    {
        $role = new Role($name);
        $this->roles[$name] = $role;
        return $this;
    }

    public function removeRole(Role $role)
    {
        unset($this->roles[$role->getRoleId]);
        return $this;
    }

    public function addResource(string $name)
    {
        $role = new Resource($name);
        $this->resource[$name] = $resource;
        return $this;
    }

    public function removeResource(Role $resource)
    {
        unset($this->roles[$resource->getResourceId]);
        return $this;
    }

    /**
     * @param string $role
     *
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        foreach ($this->roles as $r) {
            if ($r->getName() == $role) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $role
     *
     * @return Cerberus\Entities\Role
     */
    public function getRole(string $role): Role
    {
        if ($this->roles[$role]) {
            return $this->roles[$role];
        }
    }

    /**
     * @param string $role
     * @param string $permission
     *
     * @return bool
     */
    public function hasPermission(string $role, string $permission): bool
    {
        foreach ($this->roles as $r) {
            if ($r->getName() == $role) {
                foreach ($r->getPermissions() as $p) {
                    if ($p->getName() == $permission) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    /**
     * @param string       $permission
     * @param UserAcl|null $user
     *
     * @return bool
     */
    public function can(string $permission, UserAcl $user = null): bool
    {
        if ($user) {
            return $this->hasPermission($user->getRole(), $permission);
        }

        if ($this->user) {
            return $this->hasPermission($this->user->getRole(), $permission);
        }

        return false;
    }

    /**
     * @param string       $permission
     * @param UserAcl|null $user
     *
     * @return bool
     */
    public function cannot(string $permission, UserAcl $user = null): bool
    {
        return !$this->can($permission, $user);
    }

    /**
     * @param $resource
     * @param UserAcl|null $user
     *
     * @return bool
     */
    public function isOwner($resource, UserAcl $user = null): bool
    {
        if ($user) {
            $this->setUser($user);
        }

        foreach ($this->resources as $r) {
            if (is_a($resource, $r->getName())) {
                if ($user) {
                    return $resource->{$r->getOwnerField()}() == $user->getId();
                }

                return $resource->{$r->getOwnerField()}() == $this->user->getId();
            }
        }

        return false;
    }
}
