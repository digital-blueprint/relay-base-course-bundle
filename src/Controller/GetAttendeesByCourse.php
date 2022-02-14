<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\Controller;

use Dbp\Relay\BaseCourseBundle\API\CourseProviderInterface;
use Dbp\Relay\CoreBundle\Helpers\ArrayFullPaginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GetAttendeesByCourse extends AbstractController
{
    public const ITEMS_PER_PAGE = 250;

    protected $coursesProvider;

    public function __construct(CourseProviderInterface $coursesProvider)
    {
        $this->coursesProvider = $coursesProvider;
    }

    public function __invoke(string $identifier, Request $request): ArrayFullPaginator
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $page = (int) $request->query->get('page', 1);
        $perPage = (int) $request->query->get('perPage', self::ITEMS_PER_PAGE);

        $options = [];
        $lang = $request->query->get('lang', 'de');
        $options['lang'] = $lang;

        $courses = $this->coursesProvider->getAttendeesByCourse($identifier, $options);

        return new ArrayFullPaginator($courses, $page, $perPage);
    }
}
