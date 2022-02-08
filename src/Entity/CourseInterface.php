<?php

declare(strict_types=1);

namespace Dbp\Relay\CourseBundle\Entity;

interface CourseInterface
{
    public function getIdentifier(): string;

    public function setIdentifier(string $identifier): void;

    public function getName(): string;

    public function setName(string $name): void;

    public function getType(): string;

    public function setType(string $type): void;

    public function getDescription(): string;

    public function setDescription(string $description): void;
}
