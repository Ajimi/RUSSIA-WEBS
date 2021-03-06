<?php

namespace Forum\ForumBundle\Repository;

/**
 * SubjectRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SubjectRepository extends \Doctrine\ORM\EntityRepository
{

    /**
     * @param $title
     * @return mixed
     */
    public function getTitleSubject($title)
    {
        $query = $this->getEntityManager()
            ->createQuery("
                    select m from ForumBundle:Subject m WHERE m.etat = 'Accept' AND m.title LIKE :P")
            ->setParameter('P', '%' . $title . '%');
        return $query->getResult();
    }

    /**
     * @return mixed
     */
    public function FindAccept()
    {
        $query = $this->getEntityManager()
            ->createQuery("
                    select m from ForumBundle:Subject m WHERE m.etat = 'Accept'");
        return $query->getResult();
    }

}
