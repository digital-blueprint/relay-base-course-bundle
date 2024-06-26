<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\Entity;

use Dbp\Relay\BaseCourseBundle\Controller\GetAttendeesByCourse;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Currently disabled (privacy of students not clarified):
 * ApiResource(
 *     collectionOperations={
 *         "get" = {
 *             "path" = "/course_attendees",
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY')",
 *             "openapi_context" = {
 *                 "tags" = {"BaseCourse"}
 *             }
 *         },
 *         "get_bycourse" = {
 *             "method" = "GET",
 *             "path" = "/base/courses/{identifier}/attendees",
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY')",
 *             "pagination_client_partial" = true,
 *             "controller" = GetAttendeesByCourse::class,
 *             "read" = false,
 *             "normalization_context" = {
 *                 "jsonld_embed_context" = true,
 *                 "groups" = {"CourseAttendee:output"}
 *             },
 *             "openapi_context" = {
 *                 "tags" = {"BaseCourse"},
 *                 "summary" = "Get the attendees of a course.",
 *                 "parameters" = {
 *                     {"name" = "identifier", "in" = "path", "description" = "Resource identifier", "required" = true, "type" = "string", "example" = "257571"},
 *                 }
 *             }
 *         }
 *     },
 *     itemOperations={
 *         "get" = {
 *             "path" = "/course_attendees/{identifier}",
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY')",
 *             "openapi_context" = {
 *                 "tags" = {"BaseCourse"}
 *             }
 *         }
 *     },
 *     iri="http://schema.org/Person",
 *     shortName="CourseAttendee",
 *     description="A person attending a course",
 *     normalizationContext={
 *         "groups" = {"CourseAttendee:output"},
 *         "jsonld_embed_context" = true,
 *     }
 * ).
 */
class CourseAttendee
{
    /**
     * ApiProperty(identifier=true).
     *
     * @var string
     */
    #[Groups(['CourseAttendee:output'])]
    private $identifier;

    /**
     * ApiProperty(iri="http://schema.org/givenName").
     *
     * @var string
     */
    #[Groups(['CourseAttendee:output'])]
    private $givenName;

    /**
     * ApiProperty(iri="http://schema.org/familyName").
     *
     * @var string
     */
    #[Groups(['CourseAttendee:output'])]
    private $familyName;

    /**
     * ApiProperty(iri="http://schema.org/email").
     *
     * @var string
     */
    #[Groups(['CourseAttendee:output'])]
    private $email;

    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function getGivenName(): ?string
    {
        return $this->givenName;
    }

    public function setGivenName(string $givenName): void
    {
        $this->givenName = $givenName;
    }

    public function getFamilyName(): ?string
    {
        return $this->familyName;
    }

    public function setFamilyName(string $familyName): void
    {
        $this->familyName = $familyName;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
}
