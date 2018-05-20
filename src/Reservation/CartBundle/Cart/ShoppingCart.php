<?php

namespace Reservation\CartBundle\Cart;

use Match\MatchBundle\Entity\Match as tiProduct;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class ShoppingCart
 * @package Reservation\CartBundle\Cart
 */
class ShoppingCart
{
    const CART_PRODUCTS_KEY = 'cart';

    private $session;
    private $em;

    private $products;

    /**
     * ShoppingCart constructor.
     * @param Session $session
     * @param EntityManager $em
     */
    public function __construct(Session $session, EntityManager $em)
    {
        $this->session = $session;
        $this->em = $em;
    }

    /**
     * @param Product $product
     */
    public function addProduct(Product $product)
    {
        $products = $this->getProducts();

        if (!in_array($product, $products)) {
            $products[] = $product;
        }

        $this->updateProducts($products);
    }

    /**
     * @return Product[]
     */
    public function getProducts()
    {
        if ($this->products === null) {
            $productRepo = $this->em->getRepository('MatchBundle:Match');
            $ids = $this->session->get(self::CART_PRODUCTS_KEY, []);

            $products = $productRepo->findAllBy(array_keys($ids));

            $this->products = $products;
            dump($products);
        }

        return $this->products;
    }

    /**
     * @param Product[] $products
     */
    private function updateProducts(array $products)
    {
        $this->products = $products;

        $ids = array_map(function (Product $item) {
            return $item->getId();
        }, $products);

        $this->session->set(self::CART_PRODUCTS_KEY, $ids);
    }

    /**
     * @return int|string
     */
    public function getTotal()
    {
        $total = 0;
        foreach ($this->getProducts() as $product) {
            $total += $product->getTicket()->getPrice();
        }

        return $total;
    }

    public function emptyCart()
    {
        $this->updateProducts([]);
    }
}