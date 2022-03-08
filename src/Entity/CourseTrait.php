<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Serializer\Annotation\Groups;

trait CourseTrait
{
    /**
     * @ApiProperty(identifier=true)
     */
    private $identifier;

    /**
     * @ApiProperty(iri="https://schema.org/name")
     * @Groups({"BaseCourse:output"})
     *
     * @var string
     */
    private $name;

    /**
     * @ApiProperty
     * @Groups({"BaseCourse:output"})
     *
     * @var string
     */
    private $type;

    /**
     * @ApiProperty(iri="https://schema.org/description")
     * @Groups({"BaseCourse:output"})
     *
     * @var string
     */
    private $description;

    /**
     * @ApiProperty(iri="https://schema.org/additionalProperty")
     * @Groups({"BaseCourse:output"})
     *
     * @var array
     */
    private $localData;

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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * Allows attaching local data to a Course object.
     *
     * @param ?mixed $value
     */
    public function setLocalData(string $key, $value): void
    {
        $this->localData[$key] = $value;
    }

    /**
     * Gets local data from a Course object.
     *
     * @return ?mixed
     */
    public function getLocalData(string $key)
    {
        return $this->localData[$key] ?? null;
    }
}
