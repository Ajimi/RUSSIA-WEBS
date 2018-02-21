<?php
/**
 * Created by PhpStorm.
 * User: hir0w
 * Date: 2/18/2018
 * Time: 11:21 AM
 */

namespace UserBundle\Redirection;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\Role\RoleInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class AfterLoginRedirection implements AuthenticationSuccessHandlerInterface
{


    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * This is called when an interactive authentication attempt succeeds. This
     * is called by authentication listeners inheriting from
     * AbstractAuthenticationListener.
     *
     * @return Response never null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
//        /** @var Role[] $roles */
//        $roles = $token->getRoles();
//
//        $rolesArray = array_map(function (Role $role){
//            return $role->getRole();
//        }, $roles);

//        if(in_array('ROLE_ADMIN', $rolesArray)){
//            // TODO : Admin Home page instead of hotel
//            $redirection= new RedirectResponse($this->router->generate('admin_hotel_homepage'));
//        }
//        elseif( in_array('ROLE_USER', $rolesArray)) {
//            $redirection= new RedirectResponse($this->router->generate('homepage'));
//        } else {
//            $redirection= new RedirectResponse($this->router->generate('homepage'));
//        }
        return new RedirectResponse($this->router->generate('homepage'));
    }
}