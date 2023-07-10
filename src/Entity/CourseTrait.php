<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\Entity;

use Symfony\Component\Serializer\Annotation\Groups;

trait CourseTrait
{
    /**
     * @Groups({"BaseCourse:output"})
     */
    private $identifier;

    /**
     * @Groups({"BaseCourse:output"})
     *
     * @var string
     */
    private $name;

    /**
     * @Groups({"BaseCourse:output"})
     *
     * @var string
     */
    private $type;

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }
}
