<?php

declare(strict_types=1);

namespace Dbp\Relay\CourseBundle\API;

use Dbp\Relay\BasePersonBundle\Entity\Person;
use Dbp\Relay\CourseBundle\Entity\Course;
use Dbp\Relay\CourseBundle\Entity\Exam;

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
     * @return Person[]
     */
    public function getStudentsByCourse(string $courseId, array $options = []): array;

    /**
     * @return Exam[]
     */
    public function getExamsByCourse(string $courseId, array $options = []): array;
}
