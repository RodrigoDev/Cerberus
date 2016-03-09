<?php

use Cerberus\Acl;
use Cerberus\Stubs\User;
use Cerberus\Resource;
use Cerberus\Role;

class TestAcl extends \PHPUnit_Framework_TestCase
{

    /**
     * ACL object for each test method
     *
     * @var Cerberus\Acl
     */
    protected $_acl;
    /**
     * Instantiates a new ACL object and creates internal reference to it for each test method
     *
     * @return void
     */
    public function setUp()
    {
        $this->_acl = new Cerberus\Acl();
    }
    /**
     * Ensures that basic addition and retrieval of a single Role works
     *
     * @return void
     */
    public function testRoleAddAndCheck()
    {
        $roleGuest = new Role("guest");

        $role = $this->_acl->addRole($roleGuest)
                          ->getRole($roleGuest->getName());
        $this->assertEquals($roleGuest, $role);
        $role = $this->_acl->getRole($roleGuest);
        $this->assertEquals($roleGuest, $role);
    }
    /**
     * Ensures that basic addition and retrieval of a single Resource works
     */
    public function testRoleAddAndGetOneByString()
    {
        $role = $this->_acl->addRole('area')
                           ->getRole('area');
        $this->assertInstanceOf('Cerberus\Role', $role);
        $this->assertEquals('area', $role->getName());
    }
}
