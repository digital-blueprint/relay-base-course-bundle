<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\Entity;

interface CourseInterface
{
    public function getIdentifier(): string;

    public function setIdentifier(string $identifier): void;

    public function getName(): string;

    public function setName(string $name): void;

    public function getType(): string;

    public function setType(string $type): void;
}
