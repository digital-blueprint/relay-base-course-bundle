<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\API;

use Dbp\Relay\BaseCourseBundle\Entity\Course;
use Dbp\Relay\BaseCourseBundle\Entity\CourseAttendee;
use Dbp\Relay\CoreBundle\Exception\ApiError;

interface CourseProviderInterface
{
    /**
     * @throws ApiError
     */
    public function getCourseById(string $identifier, array $options = []): Course;

    /**
     * @return Course[]
     *
     * @throws ApiError
     */
    public function getCourses(array $options = []): array;

    /**
     * @return Course[]
     *
     * @throws ApiError
     */
    public function getCoursesByOrganization(string $orgUnitId, array $options = []): array;

    /**
     * @return Course[]
     *
     * @throws ApiError
     */
    public function getCoursesByLecturer(string $lecturerId, array $options = []): array;

    /**
     * @return CourseAttendee[]
     *
     * @throws ApiError
     */
    public function getAttendeesByCourse(string $courseId, array $options = []): array;
}
