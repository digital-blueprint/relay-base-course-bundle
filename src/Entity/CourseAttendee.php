<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Dbp\Relay\BaseCourseBundle\Controller\GetAttendeesByCourse;
use Dbp\Relay\BasePersonBundle\Entity\PersonInterface;
use Dbp\Relay\BasePersonBundle\Entity\PersonTrait;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
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
 *             "controller" = GetAttendeesByCourse::class,
 *             "read" = false,
 *             "normalization_context" = {
 *                 "jsonld_embed_context" = true,
 *                 "groups" = {"BasePerson:output"}
 *             },
 *             "openapi_context" = {
 *                 "tags" = {"BaseCourse"},
 *                 "summary" = "Get the attendees of a course.",
 *                 "parameters" = {
 *                     {"name" = "identifier", "in" = "path", "description" = "Resource identifier", "required" = true, "type" = "string", "example" = "257571"},
 *                     {"name" = "lang", "in" = "query", "description" = "Language of result", "type" = "string", "enum" = {"de", "en"}, "example" = "de"}
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
 *         "groups" = {"BasePerson:output"},
 *         "jsonld_embed_context" = true,
 *     }
 * )
 */
class CourseAttendee implements PersonInterface
{
    use PersonTrait;
}
