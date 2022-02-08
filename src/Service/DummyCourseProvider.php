<?php

declare(strict_types=1);

namespace Dbp\Relay\CourseBundle\Service;

use Dbp\Relay\CourseBundle\API\CourseProviderInterface;
use Dbp\Relay\CourseBundle\Entity\Course;

class DummyCourseProvider implements CourseProviderInterface
{
    public function getCourseById(string $identifier, array $options = []): ?Course
    {
        $course = new Course();
        $course->setIdentifier($identifier);
        $course->setName('Field Theory');
        $course->setDescription('News from field theory');

        return $course;
    }

    public function getCourses(array $options = []): array
    {
        $course = $this->getCourseById('123', $options);
        assert($course !== null);

        return [$course];
    }

    public function getCoursesByOrganization(string $orgUnitId, array $options = []): array
    {
        return $this->getCourses($options);
    }
}
