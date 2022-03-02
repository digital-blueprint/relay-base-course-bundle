<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Symfony\Component\HttpFoundation\Response;

class ApiTest extends ApiTestCase
{
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

    public function testAttendeesByCourseNoAuth()
    {
        $client = self::createClient();
        $response = $client->request('GET', '/base/courses/123/attendees');
        $this->assertSame(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    public function testCoursesByOrganizationNoAuth()
    {
        $client = self::createClient();
        $response = $client->request('GET', '/base/organizations/123/courses');
        $this->assertSame(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    public function testCoursesByPersonNoAuth()
    {
        $client = self::createClient();
        $response = $client->request('GET', '/base/people/123/courses');
        $this->assertSame(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }
}
