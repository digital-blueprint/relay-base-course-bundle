# DbpRelayBaseCourseBundle

[GitHub](https://github.com/digital-blueprint/relay-base-course-bundle) |
[Packagist](https://packagist.org/packages/dbp/relay-base-course-bundle)

[![Test](https://github.com/digital-blueprint/relay-base-course-bundle/actions/workflows/test.yml/badge.svg)](https://github.com/digital-blueprint/relay-base-course-bundle/actions/workflows/test.yml)

Base Symfony bundle for courses for the DBP Relay API Server.

## Integration into the Relay API Server

* Add the bundle package as a dependency:

```bash
composer require dbp/relay-base-course-bundle
```

* Add the bundle to your `config/bundles.php`:

```php
...
Dbp\Relay\BasePersonBundle\DbpRelayBaseCourseBundle::class => ['all' => true],
...
];
```

* Run `composer install` to clear caches

## Course provider implementation

For this bundle to work you need to add a service that implements the
[CourseProviderInterface](https://github.com/digital-blueprint/relay-base-course-bundle/-/blob/main/src/API/CourseProviderInterface.php)
to your application.

### Example

#### Service class

For example, create a service `src/Service/CourseProvider.php`:

```php
<?php

namespace App\Service;

use Dbp\Relay\BaseCourseBundle\API\CourseProviderInterface;
use Dbp\Relay\BaseCourseBundle\Entity\Course;

class CourseProvider implements CourseProviderInterface
{
    public function getCourseById(string $identifier, array $options = []): ?Course
    {
        $course = new Course();
        $course->setIdentifier($identifier);
        $course->setName('Field Theory');
        $course->setDescription('News from field theory');

        return $course;
    }
    
    ...
}
```

#### Services configuration

For the example service above you need to add the following to your `src/Resources/config/services.yaml`:

```yaml
  Dbp\Relay\BaseCourseBundle\API\CourseProviderInterface:
    '@App\Service\CourseProvider'
```
