<?php

declare(strict_types=1);

namespace Dbp\Relay\CourseBundle\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use DateTime;
use DBP\API\CourseBundle\Controller\GetExamsByCourse;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={
 *         "get_bycourse" = {
 *             "method" = "GET",
 *             "path" = "/courses/{id}/exams",
 *             "controller" = GetExamsByCourse::class,
 *             "read" = false,
 *             "openapi_context" = {
 *                 "tags" = {"Courses"},
 *                 "summary" = "Get the Exams for a course.",
 *                 "parameters" = {
 *                     {"name" = "lang", "in" = "query", "description" = "Language of result", "type" = "string", "enum" = {"de", "en"}, "example" = "de"},
 *                     {"name" = "id", "in" = "path", "description" = "Id of Organization", "required" = true, "type" = "string", "example" = "123456"}
 *                 }
 *             },
 *         }
 *     },
 *     itemOperations={},
 *     iri="https://schema.org/EducationEvent",
 *     normalizationContext={"groups" = {"Exam:output"}, "jsonld_embed_context" = true},
 *     denormalizationContext={"groups" = {"Exam:input"}, "jsonld_embed_context" = true}
 * )
 */
class Exam
{
    /**
     * @ApiProperty(identifier=true)
     *
     * @var string
     */
    private $identifier;

    /**
     * @ApiProperty(iri="https://schema.org/description")
     * @Groups({"Exam:output"})
     *
     * @var string
     */
    private $description;

    /**
     * @ApiProperty(iri="https://schema.org/startDate")
     * @Groups({"Exam:output"})
     *
     * @var DateTime
     */
    private $startDate;

    /**
     * @ApiProperty(iri="https://schema.org/endDate")
     * @Groups({"Exam:output"})
     *
     * @var DateTime
     */
    private $endDate;

    /**
     * @ApiProperty(iri="https://schema.org/location")
     * @Groups({"Exam:output"})
     *
     * @var string
     */
    private $location;

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getStartDate(): DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getEndDate(): DateTime
    {
        return $this->endDate;
    }

    public function setEndDate(DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): void
    {
        $this->location = $location;
    }
}
