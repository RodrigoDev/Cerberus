<?php

use Cerberus\{Acl, Resource, Operation, Role};
use Cerberus\Exceptions\{RoleNotFoundException};
use Tests\Stubs\User;

class TestAcl extends \PHPUnit_Framework_TestCase
{

    /**
     * ACL object for each test method
     *
     * @var Cerberus\Acl
     */
    protected $_acl;
    /**
     * User stub object for test
     *
     * @var Tests\Stubs\User
     */
    protected $_user;
    /**
     * Instantiates a new ACL and User to use inside tests
     *
     * @return void
     */
    public function setUp()
    {
        $this->_acl = new Acl();
        $this->_user = new User();

        $this->_acl->setUser($this->_user);
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
     *
     * @return void
     */
    public function testRoleAddAndGetOneByString()
    {
        $role = $this->_acl->addRole('area')
                           ->getRole('area');
        $this->assertInstanceOf(Role::class, $role);
        $this->assertEquals('area', $role);
    }

    /**
     * Ensures that basic removal of a single Role works
     *
     * @return void
     */
    public function testRoleRemoveOne()
    {
        $roleGuest = new Role('guest');
        $this->_acl->addRole($roleGuest)
                   ->removeRole($roleGuest);
        $this->assertFalse($this->_acl->hasRole($roleGuest));
    }

    /**
     * Ensures that an exception is thrown when a non-existent Role is specified for removal
     *
     * @return void
     */
    public function testRoleRemoveOneNonExistent()
    {
        $this->expectException(RoleNotFoundException::class, 'role not found');
        $this->_acl->removeRole('nonexistent');
    }
    
    /**
     *  Ensures that a Operation can be inserted in a Role
     * 
     * @return void
     */
    public function testAddOperationInRole()
    {
        $role = new Role('admin');
        $operation = new Operation('create.user');
        
        $role->addOperation($operation);
        
        $this->assertArrayHasKey($operation->getName(), $role->getOperations());
    }

    /**
     *  Ensures that a Resource can be created and added to ACL
     *
     * @return void
     */
    public function testAddResourceInRole()
    {
        $resource = new Resource('book', $this->_user->getId());

        $this->assertTrue($this->_acl->isOwner($resource));

    }
}
