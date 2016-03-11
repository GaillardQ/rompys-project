<?php

namespace Frontend\FrontOfficeBundle\Tests\Controller;

use Frontend\FrontOfficeBundle\Entity\User;

class UserControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testIndex()
    {
        $user = new User();
        
        $roles = $user->getRoles();
        
        $this->assertContains(User::ROLE_USER, $roles);
    }
}
