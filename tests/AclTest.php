<?php

namespace Cerberus\Acl\Contracts\Tests;

use Cerberus\Acl\Acl;

class TestCerberus extends \PHPUnit_Framework_TestCase
{
    public function testStub()
    {
        // Cria um esboço para a classe Acl.
        $acl = $this->getMockBuilder('Cerberus\Acl\Acl')
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
