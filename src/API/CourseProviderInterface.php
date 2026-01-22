<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\API;

use Dbp\Relay\BaseCourseBundle\Entity\Course;
use Dbp\Relay\BaseCourseBundle\Entity\CourseEvent;
use Dbp\Relay\CoreBundle\Exception\ApiError;

interface CourseProviderInterface
{
    /**
     * @param array $options Available options:
     *                       * Locale::LANGUAGE_OPTION (language in ISO 639‑1 format)
     *                       * LocalData::INCLUDE_PARAMETER_NAME
     *
     * @throws ApiError
     */
    public function getCourseById(string $identifier, array $options = []): ?Course;

    /**
     * @param array $options Available options:
     *                       * Locale::LANGUAGE_OPTION (language in ISO 639‑1 format)
     *                       * Course::SEARCH_PARAMETER_NAME (partial, case-insensitive text search on 'name' attribute)
     *                       * LocalData::INCLUDE_PARAMETER_NAME
     *
     * @return Course[]
     *
     * @throws ApiError
     */
    public function getCourses(int $currentPageNumber, int $maxNumItemsPerPage, array $options = []): array;

    public function getCourseEventById(string $identifier, array $options = []): ?CourseEvent;

    /**
     * @param array $options Available options:
     *                       * LocalData::INCLUDE_PARAMETER_NAME
     *
     * @return CourseEvent[]
     *
     * @throws ApiError
     */
    public function getCourseEvents(int $currentPageNumber, int $maxNumItemsPerPage, array $filters = [], array $options = []): array;
}
