<?php

declare(strict_types=1);

namespace Dbp\Relay\CourseBundle\Service;

use Dbp\Relay\CourseBundle\Entity\Course;

interface CourseProviderInterface
{
    public function getCourseById(string $identifier): ?Course;

    public function getCourses(): array;
}
