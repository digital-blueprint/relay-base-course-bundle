<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\Service;

use Dbp\Relay\BaseCourseBundle\API\CourseProviderInterface;
use Dbp\Relay\BaseCourseBundle\Entity\Course;
use Dbp\Relay\BaseCourseBundle\Entity\CourseAttendee;

class DummyCourseProvider implements CourseProviderInterface
{
    public function getCourseById(string $identifier, array $options = []): Course
    {
        $course = new Course();
        $course->setIdentifier($identifier);
        $course->setName('Field Theory');

        return $course;
    }

    public function getCourses(int $currentPageNumber, int $maxNumItemsPerPage, array $options = []): array
    {
        return [$this->getCourseById('123', $options)];
    }

    public function getAttendeesByCourse(string $courseId, int $currentPageNumber, int $maxNumItemsPerPage, array $options = []): array
    {
        $attendee = new CourseAttendee();
        $attendee->setIdentifier('aeinstein');
        $attendee->setGivenName('Albert');
        $attendee->setFamilyName('Einstein');
        $attendee->setEmail('info@einstein.com');

        return [$attendee];
    }
}
