<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\API;

use Dbp\Relay\BaseCourseBundle\Entity\Course;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\CoreBundle\Pagination\Paginator;

interface CourseProviderInterface
{
    /**
     * @throws ApiError
     */
    public function getCourseById(string $identifier, array $options = []): Course;

    /**
     * @throws ApiError
     */
    public function getCourses(array $options = []): Paginator;

    /**
     * @throws ApiError
     */
    public function getCoursesByOrganization(string $orgUnitId, array $options = []): Paginator;

    /**
     * @throws ApiError
     */
    public function getCoursesByLecturer(string $lecturerId, array $options = []): Paginator;

    /**
     * @throws ApiError
     */
    public function getAttendeesByCourse(string $courseId, array $options = []): Paginator;
}
