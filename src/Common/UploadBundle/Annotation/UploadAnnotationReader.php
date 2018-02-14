<?php
/**
 * Created by PhpStorm.
 * User: hir0w
 * Date: 2/14/2018
 * Time: 9:08 AM
 */

namespace Common\UploadBundle\Annotation;


use Doctrine\Common\Annotations\AnnotationReader;

/**
 * Class AnnotationReader
 * @package Common\UploadBundle\Annotation
 */
class UploadAnnotationReader
{
    private $reader;

    /**
     * AnnotationReader constructor.
     * @param AnnotationReader $reader
     */
    public function __construct(AnnotationReader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * Liste les champs uploadable d'une entité (sous forme de tableau associatif)
     */

    /**
     *
     * Return a list of uploadable field in an Entity (an Associatif Array)
     *
     * @param $entity
     * @return array
     */
    public function getUploadableFields($entity): array
    {
        $reflection = new \ReflectionClass(get_class($entity));
        $properties = [];
        foreach ($reflection->getProperties() as $property) {
            $annotation = $this->reader->getPropertyAnnotation($property, UploadableField::class);
            if ($annotation !== null) {
                $properties[$property->getName()] = $annotation;
            }
        }
        return $properties;
    }

}