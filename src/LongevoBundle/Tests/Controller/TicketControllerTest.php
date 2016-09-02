<?php

namespace LongevoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TicketControllerTest extends WebTestCase
{
    public function testOpen()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/open');
    }

    public function testFollow()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/follow');
    }

}
