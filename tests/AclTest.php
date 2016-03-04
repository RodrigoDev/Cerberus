<?php

namespace Cerberus\Acl\Contracts\Tests;

use Cerberus\Acl;

class TestAcl extends \PHPUnit_Framework_TestCase
{
    public function testStub()
    {
        // Cria um esboço para a classe Acl.
        $acl = $this->getMockBuilder('Cerberus\Acl')
                    ->disableOriginalConstructor()
                    ->getMock();

        // Configura o esboço.
        $acl->method('hasRole')
             ->willReturn(true);

        // Chamando $esboco->fazAlgumaCoisa() agora vai retornar
        // 'foo'.
        $this->assertEquals(true, $acl->hasRole('teste'));
    }
}
