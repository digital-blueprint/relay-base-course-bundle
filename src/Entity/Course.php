<?php

declare(strict_types=1);

namespace Dbp\Relay\CourseBundle\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={
 *         "get" = {
 *             "openapi_context" = {
 *                 "tags" = {"Courses"},
 *                 "parameters" = {
 *                     {"name" = "lang", "in" = "query", "description" = "Language of result", "type" = "string", "enum" = {"de", "en"}, "example" = "de"}
 *                 }
 *             }
 *         },
 *         "get_byorganization" = {
 *             "method" = "GET",
 *             "path" = "/base/organizations/{id}/courses",
 *             "controller" = GetCoursesByOrganization::class,
 *             "read" = false,
 *             "openapi_context" = {
 *                 "tags" = {"Courses"},
 *                 "summary" = "Get the Courses related to an organization.",
 *                 "parameters" = {
 *                     {"name" = "lang", "in" = "query", "description" = "Language of result", "type" = "string", "enum" = {"de", "en"}, "example" = "de"},
 *                     {"name" = "id", "in" = "path", "description" = "Id of Organization", "required" = true, "type" = "string", "example" = "123456"}
 *                 }
 *             },
 *         },
 *         "get_byperson" = {
 *             "method" = "GET",
 *             "path" = "/base/people/{id}/courses",
 *             "controller" = GetCoursesByPerson::class,
 *             "read" = false,
 *             "openapi_context" = {
 *                 "tags" = {"Courses"},
 *                 "summary" = "Get the Courses related to a person.",
 *                 "parameters" = {
 *                     {"name" = "lang", "in" = "query", "description" = "Language of result", "type" = "string", "enum" = {"de", "en"}, "example" = "de"},
 *                     {"name" = "id", "in" = "path", "description" = "Id of Organization", "required" = true, "type" = "string", "example" = "123456"}
 *                 }
 *             },
 *         },
 *     },
 *     itemOperations={
 *         "get" = {
 *             "openapi_context" = {
 *                 "tags" = {"Courses"},
 *                 "parameters" = {
 *                     {"name" = "lang", "in" = "query", "description" = "Language of result", "type" = "string", "enum" = {"de", "en"}, "example" = "de"}
 *                 }
 *             }
 *         }
 *     },
 *     iri="https://schema.org/Course",
 *     normalizationContext={"groups" = {"Course:output"}, "jsonld_embed_context" = true},
 *     denormalizationContext={"groups" = {"Course:input"}, "jsonld_embed_context" = true}
 * )
 */
class Course
{
    /**
     * @ApiProperty(identifier=true)
     */
    private $identifier;

    /**
     * @ApiProperty(iri="https://schema.org/name")
     * @Groups({"Course:output"})
     *
     * @var string
     */
    private $name;

    /**
     * @ApiProperty
     * @Groups({"Course:output"})
     *
     * @var string
     */
    private $type;

    /**
     * @ApiProperty(iri="https://schema.org/description")
     * @Groups({"Course:output"})
     *
     * @var string
     */
    private $description;

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
}
