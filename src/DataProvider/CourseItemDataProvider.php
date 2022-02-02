<?php

declare(strict_types=1);

namespace Dbp\Relay\CourseBundle\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use Dbp\Relay\CourseBundle\API\CourseProviderInterface;
use Dbp\Relay\CourseBundle\Entity\Course;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CourseItemDataProvider extends AbstractController implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    private $api;

    public function __construct(CourseProviderInterface $api)
    {
        $this->api = $api;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Course::class === $resourceClass;
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Course
    {
        return $this->api->getCourseById($id);
    }
}
