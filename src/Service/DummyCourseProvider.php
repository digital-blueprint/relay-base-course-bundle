<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\Service;

use Dbp\Relay\BaseCourseBundle\API\CourseProviderInterface;
use Dbp\Relay\BaseCourseBundle\Entity\Course;
use Dbp\Relay\BaseCourseBundle\Entity\CourseAttendee;
use Dbp\Relay\CoreBundle\Pagination\FullPaginator;
use Dbp\Relay\CoreBundle\Pagination\Paginator;

class DummyCourseProvider implements CourseProviderInterface
{
    public function getCourseById(string $identifier, array $options = []): Course
    {
        $course = new Course();
        $course->setIdentifier($identifier);
        $course->setName('Field Theory');

        return $course;
    }

    public function getCourses(array $options = []): Paginator
    {
        $courses = [];
        $courses[] = $this->getCourseById('123', $options);

        return new FullPaginator($courses, 1, count($courses), count($courses));
    }

    public function getCoursesByOrganization(string $orgUnitId, array $options = []): Paginator
    {
        return $this->getCourses($options);
    }

    public function getAttendeesByCourse(string $courseId, array $options = []): Paginator
    {
        $attendee = new CourseAttendee();
        $attendee->setIdentifier('aeinstein');
        $attendee->setGivenName('Albert');
        $attendee->setFamilyName('Einstein');
        $attendee->setEmail('info@einstein.com');

        return new FullPaginator($attendees = [$attendee], 1, count($attendees), count($attendees));
    }

    public function getCoursesByLecturer(string $lecturerId, array $options = []): Paginator
    {
        return $this->getCourses($options);
    }
}
