<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Dbp\Relay\CoreBundle\TestUtils\UserAuthTrait;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class ApiTest extends ApiTestCase
{
    use UserAuthTrait;

    public function testCoursesNoAuth(): void
    {
        $this->testRequest('/base/courses', false, Response::HTTP_UNAUTHORIZED);
    }

    public function testCourseNoAuth(): void
    {
        $this->testRequest('/base/courses/foo', false, Response::HTTP_UNAUTHORIZED);
    }

    public function testGetItemAuthenticated(): void
    {
        $this->testRequest('/base/courses/foo', true, Response::HTTP_OK);
    }

    public function testGetItemNotFound(): void
    {
        $this->testRequest('/base/courses/404', true, Response::HTTP_NOT_FOUND);
    }

    public function testGetCollectionAuthenticated(): void
    {
        $this->testRequest('/base/courses', true, Response::HTTP_OK);
    }

    private function testRequest(string $url, bool $authenticated, int $expectedStatusCode): void
    {
        try {
            $client = $this->withUser('user', [], $authenticated ? '42' : null);
            $response = $client->request('GET', $url, ['headers' => [
                'Authorization' => 'Bearer 42',
            ]]);
            $this->assertEquals($expectedStatusCode, $response->getStatusCode());
        } catch (TransportExceptionInterface $e) {
            throw new \RuntimeException($e->getMessage());
        }
    }
}
