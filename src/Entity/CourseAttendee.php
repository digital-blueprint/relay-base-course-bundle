<?php

declare(strict_types=1);

namespace Dbp\Relay\CourseBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Dbp\Relay\BasePersonBundle\Entity\PersonInterface;
use Dbp\Relay\BasePersonBundle\Entity\PersonTrait;
use Dbp\Relay\CourseBundle\Controller\GetAttendeesByCourse;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={
 *         "get" = {
 *             "path" = "/course_attendees",
 *             "openapi_context" = {
 *                 "tags" = {"Courses"}
 *             }
 *         },
 *         "get_bycourse" = {
 *             "method" = "GET",
 *             "path" = "/courses/{identifier}/attendees",
 *             "controller" = GetAttendeesByCourse::class,
 *             "read" = false,
 *             "normalization_context" = {
 *                 "jsonld_embed_context" = true,
 *                 "groups" = {"BasePerson:output"}
 *             },
 *             "openapi_context" = {
 *                 "tags" = {"Courses"},
 *                 "summary" = "Get the attendees of a course.",
 *                 "parameters" = {
 *                     {"name" = "identifier", "in" = "path", "description" = "Id of course", "required" = true, "type" = "string", "example" = "123456"},
 *                     {"name" = "lang", "in" = "query", "description" = "Language of result", "type" = "string", "enum" = {"de", "en"}, "example" = "de"}
 *                 }
 *             }
 *         }
 *     },
 *     itemOperations={
 *         "get" = {
 *             "path" = "/course_attendees/{identifier}",
 *             "openapi_context" = {
 *                 "tags" = {"Courses"}
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
