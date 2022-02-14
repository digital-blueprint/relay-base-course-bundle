<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\API;

use Dbp\Relay\BaseCourseBundle\Entity\Course;
use Dbp\Relay\BaseCourseBundle\Entity\CourseAttendee;

interface CourseProviderInterface
{
    public function getCourseById(string $identifier, array $options = []): ?Course;

    /**
     * @return Course[]
     */
    public function getCourses(array $options = []): array;

    /**
     * @return Course[]
     */
    public function getCoursesByOrganization(string $orgUnitId, array $options = []): array;

    /**
     * @return Course[]
     */
    public function getCoursesByPerson(string $personId, array $options = []): array;

    /**
     * @return CourseAttendee[]
     */
    public function getAttendeesByCourse(string $courseId, array $options = []): array;
}
