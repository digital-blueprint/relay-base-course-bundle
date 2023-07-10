<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\Controller;

use Dbp\Relay\BaseCourseBundle\API\CourseProviderInterface;
use Dbp\Relay\CoreBundle\Locale\Locale;
use Dbp\Relay\CoreBundle\Rest\Options;
use Dbp\Relay\CoreBundle\Rest\Query\Pagination\Pagination;
use Dbp\Relay\CoreBundle\Rest\Query\Pagination\PartialPaginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GetAttendeesByCourse extends AbstractController
{
    /** @var CourseProviderInterface */
    private $coursesProvider;

    /** @var Locale */
    private $locale;

    public function __construct(CourseProviderInterface $coursesProvider, Locale $locale)
    {
        $this->coursesProvider = $coursesProvider;
        $this->locale = $locale;
    }

    public function __invoke(string $identifier, Request $request): PartialPaginator
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $options = [];
        $options[Options::LANGUAGE] = $this->locale->getCurrentPrimaryLanguage();

        $query = $request->query->all();
        $currentPageNumber = Pagination::getCurrentPageNumber($query);
        $maxNumItemsPerPage = Pagination::getMaxNumItemsPerPage($query);

        return new PartialPaginator($this->coursesProvider->getAttendeesByCourse($identifier,
            $currentPageNumber, $maxNumItemsPerPage, $options),
            $currentPageNumber, $maxNumItemsPerPage);
    }
}
