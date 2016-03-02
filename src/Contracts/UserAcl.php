<?php


namespace Cerberus\Acl\Contracts;

interface UserAcl
{
    public function getRole():string;
    public function getId():int;
}