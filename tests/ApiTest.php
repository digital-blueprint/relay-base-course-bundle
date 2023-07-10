<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Dbp\Relay\CoreBundle\TestUtils\UserAuthTrait;
use Symfony\Component\HttpFoundation\Response;

class ApiTest extends ApiTestCase
{
    use UserAuthTrait;

    public function testCoursesNoAuth()
    {
        $client = self::createClient();
        $response = $client->request('GET', '/base/courses');
        $this->assertSame(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    public function testCourseNoAuth()
    {
        $client = self::createClient();
        $response = $client->request('GET', '/base/courses/123');
        $this->assertSame(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    public function testGetItemAuthenticated()
    {
        $this->testRequestAuthenticated('/base/courses/foo');
    }

    public function testGetCollectionAuthenticated()
    {
        $this->testRequestAuthenticated('/base/courses');
    }

    private function testRequestAuthenticated(string $url)
    {
        $client = $this->withUser('user', [], '42');
        $response = $client->request('GET', $url, ['headers' => [
            'Authorization' => 'Bearer 42',
        ]]);

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }
}
