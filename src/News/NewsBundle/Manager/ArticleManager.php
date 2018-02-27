<?php
/**
 * Created by PhpStorm.
 * User: zouaghi
 * Date: 12/02/2018
 * Time: 21:42
 */

namespace News\NewsBundle\Manager;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use News\NewsBundle\Entity\Article;
use Reservation\HotelBundle\HotelManager\Manager;

class ArticleManager extends Manager
{

    private $entityManager;
    private $repository;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->getRepository("NewsBundle:Article");
    }

    /**
     * @return \Doctrine\ORM\EntityRepository|\Reservation\HotelBundle\Repository\RoomRepository
     */
    public function getRepository(string $name): EntityRepository
    {
        return $this->entityManager->getRepository($name);
    }


    public function getList()
    {
        $articles = $this->repository->findAll();
        $this->throwApiException($articles, "Empty list of articles");

        $data = array('article' => array());
        foreach ($articles as $article) {
            $data['articles'][] = $this->serializeArticle($article);
        }

        return $data;
    }


    private function serializeArticle(Article $article)
    {
        return array(
            "id" => $article->getId(),
            "content" => $article->getContent(),
            "title" => $article->getTitle(),
            "created" => $article->getcreated(),
            "updated" => $article->getupdated(),
            "contentChanged" => $article->getContentChanged(),
            "slug" => $article->getSlug(),
        );
    }
}