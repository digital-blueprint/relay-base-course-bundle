<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\Entity;

use Dbp\Relay\CoreBundle\LocalData\LocalDataAwareInterface;
use Dbp\Relay\CoreBundle\LocalData\LocalDataAwareTrait;

class Course implements CourseInterface, LocalDataAwareInterface
{
    use LocalDataAwareTrait;
    use CourseTrait;

    public const SEARCH_PARAMETER_NAME = 'search';
}
