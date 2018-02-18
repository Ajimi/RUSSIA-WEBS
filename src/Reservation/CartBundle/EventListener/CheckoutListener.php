<?php

namespace Reservation\CartBundle\EventListener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

/**
 * Created by PhpStorm.
 * User: hir0w
 * Date: 2/18/2018
 * Time: 9:27 AM
 */
class CheckoutListener
{

    /**
     * @var ContainerInterface
     */
    private $container;
    /**
     * @var Session
     */
    private $session;
    /**
     * @var AuthorizationChecker
     */
    private $authorizationChecker;

    public function __construct(ContainerInterface $container,
                                Session $session,
                                AuthorizationChecker $authorizationChecker)
    {

        $this->container = $container;
        $this->session = $session;
        $this->router = $container->get('router');
        $this->authorizationChecker = $authorizationChecker;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if ($event->getRequest()->attributes->get('_route') == 'checkout') {
            // don't do anything if it's not the master request
            return;
        }

    }
}