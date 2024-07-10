<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\Tests;

use Dbp\Relay\BaseCourseBundle\Entity\Course;
use PHPUnit\Framework\TestCase;

class CourseTest extends TestCase
{
    public function testBasics()
    {
        $org = new Course();
        $this->assertNull($org->getIdentifier());
        $this->assertNull($org->getName());

        $org->setIdentifier('id');
        $this->assertSame('id', $org->getIdentifier());
        $org->setName('name');
        $this->assertSame('name', $org->getName());
    }
}
