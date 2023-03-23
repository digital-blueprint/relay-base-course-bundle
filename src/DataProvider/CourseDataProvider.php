<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\DataProvider;

use Dbp\Relay\BaseCourseBundle\API\CourseProviderInterface;
use Dbp\Relay\BaseCourseBundle\Entity\Course;
use Dbp\Relay\CoreBundle\DataProvider\AbstractDataProvider;

class CourseDataProvider extends AbstractDataProvider
{
    /** @var CourseProviderInterface */
    private $courseProvider;

    public function __construct(CourseProviderInterface $courseProvider)
    {
        $this->courseProvider = $courseProvider;
    }

    protected function getResourceClass(): string
    {
        return Course::class;
    }

    protected function isUserGrantedOperationAccess(int $operation): bool
    {
        return $this->isUserAuthenticated();
    }

    protected function getItemById($id, array $filters = [], array $options = []): object
    {
        return $this->courseProvider->getCourseById($id, $options);
    }

    protected function getPage(int $currentPageNumber, int $maxNumItemsPerPage, array $filters = [], array $options = []): array
    {
        if ($search = ($filters['search'] ?? null)) {
            $options['search'] = $search;
        }

        return $this->courseProvider->getCourses($currentPageNumber, $maxNumItemsPerPage, $options);
    }
}
