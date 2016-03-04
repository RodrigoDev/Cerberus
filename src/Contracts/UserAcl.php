<?php

namespace Cerberus\Contracts;

interface UserAcl
{
    public function getRole():string;
    public function getId():int;
}
