<?php

declare(strict_types=1);

namespace Dbp\Relay\BaseCourseBundle\Serializer\Normalizer;

use Dbp\Relay\BaseCourseBundle\Entity\Course;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;

class CourseNormalizer implements ContextAwareNormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    private const ALREADY_CALLED = 'COURSE_NORMALIZER_CURRENT_USER_ALREADY_CALLED';

    /**
     * @return array|string|int|float|bool|\ArrayObject|null
     *
     * @throws ExceptionInterface
     */
    public function normalize($object, $format = null, array $context = [])
    {
        // TODO: only add localData group if it is requested?
        // problem: $context['filters'] not available at this point
        $context['groups'][] = 'BaseCourse:localData';
        $context[self::ALREADY_CALLED] = true;

        return $this->normalizer->normalize($object, $format, $context);
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        if (isset($context[self::ALREADY_CALLED])) {
            return false;
        }

        return $data instanceof Course;
    }
}
