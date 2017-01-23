<?php

namespace tests\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ClientControllerTest extends WebTestCase
{
    public function setUp()
    {

    }

    public function testRedirectToLogin()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $client->getResponse()->isRedirect();
        $this->assertTrue($client->getResponse()->isRedirect('login'));
    }
}