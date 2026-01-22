<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\Service;

use Dbp\Relay\BaseCourseBundle\API\CourseProviderInterface;
use Dbp\Relay\BaseCourseBundle\Entity\Course;
use Dbp\Relay\BaseCourseBundle\Entity\CourseClass;

class DummyCourseProvider implements CourseProviderInterface
{
    public function getCourseById(string $identifier, array $options = []): ?Course
    {
        $course = null;
        if ($identifier !== '404') {
            $course = new Course();
            $course->setIdentifier($identifier);
            $course->setCode('C0815');
            $course->setName('Field Theory');
        }

        return $course;
    }

    public function getCourses(int $currentPageNumber, int $maxNumItemsPerPage, array $options = []): array
    {
        return [$this->getCourseById('123', $options)];
    }

    public function getCourseClassById(string $identifier, array $options = []): ?CourseClass
    {
        $courseDate = null;
        if ($identifier !== '404') {
            $courseDate = new CourseClass();
            $courseDate->setIdentifier($identifier);
            $courseDate->setCourseIdentifier('123');
            $courseDate->setStartAt(new \DateTimeImmutable('2024-10-01'));
            $courseDate->setEndAt(new \DateTimeImmutable('2024-12-15'));
        }

        return $courseDate;
    }

    public function getCourseClasses(int $currentPageNumber, int $maxNumItemsPerPage, array $options = []): array
    {
        return [$this->getCourseClassById('456', $options)];
    }
}
