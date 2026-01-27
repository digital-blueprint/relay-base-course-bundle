<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\Tests;

use Dbp\Relay\CoreBundle\TestUtils\AbstractApiTest;
use Symfony\Component\HttpFoundation\Response;

class ApiTest extends AbstractApiTest
{
    public function testGetCourseItemAuthenticated(): void
    {
        $this->testClient->setUpUser(userAttributes: ['MAY_READ' => true]);
        $this->assertEquals(Response::HTTP_OK, $this->testClient->get('/base/courses/foo')->getStatusCode());
    }

    public function testGetCourseCollectionAuthenticated(): void
    {
        $this->testClient->setUpUser(userAttributes: ['MAY_READ' => true]);
        $this->assertEquals(Response::HTTP_OK, $this->testClient->get('/base/courses')->getStatusCode());
    }

    public function testGetCourseItemNotFound(): void
    {
        $this->testClient->setUpUser(userAttributes: ['MAY_READ' => true]);
        $this->assertEquals(Response::HTTP_NOT_FOUND, $this->testClient->get('/base/courses/404')->getStatusCode());
    }

    public function testGetCourseEventItemAuthenticated(): void
    {
        $this->testClient->setUpUser(userAttributes: ['MAY_READ' => true]);
        $this->assertEquals(Response::HTTP_OK, $this->testClient->get('/base/course-events/bar')->getStatusCode());
    }

    public function testGetCourseEventCollectionAuthenticated(): void
    {
        $this->testClient->setUpUser(userAttributes: ['MAY_READ' => true]);
        $this->assertEquals(Response::HTTP_OK, $this->testClient->get('/base/course-events?courseIdentifier=foo')->getStatusCode());
    }

    public function testGetCourseEventItemNotFound(): void
    {
        $this->testClient->setUpUser(userAttributes: ['MAY_READ' => true]);
        $this->assertEquals(Response::HTTP_NOT_FOUND, $this->testClient->get('/base/course-events/404')->getStatusCode());
    }

    public function testUnauthorizedRequests()
    {
        foreach ($this->getPaths() as $path) {
            $response = $this->testClient->get($path, token: null);
            $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
        }
    }

    public function testForbiddenRequests()
    {
        foreach ($this->getPaths() as $path) {
            $this->testClient->setUpUser(userAttributes: ['MAY_READ' => false]);
            $response = $this->testClient->get($path);
            $this->assertEquals(Response::HTTP_FORBIDDEN, $response->getStatusCode());
        }
    }

    /**
     * @return string[]
     */
    private function getPaths(): array
    {
        return [
            '/base/courses',
            '/base/courses/foo',
            '/base/course-events',
            '/base/course-events/bar',
        ];
    }
}
