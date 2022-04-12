<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
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
 *                     {"name" = "organization", "in" = "query", "description" = "Get courses of an organization (ID of BaseOrganization resource)", "required" = false, "type" = "string", "example" = "1190"},
 *                     {"name" = "lecturer", "in" = "query", "description" = "Get courses of a lecturer", "required" = false, "type" = "string", "example" = "woody007"},
 *                     {"name" = "include", "in" = "query", "description" = "Optional resources to include", "type" = "string", "example" = "localData"}
 *                 }
 *             }
 *         }
 *     },
 *     itemOperations={
 *         "get" = {
 *             "path" = "/base/courses/{identifier}",
 *             "openapi_context" = {
 *                 "tags" = {"BaseCourse"},
 *                 "parameters" = {
 *                     {"name" = "identifier", "in" = "path", "description" = "Resource identifier", "required" = true, "type" = "string", "example" = "257571"},
 *                     {"name" = "lang", "in" = "query", "description" = "Language of result", "type" = "string", "enum" = {"de", "en"}, "example" = "de"},
 *                     {"name" = "include", "in" = "query", "description" = "Optional resources to include", "type" = "string", "example" = "localData"}
 *                 }
 *             }
 *         }
 *     },
 *     shortName="BaseCourse",
 *     iri="https://schema.org/Course",
 *     normalizationContext={"groups" = {"BaseCourse:output"}, "jsonld_embed_context" = true},
 * )
 */
class Course implements CourseInterface
{
    use CourseTrait;
}
