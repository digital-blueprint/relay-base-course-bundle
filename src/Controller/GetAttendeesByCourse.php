<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\Controller;

use Dbp\Relay\BaseCourseBundle\API\CourseProviderInterface;
use Dbp\Relay\CoreBundle\Pagination\Pagination;
use Dbp\Relay\CoreBundle\Pagination\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GetAttendeesByCourse extends AbstractController
{
    /** @var CourseProviderInterface */
    private $coursesProvider;

    public function __construct(CourseProviderInterface $coursesProvider)
    {
        $this->coursesProvider = $coursesProvider;
    }

    public function __invoke(string $identifier, Request $request): Paginator
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $options = [];
        $options['lang'] = $request->query->get('lang', 'de');

        Pagination::addPaginationOptions($options, $request->query->all());

        return $this->coursesProvider->getAttendeesByCourse($identifier, $options);
    }
}
