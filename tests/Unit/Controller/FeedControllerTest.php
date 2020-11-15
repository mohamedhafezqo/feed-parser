<?php declare(strict_types=1);

namespace App\Test\Unit\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FeedControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/feeds');

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }
}
