<?php

namespace Reservation\CartBundle\EventListener;

use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * Class CheckoutListener
 * @package Reservation\CartBundle\EventListener
 */
class CheckoutListener
{

    /** @var Session */
    private $session;
    /** @var object|Router */
    private $router;
    /** @var ContainerInterface */
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

        $request = $event->getRequest();
        $userAgent = $request->headers->get('User-Agent');
        $request->attributes->set('isRegion', $array = $this->container->get('doctrine.orm.entity_manager')
            ->getRepository('RegionBundle:Region')->findAll());

        $currentRoute = $event->getRequest()->attributes->get('_route');

        /** Check if user is logged */
        if ($this->isUserLogged() && $event->isMasterRequest()) {
            if ($this->isAuthenticatedUserOnAnonymousPage($currentRoute)) {
                $this->redirectTo($event);
            }
        }


        /** if the route is checkout than it will
         *  check if it contains ticket/product in the cart if not it will redirect
         *  if the user is not logged in it zill redirect
         */
        if ($currentRoute === 'checkout_index') {
            if ($this->session->has('cart')) {
                $cart = $this->session->get('cart');
                if (count($cart) == 0) {
                    $this->session->getFlashBag()->add('notice', 'You need to have at least 1 item in order to checkout');
                    $this->redirectTo($event, 'cart_index');
                }
            }

            if (!$this->isUserLogged()) {
                $this->session->getFlashBag()->add('error', 'You must login in order to acces to your cart');
                $this->redirectTo($event, 'fos_user_registration_register');
            }
        }


    }


    /**
     * @param GetResponseEvent $event
     * @param string $route
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

    /**
     * @param $currentRoute
     * @return bool
     */
    private function isAuthenticatedUserOnAnonymousPage($currentRoute): bool
    {
        if (!empty($currentRoute))
            return in_array($currentRoute, ['fos_user_security_login', 'fos_user_resetting_request', 'fos_user_registration_register', 'app_user_registration']);
        return true;
    }
}