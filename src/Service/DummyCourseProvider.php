<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\Service;

use Dbp\Relay\BaseCourseBundle\API\CourseProviderInterface;
use Dbp\Relay\BaseCourseBundle\Entity\Course;
use Dbp\Relay\BaseCourseBundle\Entity\CourseEvent;

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

    public function getCourseEventById(string $identifier, array $options = []): ?CourseEvent
    {
        $courseDate = null;
        if ($identifier !== '404') {
            $courseDate = $this->getEvent($identifier, '123');
        }

        return $courseDate;
    }

    public function getCourseEvents(int $currentPageNumber, int $maxNumItemsPerPage,
        array $filters = [], array $options = []): array
    {
        return [$this->getEvent('456', $filters['courseIdentifier'] ?? '123')];
    }

    private function getEvent(string $identifier, string $courseIdentifier): CourseEvent
    {
        $courseDate = new CourseEvent();
        $courseDate->setIdentifier($identifier);
        $courseDate->setCourseIdentifier($courseIdentifier);
        $courseDate->setStartAt(new \DateTimeImmutable('2024-10-01'));
        $courseDate->setEndAt(new \DateTimeImmutable('2024-12-15'));

        return $courseDate;
    }
}
