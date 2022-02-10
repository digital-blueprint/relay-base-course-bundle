<?php

declare(strict_types=1);

namespace Dbp\Relay\CourseBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Dbp\Relay\BasePersonBundle\Controller\GetAtteendeesByCourse;
use Dbp\Relay\BasePersonBundle\Entity\PersonInterface;
use Dbp\Relay\BasePersonBundle\Entity\PersonTrait;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={
 *         "get" = {
 *             "openapi_context" = {
 *                 "tags" = {"Courses"}
 *             }
 *         },
 *         "get_bycourse" = {
 *             "method" = "GET",
 *             "path" = "/courses/{identifier}/attendees",
 *             "controller" = GetAtteendeesByCourse::class,
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
 *             "openapi_context" = {
 *                 "tags" = {"Courses"}
 *             }
 *         }
 *     },
 *     iri="http://schema.org/Person",
 *     shortName="BasePerson",
 *     description="A person of the LDAP system",
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
