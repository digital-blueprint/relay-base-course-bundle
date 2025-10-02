<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\Tests;

use Dbp\Relay\CoreBundle\TestUtils\AbstractApiTest;
use Symfony\Component\HttpFoundation\Response;

class ApiTest extends AbstractApiTest
{
    public function testGetItemAuthenticated(): void
    {
        $this->testClient->setUpUser(userAttributes: ['MAY_READ' => true]);
        $this->assertEquals(Response::HTTP_OK, $this->testClient->get('/base/courses/foo')->getStatusCode());
    }

    public function testGetItemNotFound(): void
    {
        $this->testClient->setUpUser(userAttributes: ['MAY_READ' => true]);
        $this->assertEquals(Response::HTTP_NOT_FOUND, $this->testClient->get('/base/courses/404')->getStatusCode());
    }

    public function testUnauthorizedRequests()
    {
        foreach (['/base/courses', '/base/courses/foo'] as $path) {
            $response = $this->testClient->get($path, token: null);
            $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
        }
    }

    public function testForbiddenRequests()
    {
        foreach (['/base/courses', '/base/courses/foo'] as $path) {
            $this->testClient->setUpUser(userAttributes: ['MAY_READ' => false]);
            $response = $this->testClient->get($path);
            $this->assertEquals(Response::HTTP_FORBIDDEN, $response->getStatusCode());
        }
    }
}
