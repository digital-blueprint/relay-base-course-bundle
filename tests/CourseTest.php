<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\Tests;

use Dbp\Relay\BaseCourseBundle\DataProvider\CourseClassDataProvider;
use Dbp\Relay\BaseCourseBundle\DataProvider\CourseDataProvider;
use Dbp\Relay\BaseCourseBundle\Entity\Course;
use Dbp\Relay\BaseCourseBundle\Entity\CourseClass;
use Dbp\Relay\BaseCourseBundle\Service\DummyCourseProvider;
use Dbp\Relay\CoreBundle\TestUtils\DataProviderTester;
use PHPUnit\Framework\TestCase;

class CourseTest extends TestCase
{
    private ?DataProviderTester $courseDataProviderTester = null;
    private ?DataProviderTester $courseDateDataProviderTester = null;

    protected function setUp(): void
    {
        parent::setUp();

        $courseProvider = new DummyCourseProvider();
        $courseDataProvider = new CourseDataProvider($courseProvider);
        $this->courseDataProviderTester = DataProviderTester::create($courseDataProvider, Course::class);
        DataProviderTester::setUp($courseDataProvider, currentUserAttributes: ['MAY_READ' => true]);
        $courseDataProvider->setConfig(self::getCourseDataProviderConfig());
        $courseDateDataProvider = new CourseClassDataProvider($courseProvider);
        $this->courseDateDataProviderTester = DataProviderTester::create($courseDateDataProvider, CourseClass::class);
        DataProviderTester::setUp($courseDateDataProvider, currentUserAttributes: ['MAY_READ' => true]);
        $courseDateDataProvider->setConfig(self::getCourseDataProviderConfig());
    }

    public function testGetCourseById(): void
    {
        $course = $this->courseDataProviderTester->getItem('123');
        $this->assertInstanceOf(Course::class, $course);
        $this->assertEquals('123', $course->getIdentifier());
        $this->assertEquals('C0815', $course->getCode());
        $this->assertEquals('Field Theory', $course->getName());
    }

    public function testGetGetCourses(): void
    {
        $courses = $this->courseDataProviderTester->getPage(1, 10);
        $this->assertIsArray($courses);
        $this->assertCount(1, $courses);
        $this->assertInstanceOf(Course::class, $courses[0]);
    }

    public function testGetCourseClassById(): void
    {
        $courseDate = $this->courseDateDataProviderTester->getItem('456');
        $this->assertInstanceOf(CourseClass::class, $courseDate);
        $this->assertEquals('456', $courseDate->getIdentifier());
        $this->assertEquals('123', $courseDate->getCourseIdentifier());
        $this->assertEquals(new \DateTimeImmutable('2024-10-01'), $courseDate->getStartAt());
        $this->assertEquals(new \DateTimeImmutable('2024-12-15'), $courseDate->getEndAt());
    }

    public function testGetGetCourseClasses(): void
    {
        $courseDates = $this->courseDateDataProviderTester->getPage(1, 10);
        $this->assertIsArray($courseDates);
        $this->assertCount(1, $courseDates);
        $this->assertInstanceOf(CourseClass::class, $courseDates[0]);
    }

    protected static function getCourseDataProviderConfig(): array
    {
        return [
            'authorization' => [
                'roles' => [
                    'ROLE_READER' => 'user.get("MAY_READ")',
                ],
            ],
            'local_data' => [
                // TODO: test local data
            ],
        ];
    }
}
