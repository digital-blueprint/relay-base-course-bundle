<?php

declare(strict_types=1);

namespace Dbp\Relay\CourseBundle\Service;

use Dbp\Relay\CourseBundle\Entity\Course;

class ExternalApi implements CourseProviderInterface
{
    private $courses;

    public function __construct(MyCustomService $service)
    {
        // Make phpstan happy
        $service = $service;

        $this->courses = [];
        $course1 = new Course();
        $course1->setIdentifier('graz');
        $course1->setName('Graz');

        $course2 = new Course();
        $course2->setIdentifier('vienna');
        $course2->setName('Vienna');

        $this->courses[] = $course1;
        $this->courses[] = $course2;
    }

    public function getCourseById(string $identifier): ?Course
    {
        foreach ($this->courses as $course) {
            if ($course->getIdentifier() === $identifier) {
                return $course;
            }
        }

        return null;
    }

    public function getCourses(): array
    {
        return $this->courses;
    }
}
