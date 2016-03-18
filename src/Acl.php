<?php

declare (strict_types = 1);

namespace Cerberus;

use Cerberus\Contracts\UserAcl;
use Cerberus\Exceptions\RoleNotFoundException;

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

    public function addRole($role): Acl
    {
        if (is_string($role)) {
            $role = new Role($role);
        } elseif (!$role instanceof Role) {
            throw new Exception\InvalidArgumentException(
                'addRole() expects $role to be of type Cerberus\Role'
            );
        }

        $this->roles[(string) $role] = $role;
        return $this;
    }

    public function removeRole($role): Acl
    {
        $role = (string) $role;
        if(isset($this->roles[$role])){
            unset($this->roles[$role]);
        } else {
            throw new RoleNotFoundException();
        }

        return $this;
    }

    public function addResource($resource): Acl
    {
        if (is_string($resource)) {
            $resource = new Resource($resource, $this->user->getId());
        } elseif (!$resource instanceof Resource) {
            throw new InvalidArgumentException(
                'addResource() expects $resource to be of type Cerberus\Resource'
            );
        }

        $this->resources[(string) $resource] = $resource;
        return $this;
    }

    public function removeResource($resource): Acl
    {
        unset($this->roles[(string) $resource]);
        return $this;
    }

    /**
     * @param  $role
     *
     * @return bool
     */
    public function hasRole($role): bool
    {
        foreach ($this->roles as $r) {
            if ($r->getName() == (string) $role) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param  $role
     *
     * @return Role
     */
    public function getRole($role): Role
    {
        if ($this->roles[(string) $role]) {
            return $this->roles[(string) $role];
        }
    }

    /**
     * @param $role
     * @param $operation
     *
     * @return bool
     */
    public function hasOperation($role, $operation): bool
    {
        foreach ($this->roles as $r) {
            if ($r->getName() == (string) $role) {
                foreach ($r->getOperations() as $p) {
                    if ($p->getName() == (string) $operation) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    /**
     * @param        $operation
     * @param UserAcl|null $user
     *
     * @return bool
     */
    public function can($operation, UserAcl $user = null): bool
    {
        if ($user) {
            return $this->hasOperation($user->getRole(), $operation);
        }

        if ($this->user) {
            return $this->hasOperation($this->user->getRole(), $operation);
        }

        return false;
    }

    /**
     * @param string       $operation
     * @param UserAcl|null $user
     *
     * @return bool
     */
    public function cannot(string $operation, UserAcl $user = null): bool
    {
        return !$this->can($operation, $user);
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

        return $resource->getOwnerId() == $this->user->getId();
    }
}
