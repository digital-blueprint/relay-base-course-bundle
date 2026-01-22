<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\DataProvider;

use Dbp\Relay\BaseCourseBundle\API\CourseProviderInterface;
use Dbp\Relay\BaseCourseBundle\DependencyInjection\Configuration;
use Dbp\Relay\BaseCourseBundle\Entity\CourseEvent;
use Dbp\Relay\CoreBundle\Rest\AbstractDataProvider;

/**
 * @extends AbstractDataProvider<CourseEvent>
 */
class CourseEventDataProvider extends AbstractDataProvider
{
    public function __construct(private readonly CourseProviderInterface $courseProvider)
    {
        parent::__construct();
    }

    protected function getItemById(string $id, array $filters = [], array $options = []): ?object
    {
        return $this->courseProvider->getCourseEventById($id, $options);
    }

    protected function getPage(int $currentPageNumber, int $maxNumItemsPerPage, array $filters = [], array $options = []): array
    {
        $knownFilters = [];
        if ($courseIdentifier = $filters['courseIdentifier'] ?? null) {
            $knownFilters['courseIdentifier'] = $courseIdentifier;
        }

        return $this->courseProvider->getCourseEvents($currentPageNumber, $maxNumItemsPerPage, $knownFilters, $options);
    }

    protected function isCurrentUserGrantedOperationAccess(int $operation): bool
    {
        return $this->isGrantedRole(Configuration::ROLE_READER);
    }
}
