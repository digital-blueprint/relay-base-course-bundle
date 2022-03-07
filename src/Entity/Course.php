<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Dbp\Relay\BaseCourseBundle\Controller\GetCoursesByOrganization;
use Dbp\Relay\BaseCourseBundle\Controller\GetCoursesByPerson;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={
 *         "get" = {
 *             "path" = "/base/courses",
 *             "openapi_context" = {
 *                 "tags" = {"BaseCourse"},
 *                 "parameters" = {
 *                     {"name" = "lang", "in" = "query", "description" = "Language of result", "type" = "string", "enum" = {"de", "en"}, "example" = "de"},
 *                     {"name" = "term", "in" = "query", "description" = "Teaching term", "type" = "string", "enum" = {"W", "S"}, "example" = "W"},
 *                 }
 *             }
 *         },
 *         "get_by_organization" = {
 *             "method" = "GET",
 *             "path" = "/base/organizations/{identifier}/courses",
 *             "controller" = GetCoursesByOrganization::class,
 *             "read" = false,
 *             "openapi_context" = {
 *                 "tags" = {"BaseCourse"},
 *                 "summary" = "Get the Courses related to an organization.",
 *                 "parameters" = {
 *                     {"name" = "lang", "in" = "query", "description" = "Language of result", "type" = "string", "enum" = {"de", "en"}, "example" = "de"},
 *                     {"name" = "identifier", "in" = "path", "description" = "Id of Organization", "required" = true, "type" = "string", "example" = "123456"},
 *                     {"name" = "term", "in" = "query", "description" = "Teaching term", "type" = "string", "enum" = {"W", "S"}, "example" = "W"},
 *                 }
 *             },
 *         },
 *         "get_by_person" = {
 *             "method" = "GET",
 *             "path" = "/base/people/{identifier}/courses",
 *             "controller" = GetCoursesByPerson::class,
 *             "read" = false,
 *             "openapi_context" = {
 *                 "tags" = {"BaseCourse"},
 *                 "summary" = "Get the Courses related to a person.",
 *                 "parameters" = {
 *                     {"name" = "lang", "in" = "query", "description" = "Language of result", "type" = "string", "enum" = {"de", "en"}, "example" = "de"},
 *                     {"name" = "identifier", "in" = "path", "description" = "Id of person", "required" = true, "type" = "string", "example" = "woody007"},
 *                     {"name" = "term", "in" = "query", "description" = "Teaching term", "type" = "string", "enum" = {"W", "S"}, "example" = "W"},
 *                 }
 *             },
 *         },
 *     },
 *     itemOperations={
 *         "get" = {
 *             "path" = "/base/courses/{identifier}",
 *             "openapi_context" = {
 *                 "tags" = {"BaseCourse"},
 *                 "parameters" = {
 *                     {"name" = "identifier", "in" = "path", "description" = "Id of course", "required" = true, "type" = "string", "example" = "257571"},
 *                     {"name" = "lang", "in" = "query", "description" = "Language of result", "type" = "string", "enum" = {"de", "en"}, "example" = "de"}
 *                 }
 *             }
 *         }
 *     },
 *     iri="https://schema.org/Course",
 *     normalizationContext={"groups" = {"BaseCourse:output"}, "jsonld_embed_context" = true},
 * )
 */
class Course implements CourseInterface
{
    use CourseTrait;
}
