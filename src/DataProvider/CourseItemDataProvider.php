<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use Dbp\Relay\BaseCourseBundle\API\CourseProviderInterface;
use Dbp\Relay\BaseCourseBundle\Entity\Course;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

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
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $options = [];
        $filters = $context['filters'] ?? [];
        $options['lang'] = $filters['lang'] ?? 'de';

        if ($include = ($filters['include'] ?? null)) {
            if ($include === 'localData') {
                $options['includeLocalData'] = true;
            } else {
                throw new ApiError(Response::HTTP_BAD_REQUEST, 'requested inclusion of unknown resource '.$include);
            }
        }

        return $this->api->getCourseById($id, $options);
    }
}
