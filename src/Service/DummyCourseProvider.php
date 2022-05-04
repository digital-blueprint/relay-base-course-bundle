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

    public function getAttendeesByCourse(string $courseId, array $options = []): array
    {
        $attendee = new CourseAttendee();
        $attendee->setIdentifier('aeinstein');
        $attendee->setGivenName('Albert');
        $attendee->setFamilyName('Einstein');
        $attendee->setEmail('info@einstein.com');

        return [$attendee];
    }

    public function getCoursesByLecturer(string $lecturerId, array $options = []): array
    {
        return $this->getCourses($options);
    }
}
