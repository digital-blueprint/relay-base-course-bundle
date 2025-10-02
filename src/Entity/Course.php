<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\OpenApi\Model\Operation;
use ApiPlatform\OpenApi\Model\Parameter;
use Dbp\Relay\BaseCourseBundle\DataProvider\CourseDataProvider;
use Dbp\Relay\CoreBundle\LocalData\LocalDataAwareInterface;
use Dbp\Relay\CoreBundle\LocalData\LocalDataAwareTrait;
use Dbp\Relay\CoreBundle\Rest\Entity\NamedEntityInterface;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    shortName: 'BaseCourse',
    types: ['https://schema.org/Course'],
    operations: [
        new Get(
            uriTemplate: '/base/courses/{identifier}',
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
            provider: CourseDataProvider::class
        ),
        new GetCollection(
            uriTemplate: '/base/courses',
            openapi: new Operation(
                tags: ['BaseCourse'],
                parameters: [
                    new Parameter(
                        name: 'search',
                        in: 'query',
                        description: 'Search filter (partial, case-insensitive text search on \'name\' attribute)',
                        required: false,
                        schema: ['type' => 'string'],
                    ),
                    new Parameter(
                        name: 'includeLocal',
                        in: 'query',
                        description: 'Local data attributes to include',
                        required: false,
                        schema: ['type' => 'string'],
                    ),
                    new Parameter(
                        name: 'filter',
                        in: 'query',
                        schema: [
                            'type' => 'object',
                            'additionalProperties' => [
                                'type' => 'string',
                            ],
                        ],
                        style: 'form',
                        explode: true
                    ),
                ]
            ),
            provider: CourseDataProvider::class
        ),
    ],
    normalizationContext: [
        'groups' => ['BaseCourse:output', 'LocalData:output'],
    ]
)]
class Course implements LocalDataAwareInterface, NamedEntityInterface
{
    use LocalDataAwareTrait;

    public const SEARCH_PARAMETER_NAME = 'search';

    #[Groups(['BaseCourse:output'])]
    private ?string $identifier = null;

    #[Groups(['BaseCourse:output'])]
    private ?string $code = null;

    #[Groups(['BaseCourse:output'])]
    private ?string $name = null;

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(?string $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }
}
