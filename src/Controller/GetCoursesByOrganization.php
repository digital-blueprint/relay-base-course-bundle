<?php

declare(strict_types=1);

namespace Dbp\Relay\CourseBundle\Controller;

use ApiPlatform\Core\DataProvider\PaginatorInterface;
use Dbp\Relay\CoreBundle\Helpers\ArrayFullPaginator;
use Dbp\Relay\CourseBundle\API\CourseProviderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GetCoursesByOrganization extends AbstractController
{
    public const ITEMS_PER_PAGE = 250;

    protected $coursesProvider;

    public function __construct(CourseProviderInterface $coursesProvider)
    {
        $this->coursesProvider = $coursesProvider;
    }

    public function __invoke(string $id, Request $request): PaginatorInterface
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $page = (int) $request->query->get('page', 1);
        $perPage = (int) $request->query->get('perPage', self::ITEMS_PER_PAGE);
        $options = ['lang' => $request->query->get('lang', 'de')];

        $courses = $this->coursesProvider->getCoursesByOrganization($id, $options);

        return new ArrayFullPaginator($courses, $page, $perPage);
    }
}
