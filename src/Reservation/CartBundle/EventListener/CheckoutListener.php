<?php

namespace Reservation\CartBundle\EventListener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * Created by PhpStorm.
 * User: hir0w
 * Date: 2/18/2018
 * Time: 9:27 AM
 */
class CheckoutListener
{


    private $session;
    private $router;
    private $container;

    /**
     * CheckoutListener constructor.
     * @param Session $session
     * @internal param TokenInterface $tokenStorage
     */
    public function __construct(ContainerInterface $container,
                                Session $session)
    {
        $this->session = $session;
        $this->container = $container;
        $this->router = $container->get('router');
    }

    /**
     * @param GetResponseEvent $event
     * @throws \InvalidArgumentException
     */
    public
    function onKernelRequest(GetResponseEvent $event)
    {
        $currentRoute = $event->getRequest()->attributes->get('_route');

        if ($this->isUserLogged() && $event->isMasterRequest()) {
            if ($this->isAuthenticatedUserOnAnonymousPage($currentRoute)) {
                $this->redirectTo($event);
            }
        }


        if ($currentRoute === 'checkout_index') {
            if ($this->session->has('cart')) {
                $cart = $this->session->get('cart');

                if (count($cart) == 0)
                    $this->redirectTo($event, 'cart_index');
            }

            if (!$this->isUserLogged()) {
                $this->session->getFlashBag()->add('notice', 'You must login in order to acces to your cart');
                $this->redirectTo($event, 'fos_user_security_login');
            }
        }


    }


    /**
     * @param GetResponseEvent $event
     * @param string $route
     * @return RedirectResponse
     * @throws \InvalidArgumentException
     */
    private function redirectTo(GetResponseEvent $event, $route = 'homepage')
    {
        $response = new RedirectResponse($this->router->generate($route));
        $event->setResponse($response);
    }

    /**
     * Get a user from the Security Token Storage.
     *
     * @return bool
     * @throws \LogicException If SecurityBundle is not available
     *
     * @see TokenInterface::getUser()
     */
    private function isUserLogged(): bool
    {
        if (!$this->container->has('security.token_storage')) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }
        if (null === $token = $this->container->get('security.token_storage')->getToken()) {
            return false;
        }
        if (!is_object($user = $token->getUser())) {
            // e.g. anonymous authentication
            return false;
        }
        return true;
    }

    private function isAuthenticatedUserOnAnonymousPage($currentRoute)
    {
        if (!empty($currentRoute))
            return in_array($currentRoute, ['fos_user_security_login', 'fos_user_resetting_request', 'fos_user_registration_register', 'app_user_registration']);
        return true;
    }
}