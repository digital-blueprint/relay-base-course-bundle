<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use Dbp\Relay\BaseCourseBundle\API\CourseProviderInterface;
use Dbp\Relay\BaseCourseBundle\Entity\Course;
use Dbp\Relay\CoreBundle\Helpers\ArrayFullPaginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CourseCollectionDataProvider extends AbstractController implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private $courseProvider;

    public function __construct(CourseProviderInterface $courseProvider)
    {
        $this->courseProvider = $courseProvider;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Course::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): ArrayFullPaginator
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $options = [];
        $filters = $context['filters'] ?? [];
        $options['lang'] = $filters['lang'] ?? 'de';
        $term = $filters['term'] ?? null;
        if ($term !== null) {
            $options['term'] = $term;
        }

        $organizationId = $filters['organizationId'] ?? null;
        $personId = $filters['personId'] ?? null;

        $courses = null;
        if (!empty($organizationId) || !empty($personId)) {
            if (!empty($organizationId)) {
                $courses = $this->courseProvider->getCoursesByOrganization($organizationId, $options);
            }
            if (!empty($personId)) {
                $coursesByPerson = $this->courseProvider->getCoursesByPerson($personId, $options);
                if (!empty($organizationId)) {
                    $courses = array_uintersect($courses, $coursesByPerson, compareCourses);
                } else {
                    $courses = $coursesByPerson;
                }
            }
        } else {
            $courses = $this->courseProvider->getCourses($options);
        }

        $page = 1;
        if (isset($filters['page'])) {
            $page = (int) $filters['page'];
        }

        $perPage = 30;
        if (isset($filters['perPage'])) {
            $perPage = (int) $filters['perPage'];
        }

        return new ArrayFullPaginator($courses, $page, $perPage);
    }

    private static function compareCourses(Course $a, Course $b): int
    {
        if ($a->getIdentifier() > $b->getIdentifier()) {
            return 1;
        } else if ($a->getIdentifier() === $b->getIdentifier()) {
            return 0;
        } else {
            return -1;
        }
    }
}
