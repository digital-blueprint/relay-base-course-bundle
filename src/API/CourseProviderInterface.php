<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\API;

use Dbp\Relay\BaseCourseBundle\Entity\Course;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\CoreBundle\Pagination\Paginator;

interface CourseProviderInterface
{
    /**
     * @param array $options Available options:
     *                       * 'lang' ('de' or 'en')
     *                       * LocalData::INCLUDE_PARAMETER_NAME
     *
     * @throws ApiError
     */
    public function getCourseById(string $identifier, array $options = []): Course;

    /**
     * @param array $options Available options:
     *                       * 'lang' ('de' or 'en')
     *                       * Course::SEARCH_PARAMETER_NAME (partial, case-insensitive text search on 'name' attribute)
     *                       * LocalData::INCLUDE_PARAMETER_NAME
     *                       * LocalData::QUERY_PARAMETER_NAME
     *
     * @throws ApiError
     */
    public function getCourses(array $options = []): Paginator;

    /**
     * @param array $options Available options:
     *                       * 'lang' ('de' or 'en')
     *
     * @throws ApiError
     */
    public function getAttendeesByCourse(string $courseId, array $options = []): Paginator;
}
