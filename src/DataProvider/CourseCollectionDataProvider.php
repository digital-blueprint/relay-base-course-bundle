<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use Dbp\Relay\BaseCourseBundle\API\CourseProviderInterface;
use Dbp\Relay\BaseCourseBundle\Entity\Course;
use Dbp\Relay\CoreBundle\LocalData\LocalData;
use Dbp\Relay\CoreBundle\Pagination\Pagination;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CourseCollectionDataProvider extends AbstractController implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{
    /** @var CourseProviderInterface */
    private $courseProvider;

    public function __construct(CourseProviderInterface $courseProvider)
    {
        $this->courseProvider = $courseProvider;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Course::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $filters = $context['filters'] ?? [];
        $options = [];
        $options['lang'] = $filters['lang'] ?? 'de';

        if ($search = ($filters['search'] ?? null)) {
            $options['search'] = $search;
        }

        LocalData::addOptions($options, $filters);
        Pagination::addOptions($options, $filters);

        return $this->courseProvider->getCourses($options);
    }
}
