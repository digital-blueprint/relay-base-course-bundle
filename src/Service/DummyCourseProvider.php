<?php

declare(strict_types=1);

namespace Dbp\Relay\CourseBundle\Service;

use DateTime;
use Dbp\Relay\BasePersonBundle\Entity\Person;
use Dbp\Relay\CourseBundle\API\CourseProviderInterface;
use Dbp\Relay\CourseBundle\Entity\Course;
use Dbp\Relay\CourseBundle\Entity\Exam;

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

    public function getCoursesByPerson(string $personId, array $options = []): array
    {
        return $this->getCourses($options);
    }

    public function getStudentsByCourse(string $courseId, array $options = []): array
    {
        $person = new Person();
        $person->setIdentifier('123');
        $person->setFamilyName('Spencer');
        $person->setGivenName('Bud');
        $person->setEmail('bud@spencer.net');
        $person->setBirthDate('1.1.1950');

        return [$person];
    }

    public function getExamsByCourse(string $courseId, array $options = []): array
    {
        $exam = new Exam();
        $exam->setIdentifier('123');
        $exam->setDescription('Oral exam');
        $exam->setStartDate(new DateTime('25.08.2021 8:00AM'));
        $exam->setEndDate(new DateTime('25.08.2021 10:00AM'));
        $exam->setLocation('In a room');

        return [$exam];
    }
}
