<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\OpenApi\Model\Operation;
use ApiPlatform\OpenApi\Model\Parameter;
use Dbp\Relay\BaseCourseBundle\DataProvider\CourseEventDataProvider;
use Dbp\Relay\CoreBundle\LocalData\LocalDataAwareInterface;
use Dbp\Relay\CoreBundle\LocalData\LocalDataAwareTrait;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    shortName: 'BaseCourseEvent',
    types: ['https://schema.org/DateTimeImmutable'],
    operations: [
        new Get(
            uriTemplate: '/base/course-events/{identifier}',
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
            provider: CourseEventDataProvider::class
        ),
        new GetCollection(
            uriTemplate: '/base/course-events',
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
            provider: CourseEventDataProvider::class
        ),
    ],
    normalizationContext: [
        'groups' => ['BaseCourseEvent:output', 'LocalData:output'],
    ]
)]
class CourseEvent implements LocalDataAwareInterface
{
    use LocalDataAwareTrait;

    public const COURSE_IDENTIFIER_QUERY_PARAMETER = 'courseIdentifier';

    #[Groups(['BaseCourseEvent:output'])]
    private ?string $identifier = null;

    #[Groups(['BaseCourseEvent:output'])]
    private ?string $courseIdentifier = null;

    #[Groups(['BaseCourseEvent:output'])]
    private ?\DateTimeImmutable $startAt = null;

    #[Groups(['BaseCourseEvent:output'])]
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
