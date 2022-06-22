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

        if ($term = ($filters['term'] ?? null)) {
            $options['term'] = $term;
        }

        if ($includeParameter = LocalData::getIncludeParameter($filters)) {
            $options[LocalData::INCLUDE_PARAMETER_NAME] = $includeParameter;
        }

        $organizationId = $filters['organization'] ?? '';
        $lecturerId = $filters['lecturer'] ?? '';

        $filterByOrganizationId = $organizationId !== '';
        $filterByLecturerId = $lecturerId !== '';

        if (!($filterByOrganizationId && $filterByLecturerId)) {
            Pagination::addPaginationOptions($options, $filters);
        } // else (both filters provided) -> request paginators holding the whole set of results since we need to intersect them

        $coursePaginator = null;
        if ($filterByOrganizationId || $filterByLecturerId) {
            if ($filterByOrganizationId) {
                $coursePaginator = $this->courseProvider->getCoursesByOrganization($organizationId, $options);
            }
            if ($filterByLecturerId) {
                $coursesByPersonPaginator = $this->courseProvider->getCoursesByLecturer($lecturerId, $options);

                if (!$filterByOrganizationId) {
                    $coursePaginator = $coursesByPersonPaginator;
                } else {
                    $intersection = array_uintersect($coursePaginator->getItems(), $coursesByPersonPaginator->getItems(),
                        'Dbp\Relay\BaseCourseBundle\DataProvider\CourseCollectionDataProvider::compareCourses');
                    $courses = array_values($intersection);
                    Pagination::addPaginationOptions($options, $filters);
                    $coursePaginator = Pagination::createWholeResultPaginator($courses, $options);
                }
            }
        } else {
            $coursePaginator = $this->courseProvider->getCourses($options);
        }

        return $coursePaginator ?? [];
    }

    public static function compareCourses(Course $a, Course $b): int
    {
        if ($a->getIdentifier() > $b->getIdentifier()) {
            return 1;
        } elseif ($a->getIdentifier() === $b->getIdentifier()) {
            return 0;
        } else {
            return -1;
        }
    }
}
