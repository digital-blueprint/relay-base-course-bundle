<?php

declare(strict_types=1);

namespace Dbp\Relay\CourseBundle\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use Dbp\Relay\CourseBundle\Entity\Course;
use Dbp\Relay\CourseBundle\Service\CourseProviderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CourseDataPersister extends AbstractController implements DataPersisterInterface
{
    private $api;

    public function __construct(CourseProviderInterface $api)
    {
        $this->api = $api;
    }

    public function supports($data): bool
    {
        return $data instanceof Course;
    }

    public function persist($data): void
    {
        // TODO
    }

    public function remove($data)
    {
        // TODO
    }
}
