<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Dbp\Relay\CoreBundle\LocalData\LocalDataAwareInterface;
use Dbp\Relay\CoreBundle\LocalData\LocalDataAwareTrait;

/**
 * @ApiResource(
 *     collectionOperations={
 *         "get" = {
 *             "path" = "/base/courses",
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY')",
 *             "pagination_client_partial" = true,
 *             "openapi_context" = {
 *                 "tags" = {"BaseCourse"},
 *                 "parameters" = {
 *                     {"name" = "search", "in" = "query", "description" = "Search filter (partial, case-insensitive text search on 'name' attribute)", "type" = "string", "required" = false},
 *                     {"name" = "queryLocal", "in" = "query", "description" = "Local query parameters to apply", "type" = "string"},
 *                     {"name" = "includeLocal", "in" = "query", "description" = "Local data attributes to include", "type" = "string"}
 *                 }
 *             }
 *         }
 *     },
 *     itemOperations={
 *         "get" = {
 *             "path" = "/base/courses/{identifier}",
 *             "security" = "is_granted('IS_AUTHENTICATED_FULLY')",
 *             "openapi_context" = {
 *                 "tags" = {"BaseCourse"},
 *                 "parameters" = {
 *                     {"name" = "identifier", "in" = "path", "description" = "Resource identifier", "required" = true, "type" = "string", "example" = "257571"},
 *                     {"name" = "includeLocal", "in" = "query", "description" = "Local data attributes to include", "type" = "string"}
 *                 }
 *             }
 *         }
 *     },
 *     shortName="BaseCourse",
 *     iri="https://schema.org/Course",
 *     normalizationContext={"groups" = {"BaseCourse:output", "LocalData:output"}, "jsonld_embed_context" = true},
 * )
 */
class Course implements CourseInterface, LocalDataAwareInterface
{
    use LocalDataAwareTrait;
    use CourseTrait;

    public const SEARCH_PARAMETER_NAME = 'search';
}
