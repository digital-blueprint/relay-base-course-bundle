<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\OpenApi\Model\Operation;
use ApiPlatform\OpenApi\Model\Parameter;
use Dbp\Relay\BaseCourseBundle\DataProvider\CourseClassDataProvider;
use Dbp\Relay\BaseCourseBundle\DataProvider\CourseDataProvider;
use Dbp\Relay\CoreBundle\LocalData\LocalDataAwareInterface;
use Dbp\Relay\CoreBundle\LocalData\LocalDataAwareTrait;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    shortName: 'BaseCourseDate',
    types: ['https://schema.org/DateTimeImmutable'],
    operations: [
        new Get(
            uriTemplate: '/base/course-dates/{identifier}',
            openapi: new Operation(
                tags: ['BaseCourse'],
                parameters: [
                    new Parameter(
                        name: 'includeLocal',
                        in: 'query',
                        description: 'Local data attributes to include',
                        required: false,
                        schema: ['type' => 'string'],
                    ),
                ],
            ),
            provider: CourseClassDataProvider::class
        ),
        new GetCollection(
            uriTemplate: '/base/course-dates',
            openapi: new Operation(
                tags: ['BaseCourse'],
                parameters: [
                    new Parameter(
                        name: 'includeLocal',
                        in: 'query',
                        description: 'Local data attributes to include',
                        required: false,
                        schema: ['type' => 'string'],
                    ),
                    new Parameter(
                        name: 'courseIdentifier',
                        in: 'query',
                        description: 'The course to get the dates for',
                        required: false,
                        schema: ['type' => 'string'],
                    ),
                ]
            ),
            provider: CourseClassDataProvider::class
        ),
    ],
    normalizationContext: [
        'groups' => ['BaseCourseDate:output', 'LocalData:output'],
    ]
)]
class CourseClass implements LocalDataAwareInterface
{
    use LocalDataAwareTrait;

    #[Groups(['BaseCourseDate:output'])]
    private ?string $identifier = null;

    #[Groups(['BaseCourseDate:output'])]
    private ?string $courseIdentifier = null;

    #[Groups(['BaseCourseDate:output'])]
    private ?\DateTimeImmutable $startAt = null;

    #[Groups(['BaseCourseDate:output'])]
    private ?\DateTimeImmutable $endAt = null;

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(?string $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getCourseIdentifier(): ?string
    {
        return $this->courseIdentifier;
    }

    public function setCourseIdentifier(?string $courseIdentifier): void
    {
        $this->courseIdentifier = $courseIdentifier;
    }

    public function getStartAt(): ?\DateTimeImmutable
    {
        return $this->startAt;
    }

    public function setStartAt(?\DateTimeImmutable $startAt): void
    {
        $this->startAt = $startAt;
    }

    public function getEndAt(): ?\DateTimeImmutable
    {
        return $this->endAt;
    }

    public function setEndAt(?\DateTimeImmutable $endAt): void
    {
        $this->endAt = $endAt;
    }
}
