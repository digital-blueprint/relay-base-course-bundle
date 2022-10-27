<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\DataProvider;

use Dbp\Relay\BaseCourseBundle\API\CourseProviderInterface;
use Dbp\Relay\BaseCourseBundle\Entity\Course;
use Dbp\Relay\CoreBundle\DataProvider\AbstractDataProvider;
use Symfony\Component\HttpFoundation\RequestStack;

class CourseDataProvider extends AbstractDataProvider
{
    /** @var CourseProviderInterface */
    private $courseProvider;

    public function __construct(CourseProviderInterface $courseProvider, RequestStack $requestStack)
    {
        parent::__construct($requestStack);

        $this->courseProvider = $courseProvider;
    }

    protected function getResourceClass(): string
    {
        return Course::class;
    }

    protected function getItemById($id, array $options = []): object
    {
        return $this->courseProvider->getCourseById($id, $options);
    }

    protected function getPage(int $currentPageNumber, int $maxNumItemsPerPage, array $filters = [], array $options = []): array
    {
        if ($search = ($filters['search'] ?? null)) {
            $options['search'] = $search;
        }

        // TODO: change getCourses to accept $currentPageNumber and $maxNumItemsPerPage as arguments and return page items as array
        $options['page'] = $currentPageNumber;
        $options['perPage'] = $maxNumItemsPerPage;
        $options['partialPagination'] = true;

        return $this->courseProvider->getCourses($options)->getItems();
    }
}
