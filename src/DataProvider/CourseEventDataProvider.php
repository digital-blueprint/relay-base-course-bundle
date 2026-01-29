<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\DataProvider;

use Dbp\Relay\BaseCourseBundle\API\CourseProviderInterface;
use Dbp\Relay\BaseCourseBundle\DependencyInjection\Configuration;
use Dbp\Relay\BaseCourseBundle\Entity\CourseEvent;
use Dbp\Relay\CoreBundle\Exception\ApiError;
use Dbp\Relay\CoreBundle\Rest\AbstractDataProvider;
use Symfony\Component\HttpFoundation\Response;

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
        $queryParameters = [];
        if (null !== ($courseIdentifier = $filters[CourseEvent::COURSE_IDENTIFIER_QUERY_PARAMETER] ?? null)) {
            $queryParameters[CourseEvent::COURSE_IDENTIFIER_QUERY_PARAMETER] = $courseIdentifier;
        } else {
            throw new ApiError(Response::HTTP_BAD_REQUEST, 'Required query parameter \''.CourseEvent::COURSE_IDENTIFIER_QUERY_PARAMETER.'\' is missing.');
        }
        if (null !== ($typeKey = $filters[CourseEvent::TYPE_KEY_QUERY_PARAMETER] ?? null)) {
            $queryParameters[CourseEvent::TYPE_KEY_QUERY_PARAMETER] = $typeKey;
        }

        return $this->courseProvider->getCourseEvents(
            $currentPageNumber, $maxNumItemsPerPage, $queryParameters, $options);
    }

    protected function isCurrentUserGrantedOperationAccess(int $operation): bool
    {
        return $this->isGrantedRole(Configuration::ROLE_READER);
    }
}
