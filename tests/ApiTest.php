<?php

declare(strict_types=1);

namespace Dbp\Relay\CourseBundle\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Symfony\Component\HttpFoundation\Response;

class ApiTest extends ApiTestCase
{
    public function testCoursesNoAuth()
    {
        $client = self::createClient();
        $response = $client->request('GET', '/courses');
        $this->assertSame(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    public function testCourseNoAuth()
    {
        $client = self::createClient();
        $response = $client->request('GET', '/courses/123');
        $this->assertSame(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }
}
