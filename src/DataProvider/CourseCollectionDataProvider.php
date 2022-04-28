<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use Dbp\Relay\BaseCourseBundle\API\CourseProviderInterface;
use Dbp\Relay\BaseCourseBundle\Entity\Course;
use Dbp\Relay\CoreBundle\Helpers\ArrayFullPaginator;
use Dbp\Relay\CoreBundle\LocalData\LocalData;
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

        $filters = $context['filters'] ?? [];

        $options = [];
        $options['lang'] = $filters['lang'] ?? 'de';

        if ($term = ($filters['term'] ?? null)) {
            $options['term'] = $term;
        }

        $options[LocalData::INCLUDE_PARAMETER_NAME] = LocalData::getIncludeParameter($filters);

        $organizationId = $filters['organization'] ?? null;
        $lecturerId = $filters['lecturer'] ?? null;

        $courses = null;
        if (!empty($organizationId) || !empty($lecturerId)) {
            if (!empty($organizationId)) {
                $courses = $this->courseProvider->getCoursesByOrganization($organizationId, $options);
            }
            if (!empty($lecturerId)) {
                $coursesByPerson = $this->courseProvider->getCoursesByPerson($lecturerId, $options);
                if (!empty($organizationId)) {
                    $courses = array_uintersect($courses, $coursesByPerson,
                        'Dbp\Relay\BaseCourseBundle\DataProvider\CourseCollectionDataProvider::compareCourses');
                    $courses = array_values($courses);
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
