<?php

namespace Common\UploadBundle\Annotation;

use Doctrine\Common\Annotations\Annotation\Target;


/**
 * @Annotation
 * @Target("PROPERTY)
 */
class UploadableField
{
    private $filename;
    private $path;

    /**
     * UploadableField constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        if (empty($options['filename'])) {
            throw new \InvalidArgumentException("L'annotation UplodableField doit avoir un attribut 'filename'");
        }

        if (empty($options['path'])) {
            throw new \InvalidArgumentException("L'annotation UplodableField doit avoir un attribut 'path'");
        }

        $this->filename = $options['filename'];
        $this->path = $options['path'];
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
}