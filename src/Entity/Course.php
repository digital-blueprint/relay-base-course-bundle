<?php

declare(strict_types=1);

namespace Dbp\Relay\CourseBundle\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Dbp\Relay\CourseBundle\Controller\LoggedInOnly;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={
 *         "get" = {
 *             "path" = "/course/courses",
 *             "openapi_context" = {
 *                 "tags" = {"Course API"},
 *             },
 *         }
 *     },
 *     itemOperations={
 *         "get" = {
 *             "path" = "/course/courses/{identifier}",
 *             "openapi_context" = {
 *                 "tags" = {"Course API"},
 *             },
 *         },
 *         "put" = {
 *             "path" = "/course/courses/{identifier}",
 *             "openapi_context" = {
 *                 "tags" = {"Course API"},
 *             },
 *         },
 *         "delete" = {
 *             "path" = "/course/courses/{identifier}",
 *             "openapi_context" = {
 *                 "tags" = {"Course API"},
 *             },
 *         },
 *         "loggedin_only" = {
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY')",
 *             "method" = "GET",
 *             "path" = "/course/courses/{identifier}/loggedin-only",
 *             "controller" = LoggedInOnly::class,
 *             "openapi_context" = {
 *                 "summary" = "Only works when logged in.",
 *                 "tags" = {"Course API"},
 *             },
 *         }
 *     },
 *     iri="https://schema.org/Course",
 *     shortName="CourseCourse",
 *     normalizationContext={
 *         "groups" = {"CourseCourse:output"},
 *         "jsonld_embed_context" = true
 *     },
 *     denormalizationContext={
 *         "groups" = {"CourseCourse:input"},
 *         "jsonld_embed_context" = true
 *     }
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
     * @Groups({"CourseCourse:output", "CourseCourse:input"})
     *
     * @var string
     */
    private $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }
}
