<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\Entity;

use Dbp\Relay\CoreBundle\LocalData\LocalDataAwareInterface;
use Dbp\Relay\CoreBundle\LocalData\LocalDataAwareTrait;
use Dbp\Relay\CoreBundle\Rest\Entity\NamedEntityInterface;
use Symfony\Component\Serializer\Annotation\Groups;

class Course implements LocalDataAwareInterface, NamedEntityInterface
{
    use LocalDataAwareTrait;

    public const SEARCH_PARAMETER_NAME = 'search';

    #[Groups(['BaseCourse:output'])]
    private ?string $identifier = null;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }
}
