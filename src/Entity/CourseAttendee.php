<?php

declare(strict_types=1);

namespace Dbp\Relay\CourseBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Dbp\Relay\BasePersonBundle\Entity\PersonTrait;

/**
 * @ApiResource(
 *     collectionOperations={
 *         "get_bycourse" = {
 *             "method" = "GET",
 *             "path" = "/courses/{id}/attendees",
 *             "controller" = GetStudentsByCourse::class,
 *             "read" = false,
 *             "openapi_context" = {
 *                 "tags" = {"Courses"},
 *                 "summary" = "Get the attendees attending to a course.",
 *                 "parameters" = {
 *                     {"name" = "lang", "in" = "query", "description" = "Language of result", "type" = "string", "enum" = {"de", "en"}, "example" = "de"},
 *                     {"name" = "id", "in" = "path", "description" = "Id of Organization", "required" = true, "type" = "string", "example" = "123456"}
 *                 }
 *             },
 *         }
 *     },
 *     itemOperations={},
 *     iri="https://schema.org/EducationEvent",
 *     normalizationContext={"groups" = {"BasePerson:output"}, "jsonld_embed_context" = true},
 *     denormalizationContext={"groups" = {"BasePerson:input"}, "jsonld_embed_context" = true}
 * )
 */
class CourseAttendee
{
    use PersonTrait;
}
