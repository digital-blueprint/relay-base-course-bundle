<?php

declare(strict_types=1);

namespace Dbp\Relay\CourseBundle\Controller;

use Dbp\Relay\CourseBundle\Entity\Course;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class LoggedInOnly extends AbstractController
{
    public function __invoke(Course $data, Request $request): Course
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $data;
    }
}
