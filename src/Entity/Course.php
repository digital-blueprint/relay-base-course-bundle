<?php

declare(strict_types=1);

namespace Dbp\Relay\CourseBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Dbp\Relay\CourseBundle\Controller\GetCoursesByOrganization;
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
 * )
 */
class Course implements CourseInterface
{
    use CourseTrait;
}
