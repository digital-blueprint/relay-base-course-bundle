<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\Service;

use Dbp\Relay\BaseCourseBundle\API\CourseProviderInterface;
use Dbp\Relay\BaseCourseBundle\Entity\Course;

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
}
