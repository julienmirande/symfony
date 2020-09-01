<?php

namespace MonBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecuredControllerTest extends WebTestCase
{
    public function testSecuritycheck()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'login_check');
    }

}
