<?php
/**
 * Created by PhpStorm.
 * User: hir0w
 * Date: 2/14/2018
 * Time: 9:13 AM
 */

namespace Common\UploadBundle\Handler;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\PropertyAccess\PropertyAccess;


/**
 * Class UploadHandler
 * @package Common\UploadBundle\Handler
 */
class UploadHandler
{

    private $accessor;

    /**
     * UploadHandler constructor.
     */
    public function __construct()
    {
        $this->accessor = PropertyAccess::createPropertyAccessor();
    }

    /**
     * @param $entity
     * @param $property
     * @param $annotation
     */
    public function uploadFile($entity, $property, $annotation)
    {
        $file = $this->accessor->getValue($entity, $property);
        if ($file instanceof UploadedFile) {
            $this->removeOldFile($entity, $annotation);
            $filename = $file->getClientOriginalName();
            $file->move($annotation->getPath(), $filename);
            $this->accessor->setValue($entity, $annotation->getFilename(), $filename);
        }
    }

    /**
     * @param $entity
     * @param $annotation
     */
    public function removeOldFile($entity, $annotation)
    {
        /** @var File|null $file */
        $file = $this->getFileFromFilename($entity, $annotation);
        if ($file !== null) {
            @unlink($file->getRealPath());
        }
    }

    /**
     * @param $entity
     * @param $annotation
     * @return null|File
     */
    private function getFileFromFilename($entity, $annotation)
    {
        $filename = $this->accessor->getValue($entity, $annotation->getFilename());
        if (empty($filename)) {
            return null;
        } else {
            return new File($annotation->getPath() . DIRECTORY_SEPARATOR . $filename, false);
        }
    }

    /**
     * @param $entity
     * @param $property
     * @param $annotation
     * @throws \TypeError
     */
    public function setFileFromFilename($entity, $property, $annotation)
    {
        $file = $this->getFileFromFilename($entity, $annotation);
        $this->accessor->setValue($entity, $property, $file);
    }

    /**
     * @param $entity
     * @param $property
     */
    public function removeFile($entity, $property)
    {
        $file = $this->accessor->getValue($entity, $property);
        if ($file instanceof File) {
            @unlink($file->getRealPath());
        }
    }

}