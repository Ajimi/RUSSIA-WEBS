<?php
/**
 * Created by PhpStorm.
 * User: hir0w
 * Date: 2/14/2018
 * Time: 9:11 AM
 */

namespace Common\UploadBundle\EventListener;


use Common\UploadBundle\Annotation\UploadAnnotationReader;
use Common\UploadBundle\Handler\UploadHandler;
use Doctrine\Common\EventArgs;
use Doctrine\Common\EventSubscriber;

/**
 * Class UploadSubscriber
 * @package Common\UploadBundle\EventListener
 */
class UploadSubscriber implements EventSubscriber
{

    /**
     * @var UploadAnnotationReader
     */
    private $reader;

    /**
     * @var UploadHandler
     */
    private $handler;

    /**
     * UploadSubscriber constructor.
     * @param UploadAnnotationReader $reader
     * @param UploadHandler $handler
     */
    public function __construct(UploadAnnotationReader $reader, UploadHandler $handler)
    {
        $this->reader = $reader;
        $this->handler = $handler;
    }

    /**
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [
            'prePersist',
            'preUpdate',
            'postLoad',
            'postRemove'
        ];
    }

    /**
     * @param EventArgs $event
     * @throws \ReflectionException
     */
    public function prePersist(EventArgs $event)
    {
        $this->preEvent($event);
    }

    /**
     * @param EventArgs $event
     * @throws \ReflectionException
     */
    public function preUpdate(EventArgs $event)
    {
        $this->preEvent($event);
    }

    /**
     * @param EventArgs $event
     * @throws \ReflectionException
     */
    private function preEvent(EventArgs $event)
    {
        $entity = $event->getEntity();
        foreach ($this->reader->getUploadableFields($entity) as $property => $annotation) {
            $this->handler->uploadFile($entity, $property, $annotation);
        }
    }

    /**
     * @param EventArgs $event
     */
    public function postLoad(EventArgs $event)
    {
        $entity = $event->getEntity();
        foreach ($this->reader->getUploadableFields($entity) as $property => $annotation) {
            $this->handler->setFileFromFilename($entity, $property, $annotation);
        }
    }

    /**
     * @param EventArgs $event
     */
    public function postRemove(EventArgs $event)
    {
        $entity = $event->getEntity();
        foreach ($this->reader->getUploadableFields($entity) as $property => $annotation) {
            $this->handler->removeFile($entity, $property);
        }
    }
}