<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\DataProvider;

use Dbp\Relay\BaseCourseBundle\API\CourseProviderInterface;
use Dbp\Relay\BaseCourseBundle\DependencyInjection\Configuration;
use Dbp\Relay\BaseCourseBundle\Entity\Course;
use Dbp\Relay\CoreBundle\Rest\AbstractDataProvider;

/**
 * @extends AbstractDataProvider<Course>
 */
class CourseDataProvider extends AbstractDataProvider
{
    public function __construct(private readonly CourseProviderInterface $courseProvider)
    {
        parent::__construct();
    }

    protected function getItemById(string $id, array $filters = [], array $options = []): ?object
    {
        return $this->courseProvider->getCourseById($id, $options);
    }

    protected function getPage(int $currentPageNumber, int $maxNumItemsPerPage, array $filters = [], array $options = []): array
    {
        if ($search = ($filters[Course::SEARCH_PARAMETER_NAME] ?? null)) {
            $options[Course::SEARCH_PARAMETER_NAME] = $search;
        }

        return $this->courseProvider->getCourses($currentPageNumber, $maxNumItemsPerPage, $options);
    }

    protected function isCurrentUserGrantedOperationAccess(int $operation): bool
    {
        return $this->isGrantedRole(Configuration::ROLE_READER);
    }
}
