<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\Tests;

use Dbp\Relay\CoreBundle\TestUtils\AbstractApiTest;
use Dbp\Relay\CoreBundle\TestUtils\UserAuthTrait;
use Symfony\Component\HttpFoundation\Response;

class ApiTest extends AbstractApiTest
{
    use UserAuthTrait;

    public function testCoursesNoAuth(): void
    {
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $this->testClient->get('/base/courses', token: null)->getStatusCode());
    }

    public function testCourseNoAuth(): void
    {
        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $this->testClient->get('/base/courses/foo', token: null)->getStatusCode());
    }

    public function testGetItemAuthenticated(): void
    {
        $this->assertEquals(Response::HTTP_OK, $this->testClient->get('/base/courses/foo')->getStatusCode());
    }

    public function testGetItemNotFound(): void
    {
        $this->assertEquals(Response::HTTP_NOT_FOUND, $this->testClient->get('/base/courses/404')->getStatusCode());
    }

    public function testGetCollectionAuthenticated(): void
    {
        $this->assertEquals(Response::HTTP_OK, $this->testClient->get('/base/courses')->getStatusCode());
    }
}
